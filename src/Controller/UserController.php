<?php
namespace Controller;
use App\DB;

class UserController {
    function signInPage(){
        view("users/sign-in");
    }

    function signIn(){
        checkInput();
        extract($_POST);       

        $user = DB::who($user_id);
        if(!$user) back("해당 아이디와 일치하는 회원이 존재하지 않습니다.");
        if($user->password !== hash("sha256", $password)) back("비밀번호가 일치하지 않습니다.");

        $_SESSION['user'] = $user;

        go("/", "로그인 되었습니다.");
    }

    function logout(){
        unset($_SESSION['user']);
        go("/", "로그아웃 되었습니다.");
    }
}