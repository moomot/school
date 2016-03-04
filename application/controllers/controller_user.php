<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/7/16
 * Time: 12:10 AM
 */
class Controller_User extends Controller
{
    function action_login() {
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $login = $_POST['login'];
            $password =$_POST['password'];
            /*
            Производим аутентификацию, сравнивая полученные значения со значениями прописанными в коде.
            Такое решение не верно с точки зрения безопсаности и сделано для упрощения примера.
            Логин и пароль должны храниться в БД, причем пароль должен быть захеширован.
            */
            if($login=="kiko" && $password=="12345")
            {
                Session::set("login_status", "access_granted");
                Session::set("login", $login);
                header('Location:'.Url::$baseurl.'/upanel');
            }
            else
            {
                Session::set("login_status", "access_denied");
                header('Location:'.Url::$baseurl.'/user/login');
            }
        } else {
            $this->view->generate("users/login_form.php");
        }
    }

    function action_logout() {
        Session::destroy();
        header('Location:'.Url::$baseurl);
    }

}