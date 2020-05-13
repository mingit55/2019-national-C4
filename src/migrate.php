<?php

require __DIR__."/App/DB.php";

use App\DB;


$userList = [
    (object)[
        "user_id" => "admin",
        "password" => "1",
        "user_name" => "관리자",
        "auth" => 1
    ],
    (object)[
        "user_id" => "user",
        "password" => "2",
        "user_name" => "이코딩",
        "auth" => 0
    ]
];
   
foreach($userList as $user){
    $sql = "INSERT INTO users(user_id, password, user_name, auth) VALUES (?, ?, ?, ?)";
    $data = [$user->user_id, hash("sha256", $user->password), $user->user_name, $user->auth];
    DB::query($sql, $data);
}