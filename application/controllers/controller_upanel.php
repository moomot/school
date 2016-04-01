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
    public $prefix;

    /**
     * Controller_Admin constructor.
     * @param string $prefix
     */
    public function __construct() {
        $this->view = new View();
        $this->prefix = PATH_SITE . "/templates/" . Application::getInstance()->getTemplateName() . "/";
    }
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
            $this->view->generate("users/upanel.php",$data);
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
            $this->view->generate("messages/index.php");
        else
            $this->view->generate("messages/access_denied.php");
    }

    function action_send_message()
    {
        if($this->accessGranted()) {
            $data = $this->model->get_receivers();
            $this->view->generate("messages/send.php");
        }
        else
        {
            $this->redirect_to_main($this->defaultPage);
        }
    }

    /**
     * Render input private messages
     * Action calls by ajax.
     */
    function action_input_pm()
    {
        $data = $this->model->get_input_pm();
        if (sizeof($data) == 0) {
            $data['status'] = "Сообщений нет";
        }
        ob_clean();
        ob_start();
        include $this->prefix . "/messages/messages.php";
    }

    /**
     * Render output private messages
     * Action calls by ajax.
     */
    function action_output_pm()
    {
        $data = $this->model->get_output_pm();
        if (sizeof($data) == 0) {
            $data['status'] = "Сообщений нет";
        }
        ob_clean();
        ob_start();
        include $this->prefix . "/messages/messages.php";
    }

    function action_submit_send_message()
    {
        if ($this->accessGranted()) {
            ob_clean();
            ob_start();
            if (isset($_POST)) {
                $result = $this->model->send_message($_POST);
                if ($result) {
                    $data['message'] = "Повiдомлення успiшно вiдправлено!";
                    include $this->prefix . "/errors/info.php";
                } else {
                    $data['message'] = "Повiдомлення не вiдправлено!";
                    include $this->prefix . $this->defaultPage . "/errors/critical.php";
                }

            } else {
                $this->view->generate("messages/send.php");
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_tickets()
    {
        if($this->accessGranted())
        {
            $data=$this->model->get_tickets();
            $this->view->generate("users/tickets.php",$data);
        }
        else
            $this->redirect_to_main($this->defaultPage);
    }

    function action_choose_ticket()
    {
        if($this->accessGranted())
        {
            $request_uri=$_SERVER['REQUEST_URI'];
            $routes = explode('/', $request_uri);
            if (!empty($routes[4]))
			{
                $data['ticket'] = $routes[4];
                $this->model->get_questions_of_ticket($data);
                $this->view->generate("users/test.php", $data);
            }
        }
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
