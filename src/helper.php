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

function view($pageName, $data = [])
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