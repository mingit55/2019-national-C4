<?php
namespace Controller;

use App\DB;

class EntryController {
    function entryPage(){
        view("biff/entry");
    }

    function entry(){
        checkInput();
        extract($_POST);

        $sql = "INSERT INTO entries(user_id, user_name, title, running_time, created_at, type) VALUES (?, ?, ?, ?, ?, ?)";
        $data = [$user_id, $user_name, $title, $running_time, $created_at, $type];
        DB::query($sql, $data);

        go("/biff-2019/entry", "출품 신청이 완료되었습니다.");
    }

    function entryGraph(){
        $entries = DB::fetchAll("SELECT * FROM entries");
        $totalCount = count($entries);
        $typeCounts = DB::fetchAll("SELECT type, COUNT(*) as cnt FROM entries GROUP BY type");

        $width = 600;
        $height = 300;
        $graphPadding = 20;
        $graphSize = $height - $graphPadding * 2;

        $img = imagecreatetruecolor($width, $height);
        imagealphablending($img, true);

        $transparent = imagecolorallocatealpha($img, 255, 255, 255, 0);
        $black = imagecolorallocate($img, 64, 64, 64);
        $colors = [
            imagecolorallocate($img, 231, 76, 60), //red;
            imagecolorallocate($img, 41, 128, 185), //blue;
            imagecolorallocate($img, 39, 174, 96), //green;
            imagecolorallocate($img, 155, 89, 182), //purple;
        ];

        imagefill($img, 0, 0, $transparent);
        
        imagefilledarc($img, $graphPadding + $graphSize / 2, $graphPadding + $graphSize / 2, $graphSize, $graphSize, 0, 360, $black, IMG_ARC_PIE);

        $labelX = $graphPadding * 3 + $graphSize;
        $textSize = 12;
        $totalAngle = 0;
        $fontPath = _PUB.DS."fonts".DS."NanumSquareR.ttf";
        foreach($typeCounts as $idx => $item){
            // 그래프
            $angle = 360 * $item->cnt / $totalCount;
            imagefilledarc($img, $graphPadding + $graphSize / 2, $graphPadding + $graphSize / 2, $graphSize, $graphSize, $totalAngle, $totalAngle + $angle, $colors[$idx], IMG_ARC_PIE);
            $totalAngle += $angle;

            // 라벨
            $labelY = $graphPadding + ($graphPadding * $idx) + ($textSize * ($idx + 1));
            imagefilledrectangle($img, $labelX, $labelY - $textSize, $labelX + $textSize, $labelY, $colors[$idx]);
            imagettftext($img, $textSize, 0, $labelX + $textSize * 2, $labelY, $black, $fontPath, $item->type. "(" . $item->cnt . ")");
        }

        header("Content-Type: image/png");
        imagepng($img);
        imagedestroy($img);
    }
}