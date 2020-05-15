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
                if($page->permission === "guest" && user()) back("로그인 이후에는 이용하실 수 없습니다.");
                else if($page->permission === "user" && !user()) go("/users/sign-in", "로그인 후에 이용하실 수 있습니다.");
                else if($page->permission === "admin" && !admin()) back("관리자만 접근할 수 있는 페이지 입니다.");

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