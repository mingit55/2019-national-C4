<?php
namespace Controller;

use App\DB;

class EventController {
    function participatePage(){
        $addition_head = [
            "<link rel=\"stylesheet\" href=\"/css/participate.css\">",
            "<script src=\"/js/participate/App.js\"></script>",
            "<script src=\"/js/participate/Viewer.js\"></script>",
            "<script src=\"/js/participate/Track.js\"></script>",
            "<script src=\"/js/participate/Clip.js\"></script>",
            "<script src=\"/js/participate/Line.js\"></script>",
            "<script src=\"/js/participate/Rect.js\"></script>",
            "<script src=\"/js/participate/Text.js\"></script>",
            "<script src=\"/js/participate/Group.js\"></script>"
        ];

        view("events/participation", [], $addition_head);
    }

    function participation(){
        checkInput();
        extract($_POST);
        
        DB::query("INSERT INTO teasers(html, user_id, movie_id) VALUES (?, ?, ?)", [$video_html, user()->id, $movie_id]);
        back("콘테스트 참여가 완료되었습니다.");
    }

    function listPage(){
        $list = DB::fetchAll("SELECT T.*, U.user_name FROM teasers T LEFT JOIN users U ON T.user_id = U.id ORDER BY T.created_at DESC");

        view("events/list", ["list" => $list]);
    }
    
    function detailPage($id){
        $teaser = DB::fetch("SELECT T.*, U.user_name, U.user_id FROM teasers T LEFT JOIN users U ON T.user_id = U.id WHERE T.id = ?", [$id]);
        view("events/detail", ["teaser" => $teaser]);
    }

    function updateScore($id){
        checkInput();
        extract($_POST);

        $teaser = DB::find("teasers", $id);

        if(!$teaser){
            back("해당 티저 영상이 존재하지 않습니다.");
        }

        $result = $teaser->score + $score;
        DB::query("UPDATE teasers SET score = ? WHERE id = ?", [$result, $id]);
    
        go("/events/teaser-contest/{$id}", "평점이 등록되었습니다.");
    }
}