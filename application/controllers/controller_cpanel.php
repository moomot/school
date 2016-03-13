<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/30/16
 * Time: 9:17 PM
 */
class Controller_Cpanel extends Controller
{
    public $defaultPage = "cpanel";

    function action_index()
    {
        if ( $this->accessGranted() )
            $this->view->generateCpTpl($this->defaultPage."/dashboard.php");
        else
            $this->view->generateCpTpl($this->defaultPage."/login.php");
    }
    function action_login()
    {
        if(Users::getLoginStatus()=="access_granted") {
            $this->redirect_to_main("/".$this->defaultPage);
        }
        else
        {
            if(isset($_POST['login']) && isset($_POST['password']))
            {
                $login = $_POST['login'];
                $password =$_POST['password'];
                $data = $this->model->get_school_auth_data($login);

                if (!empty($data['status'])) {
                    if ($data['status']) {
                        if (md5($password) == $data['password']) {
                            Session::set("login_status", "access_granted");
                            Session::set("uid", $data['uid']);;
                            $this->redirect_to_main("/" . $this->defaultPage);
                        } else {
                            Session::set("login_status", "access_denied");
                            $this->redirect_to_main("/" . $this->defaultPage);
                        }
                    }
                } else {
                    Session::set("login_status", "access_denied");
                    $this->redirect_to_main("/" . $this->defaultPage);
                }
            } else {
                $this->redirect_to_main("/".$this->defaultPage);
            }
        }
    }

    function action_logout()
    {
        Session::destroy();
        header('Location:'.Url::$baseurl);
    }

    function action_list()
    {
        if ( $this->accessGranted() )
            $this->view->generateCpTpl($this->defaultPage."/list/index.php");
        else
            $this->redirect_to_main("/".$this->defaultPage);
    }

    function action_messages()
    {
        if ( $this->accessGranted() )
            $this->view->generateCpTpl($this->defaultPage."/messages/index.php");
        else
            $this->redirect_to_main("/".$this->defaultPage);
    }

    function action_send_message()
    {
        if ( $this->accessGranted() )
            $this->view->generateCpTpl($this->defaultPage."/messages/send.php");
        else
            $this->redirect_to_main("/".$this->defaultPage);
    }

    /**
     * Called by form, when site settings are saving
     * Call: /cpanel/save_site_settings
     */
    function action_save_site_settings()
    {
        $onReconstruction = htmlspecialchars($_POST['reconstruction_status']);
        $onReconstruction = $onReconstruction == "on" ? "1" : 0;
        $data = [
            'title' => htmlspecialchars($_POST['title']),
            'description' => htmlspecialchars($_POST['desc']),
            'template' => htmlspecialchars($_POST['template']),
            'onReconstruction' => $onReconstruction,
            'reconstructionReason' => $_POST['reconstruction_text']
        ];
        try {
            $this->model->save_settings($data);
        } catch (CustomException $e) {
            $exception_path = PATH_SITE."/application/views/exception/exception.php";
            if ( file_exists($exception_path) ) {
                include $exception_path;
            }
        }
    }

}