<?php
class Session {

    public static function init(){
        @session_start();
        return (isset($_SESSION['isLogged']));
    }

    public static function set($key, $value){
        @session_start();
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return ($_SESSION[$key]);
    }
    public function delete($key){
        unset ($_SESSION[$key]);
    }

    public function destroy(){
        @session_start();
        unset($_SESSION);
        session_destroy();
    }
}
