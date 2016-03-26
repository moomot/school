<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 11:27 AM
 */
class Controller_UPanel extends Controller
{
    function get_lectures()
    {
        try
        {
            $sql = "SELECT number, name FROM lectures ORDER BY number";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $query = $_dbh->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }

        return $result;
    }

    function get_questions(&$pdata)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            //get questions for lecture
            $stmt = $_dbh->prepare("SELECT id,question FROM questions WHERE lecture=:lecture");
            $stmt->bindParam(":lecture", $pdata['current_lecture']);
            $stmt->execute();
            $pdata['questions']=$stmt->fetchAll();

            //get variants and add to our questions
            foreach($pdata['questions'] as &$item)
            {
                $sql = "SELECT id,answer,correct FROM variants WHERE question=$item[id]";
                $query = $_dbh->query($sql);
                $item['variants'] = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
    }

    function action_index()
    {

        // If user logged in - show user panel, else show access_denied page
        if(Users::getLoginStatus()=="access_granted")
        {
            $data=$this->get_lectures();
            $this->view->generate("users/lessons.php",$data);
        }
        else
            $this->view->generate("users/login_form.php");
    }

    function action_lessons()
    {
        if(Users::getLoginStatus()=="access_granted")
        {
            $data=$this->get_lectures();
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
            $this->get_questions($data);
            $this->view->generate("users/tickets.php",$data);
        }
        else
            $this->redirect_to_main($this->defaultPage);
    }

}