<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 2:01 AM
 */
class Users
{
    static function getUID() {
        if(Session::get("uid") == "")
            return "Гость";
        else
            return Session::get("uid");
    }
    static function getLoginStatus() {
        return Session::get("login_status");
    }

    static function getAdminLoginStatus() {
        return Session::get("admin_login_status");
    }

    static function getSchoolLoginStatus() {
        return Session::get("school_login_status");
    }

    static function getUserLoginStatus() {
        return Session::get("user_login_status");
    }
}