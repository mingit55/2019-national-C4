<?php
namespace App;

class DB {
    static $connection = null;
    static function getConnection(){
       if(self::$connection === null)
       {
           $dbname = "2019_national_c4";
           $user = "root";
           $pass = "";
           $option = [
               \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
               \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
           ];
           self::$connection = new \PDO("mysql:host=localhost;dbname=$dbname;charset=utf8mb4", $user, $pass, $option);
       }
       return self::$connection;
    }

    static function query($sql, $data = []){
        $q = self::getConnection()->prepare($sql);
        $q->execute($data);
        return $q;
    }

    static function fetch($sql, $data = []){
        return self::query($sql, $data)->fetch();
    }

    static function fetchAll($sql, $data = []){
        return self::query($sql, $data)->fetchAll();
    }

    static function find($table, $id){
        return self::fetch("SELECT * FROM $table WHERE id = ?", [$id]);
    }

    static function who($user_id){
        return self::fetch("SELECT * FROM users WHERE user_id = ?", [$user_id]);
    }

    static function lastInsertId(){
        return self::getConnection()->lastInsertId();
    }
}