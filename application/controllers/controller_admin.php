<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/30/16
 * Time: 9:17 PM
 */
class Controller_Admin extends Controller
{
    public $defaultPage = "admin";
    public $prefix = PATH_SITE . "/application/views/";

    function action_index()
    {
        if ( $this->accessGranted() )
            $this->view->generateAdminTpl($this->defaultPage."/dashboard.php");
        else
            $this->view->generateAdminTpl($this->defaultPage."/login.php");
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
                $data = $this->model->get_settings($login);
                if($data['status']) {
                    if( md5($password)===$data['password'] )
                    {
                        Session::set("login_status", "access_granted");
                        Session::set("uid", $data['uid']);;
                        $this->redirect_to_main("/".$this->defaultPage);
                    }
                    else
                    {
                        Session::set("login_status", "access_denied");
                        $this->redirect_to_main("/".$this->defaultPage);
                    }
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
        if ( $this->accessGranted() ) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if(!empty($routes[3])) {
                $data = $this->model->get_school_by_login($routes[3]);
                if($this->model->is_school_exists($routes[3])) {
                    $this->view->generateAdminTpl($this->defaultPage . "/list/user.php", $data);
                }
                else
                {
                    $data['message'] = "Школа не знайдена";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_schools();
                $this->view->generateAdminTpl($this->defaultPage."/list/index.php", $data);
            }

        }
        else {
            $this->redirect_to_main("/".$this->defaultPage);
        }
    }

    function action_messages()
    {
        if ( $this->accessGranted() )

            $this->view->generateAdminTpl($this->defaultPage."/messages/index.php");
        else
            $this->redirect_to_main("/".$this->defaultPage);
    }

    function action_send_message()
    {
        $data = $this->model->get_schools();
        if ( $this->accessGranted() )
            $this->view->generateAdminTpl($this->defaultPage."/messages/send.php", $data);
        else
            $this->redirect_to_main("/".$this->defaultPage);
    }

    function action_submit_send_message()
    {
        if ( $this->accessGranted() ) {
            ob_clean();
            ob_start();
            if(isset($_POST)) {
                $result = $this->model->send_message($_POST);
                if($result) {
                    $data['message'] = "Повiдомлення успiшно вiдправлено!";
                    include $this->prefix . $this->defaultPage . "/errors/info.php";
                } else {
                    $data['message'] = "Повiдомлення не вiдправлено!";
                    include $this->prefix . $this->defaultPage . "/errors/critical.php";
                }

            } else {
                $this->view->generateAdminTpl($this->defaultPage . "/messages/send.php");
            }
        }
        else {
            $this->redirect_to_main("/".$this->defaultPage);
        }

    }

    function action_settings()
    {
        if ( $this->accessGranted() )
        {
            $data = $this->model->get_settings();
            $data['tpl_list'] = $this->model->get_site_templates();
            $this->view->generateAdminTpl($this->defaultPage."/settings/index.php", $data);
        }
        else
        {
            $this->redirect_to_main("/".$this->defaultPage);
        }
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
        $this->model->save_settings($data);
    }

    function action_add_school()
    {
        if ( $this->accessGranted() ) {
            if(isset($_POST['add'])) {
                $_POST['password'] = md5($_POST['password']);
                $result = $this->model->add_school($_POST);
                if($result) {
                    $data['message'] = "Школа успешно добавлена!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/info.php", $data);
                } else {
                    $data['message'] = "Ошибка в добавлении школы!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }

            } else {
                $this->view->generateAdminTpl($this->defaultPage . "/school/add.php");
            }
        }
        else {
            $this->redirect_to_main("/".$this->defaultPage);
        }

    }

    function action_input_pm() {
        $data = $this->model->get_input_pm();
        if(sizeof($data) == 0) {
            $data['status'] = "Сообщений нет";
        }
        ob_clean();
        ob_start();
        include $this->prefix . $this->defaultPage . "/messages/messages.php";
    }
    function action_output_pm() {
        $data = $this->model->get_output_pm();
        if(sizeof($data) == 0) {
            $data['status'] = "Сообщений нет";
        }
        ob_clean();
        ob_start();
        include $this->prefix . $this->defaultPage . "/messages/messages.php";
    }



}