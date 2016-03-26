<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 11:27 AM
 */
class Controller_UPanel extends Controller
{
    function action_index()
    {

        // If user logged in - show user panel, else show access_denied page
        if(Users::getLoginStatus()=="access_granted")
        {
            $data=$this->model->get_lectures();
            $this->view->generate("users/lessons.php",$data);
        }
        else
            $this->view->generate("users/login_form.php");
    }

    function action_lessons()
    {
        if(Users::getLoginStatus()=="access_granted")
        {
            $data=$this->model->get_lectures();
            $this->view->generate("users/lessons.php",$data);
        }
        else
            $this->view->generate("users/access_denied.php");
    }

    function action_messages()
    {
        if(Users::getLoginStatus()=="access_granted")
            $this->view->generate("users/messages.php");
        else
            $this->view->generate("users/access_denied.php");
    }

    function action_send_message()
    {
        if(Users::getLoginStatus()=="access_granted")
            $this->view->generate("users/send.php");
        else
            $this->redirect_to_main($this->defaultPage);
    }

    function action_tickets()
    {
        if(Users::getLoginStatus()=="access_granted")
        {
            $request_uri=$_SERVER['REQUEST_URI'];
            $routes = explode('/', $request_uri);
            $data['current_lecture']=$routes[4];
            $this->model->get_questions($data);
            $this->view->generate("users/tickets.php",$data);
        }
        else
            $this->redirect_to_main($this->defaultPage);
    }

}