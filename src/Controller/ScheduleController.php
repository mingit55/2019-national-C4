<?php
namespace Controller;

use App\DB;

class ScheduleController {
    function calenderPage(){
        view("biff/calender");
    }
    
    function applicationPage(){
        $entries = DB::fetchAll("SELECT * FROM entries ORDER BY id");

        view("schedules/application", ["entries" => $entries]);
    }

    function detailPage($date){
        if(preg_match("/^(?<year>[0-9]{4})-(?<month>[0-9]{1,2})-(?<date>[0-9]{1,2})$/", $date, $matches)) {
            $findStart = $date . " 00:00:00";
            $findEnd = $date . " 23:59:59";

            $sql = "SELECT E.*, S.start_time, S.end_time 
                    FROM schedules S LEFT JOIN  entries E ON E.id = S.movie_id
                    WHERE TIMESTAMP(?) <= TIMESTAMP(S.start_time) AND TIMESTAMP(S.end_time) <= TIMESTAMP(?)";
            $schedules = DB::fetchAll($sql, [$findStart, $findEnd]);

            view("schedules/detail", ["date" => $date, "list" => $schedules]);
        }
        else http_response_code(404);
    }

    function getSchedule(){
        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] <= 0){
            $schedule = DB::find("schedules", $_GET['id']);

            if(!$schedule){
                json_response("스케줄을 찾을 수 없습니다.", false);
            }

            json_response($schedule);
        } 
        else if(isset($_GET['year']) && isset($_GET['month'])){
            $year = (int)$_GET['year'];
            $month = (int)$_GET['month'];
            $nextYear = $month + 1 > 12 ? $year + 1 : $year;
            $nextMonth = ($month + 1) % 12;

            $start_date = "{$year}-{$month}-1";
            $end_date = "{$nextYear}-{$nextMonth}-1";

            $sql = "SELECT S.*, E.title FROM schedules S, entries E
                    WHERE E.id = S.movie_id
                    AND TIMESTAMP(?) <= TIMESTAMP(S.start_time) AND TIMESTAMP(S.start_time) < TIMESTAMP(?)";

            $schedules = DB::fetchAll($sql, [$start_date, $end_date]);
            json_response($schedules);
        }
    }

    function addSchedule(){
        checkInput();
        extract($_POST);

        $isMatches = preg_match("/^(?<year>[0-9]{4})\/(?<month>[0-9]{1,2})\/(?<date>[0-9]{1,2})\/(?<hour>[0-9]{1,2})\/(?<minute>[0-9]{1,2})$/", $screening_date, $matches);

        if($isMatches == false){
            back("상영 예약일시를 형식에 맞춰 작성해 주세요!");
        }

        $date = "{$matches['year']}-{$matches['month']}-{$matches['date']} {$matches['hour']}:{$matches['minute']}";
        $timestamp = strtotime($date);

        $entry = DB::find("entries", $movie_id);
        $startTime = date("Y-m-d H:i:s", $timestamp);
        $endTime = date("Y-m-d H:i:s", $timestamp + ($entry->running_time * 60));

        $overlap = DB::fetch("SELECT * FROM schedules WHERE TIMESTAMP(start_time) <= TIMESTAMP(?) AND TIMESTAMP(?) <= TIMESTAMP(end_time)", [$endTime, $startTime]);
        
        if($overlap) {
            back("해당 일시에 이미 예약된 영화가 존재합니다.");
        } else if(!$entry) {
            back("해당 출품 신청이 존재하지 않습니다.");
        }

        DB::query("INSERT INTO schedules (movie_id, start_time, end_time) VALUES (?, ?, ?)", [$movie_id, $startTime, $endTime]);

        go("/biff-2019/calender", "예약이 완료되었습니다.");
    }
}