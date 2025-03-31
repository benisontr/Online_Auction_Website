<?php

class Database {

    private static $instance = null;

    private static $host = '127.0.0.1';
    private static $user = 'root';
    private static $password = '';
    private static $db = 'auction';
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new mysqli(self::$host, self::$user, self::$password, self::$db);
        }
        return self::$instance;
    } 
}
