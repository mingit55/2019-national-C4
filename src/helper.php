<?php

function dump()
{
    foreach(func_get_args() as $arg)
    {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}

function dd()
{
    dump(...func_get_args());
    exit;
}

function view($pageName, $data = [], $addition_head = [])
{
    extract($data);
    $pageName = str_replace("/", DS, $pageName);

    $headerPath = _VIEW.DS."layout".DS."header.php";
    $footerPath = _VIEW.DS."layout".DS."footer.php";
    $filePath = _VIEW.DS.$pageName . ".php";
    
    if(is_file($filePath)) {
        require($headerPath);
        require($filePath);
        require($footerPath);
    }
}

function user()
{
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function admin(){
    return user() && user()->auth == 1 ? user() : false;
}

function go($url, $message = "")
{
    echo "<script>";
    if($message !== "") echo "alert(\"$message\");";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($message = "")
{
    echo "<script>";
    if($message !== "") echo "alert(\"$message\");";
    echo "history.back();";
    echo "</script>";
    exit;
}

function checkInput()
{
    foreach($_POST as $data)
    {
        if(trim($data) === "") 
        {
            back("모든 값을 입력해 주세요.");
        }
    }
}

function json_response($data, $status = true){
    header("Content-Type: application/json");
    echo json_encode(['data' => $data, 'status' => $status], JSON_UNESCAPED_UNICODE);
    exit;
}

function movieName($movie_id){
    return ["기생충", "극한직업", "롱리브 더 킹", "나랏말싸미"," 봉오동 전투"][$movie_id - 1];
}