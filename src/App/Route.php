<?php
namespace App;

class Route 
{
    static $get = [];
    static $post = [];

    static function __callStatic($name, $arguments)
    {
        if(strtoupper($name) === $_SERVER['REQUEST_METHOD'])    
        {
            self::${strtolower($name)}[] = (object)[
                "url" => $arguments[0],
                "action" => $arguments[1],
                "permission" => isset($arguments[2]) ? $arguments[2] : null
            ];
        }
    }

    static function getURL()
    {
        $url = explode("?", $_SERVER['REQUEST_URI'])[0];
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return ltrim($url);
    }

    static function connect()
    {
        $currentURL = self::getURL();
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        foreach(self::${$method} as $page)
        {
            $regex = preg_replace("/{([^\/]+)}/", "([^/]+)", $page->url);
            $regex = preg_replace("/\//", "\\/", $regex);
            if(preg_match("/^{$regex}$/", $currentURL, $matches))
            {
                unset($matches[0]);
                $split = explode("@", $page->action);
                $conName = "Controller\\" . $split[0];
                $con = new $conName();
                $con->{$split[1]}(...$matches);
                exit;
            }
        }

        http_response_code(404);
    }
}