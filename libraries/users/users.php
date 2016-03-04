<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 2:01 AM
 */
class Users
{
    static function getLogin() {
        if(Session::get("login") == "")
            return "Гость";
        else
            return Session::get("login");
    }
    static function getLoginStatus() {
        return Session::get("login_status");
    }
}