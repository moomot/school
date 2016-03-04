<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 12:57 AM
 */
class Session
{
    public static function init()
    {
        session_start();
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return false;
    }
    public static function destroy()
    {
        session_destroy();
    }
}