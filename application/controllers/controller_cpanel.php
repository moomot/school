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
    public $prefix;

    /**
     * Controller_Admin constructor.
     * @param string $prefix
     */
    public function __construct() {
        $this->view = new View();
        $this->prefix = PATH_SITE . "/application/views/";
    }

    function action_index()
    {
        if ( $this->accessGranted() )
            $this->view->generateCpTpl($this->defaultPage."/dashboard.php");
        else
            $this->view->generateCpTpl($this->defaultPage."/login.php");
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
                $data = $this->model->get_school_auth_data($login);

                if (!empty($data['status'])) {
                    if ($data['status']) {
                        if (md5($password) == $data['password']) {
                            Session::set("school_login_status", "access_granted");
                            Session::set("uid", $data['uid']);;
                            $this->redirect_to_main("/" . $this->defaultPage);
                        } else {
                            Session::set("school_login_status", "access_denied");
                            $this->redirect_to_main("/" . $this->defaultPage);
                        }
                    }
                } else {
                    Session::set("school_login_status", "access_denied");
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

    function action_list()
    {
        if ( $this->accessGranted() ) {
            $data = $this->model->get_students_list();
            $this->view->generateCpTpl($this->defaultPage."/list/index.php", $data);
        }
        else
        {
            $this->redirect_to_main("/".$this->defaultPage);
        }
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

        if ( $this->accessGranted() ) {
            $data = $this->model->get_receivers();
            $this->view->generateCpTpl($this->defaultPage."/messages/send.php", $data);
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
        try {
            $this->model->save_settings($data);
        } catch (CustomException $e) {
            $exception_path = PATH_SITE."/application/views/exception/exception.php";
            if ( file_exists($exception_path) ) {
                include $exception_path;
            }
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
        include $this->prefix . $this->defaultPage . "/messages/messages.php";
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
        include $this->prefix . $this->defaultPage . "/messages/messages.php";
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
                    include $this->prefix . $this->defaultPage . "/errors/info.php";
                } else {
                    $data['message'] = "Повiдомлення не вiдправлено!";
                    include $this->prefix . $this->defaultPage . "/errors/critical.php";
                }

            } else {
                $this->view->generateAdminTpl($this->defaultPage . "/messages/send.php");
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_lections_settings()
    {
        if ($this->accessGranted()) {
            $data = $this->model->get_users();

            $this->view->generateCpTpl($this->defaultPage . "/lections_settings/index.php");
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    private function accessGranted()
    {
        return Users::getSchoolLoginStatus()=="access_granted";
    }


}