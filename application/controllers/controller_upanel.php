<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 11:27 AM
 */
class Controller_UPanel extends Controller
{
    public $defaultPage = "upanel";

    function action_login()
    {
        if( $this->accessGranted() ) {
            $this->redirect_to_main("/".$this->defaultPage);
        }
        else
        {
            if(isset($_POST['login']) && isset($_POST['password']))
            {
                $login = $_POST['login'];
                $password =$_POST['password'];
                $data = $this->model->get_user_auth_data($login);

                if (!empty($data['status'])) {
                    if ($data['status']) {
                        if (md5($password) == $data['password']) {
                            Session::set("user_login_status", "access_granted");
                            Session::set("uid", $data['uid']);;
                            $this->redirect_to_main("/" . $this->defaultPage);
                        } else {
                            Session::set("user_login_status", "access_denied");
                            $this->redirect_to_main("/" . $this->defaultPage);
                        }
                    }
                } else {
                    Session::set("user_login_status", "access_denied");
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
        header('Location:'.Url::$baseurl."/");
    }

    function action_index()
    {

        // If user logged in - show user panel, else show access_denied page
        if($this->accessGranted())
        {
            $data=$this->model->get_lectures();
            $this->view->generate("users/lessons.php",$data);
        }
        else
            $this->view->generate("users/login_form.php");
    }

    function action_lessons()
    {
        if($this->accessGranted())
        {
            $data=$this->model->get_lectures();
            $this->view->generate("users/lessons.php",$data);
        }
        else
            $this->view->generate("users/access_denied.php");
    }

    function action_messages()
    {
        if($this->accessGranted())
            $this->view->generate("users/messages.php");
        else
            $this->view->generate("users/access_denied.php");
    }

    function action_send_message()
    {
        if($this->accessGranted())
            $this->view->generate("users/send.php");
        else
            $this->redirect_to_main($this->defaultPage);
    }

    function action_tickets()
    {
        if($this->accessGranted())
                $this->view->generate("users/tickets.php");
        else
            $this->redirect_to_main($this->defaultPage);
    }

	function action_test()
    {
        if($this->accessGranted())
        {
            $request_uri=$_SERVER['REQUEST_URI'];
            $routes = explode('/', $request_uri);
            if (!empty($routes[4]))
			{
                $data['current_lecture'] = $routes[4];
                $this->model->get_questions($data);
                $this->view->generate("users/test.php", $data);
            }
        }
        else
            $this->redirect_to_main($this->defaultPage);
    }
	
    private function accessGranted()
    {
        return Users::getUserLoginStatus()=="access_granted";
    }

}
