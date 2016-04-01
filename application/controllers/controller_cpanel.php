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
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data = $this->model->get_user_by_login($routes[3]);
                if ($this->model->is_user_exists($routes[3])) {
                    $this->view->generateCpTpl($this->defaultPage . "/list/user.php", $data);
                } else {
                    $data['message'] = "Школа не знайдена";
                    $this->view->generateCpTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_students_list();
                $this->view->generateCpTpl($this->defaultPage . "/list/index.php", $data);
            }

        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_add_user()
    {
        if ($this->accessGranted()) {
            if (isset($_POST['add'])) {
                $_POST['password'] = md5($_POST['password']);
                $result = $this->model->add_user($_POST);
                if ($result) {
                    $data['message'] = "Студент успiшно створений!";
                    $this->view->generateCpTpl($this->defaultPage . "/errors/info.php", $data);
                } else {
                    $data['message'] = "Помилка у долученнi студента!";
                    $this->view->generateCpTpl($this->defaultPage . "/errors/critical.php", $data);
                }

            } else {
                $this->view->generateCpTpl($this->defaultPage . "/list/add.php");
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_edit_user()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data = $this->model->get_user_by_login($routes[3]);
                if ($this->model->is_user_exists($routes[3])) {
                    $this->view->generateCpTpl($this->defaultPage . "/list/edit.php", $data);
                } else {
                    $data['message'] = "Школа не знайдена";
                    $this->view->generateCpTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_schools();
                $this->view->generateCpTpl($this->defaultPage . "/list/index.php", $data);
            }

        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_save_user()
    {
        if ($this->accessGranted()) {
            $this->model->save_user($_POST);
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_remove_user()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                if ($this->model->remove_user($routes[3])) {
                    $data['message'] = "Видалено успiшно!";
                    $this->view->generateCpTpl($this->defaultPage . "/errors/info.php", $data);
                } else {
                    $data['message'] = "Помилка при видаленнi";
                    $this->view->generateCpTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
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

    /* Feedback */
    function action_feedback()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data['opt'] = $this->model->get_ticket_options($routes[3]);
                if ($data['opt'] == false) Route::ErrorPage404();

                $data['data'] = $this->model->get_ticket($routes[3]);
                $data['currentUserLogin'] = $this->model->get_login_by_id(Session::get("uid"));
                $this->view->generateCpTpl($this->defaultPage . "/feedback/ticket.php", $data);
            } else {
                $data['active_tickets'] = $this->model->get_tickets(1);
                $data['inactive_tickets'] = $this->model->get_tickets(0);
                $this->view->generateCpTpl($this->defaultPage . "/feedback/index.php", $data);
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_create_ticket()
    {
        if ($this->accessGranted()) {
            $this->view->generateCpTpl($this->defaultPage . "/feedback/create_ticket.php");
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_submit_ticket()
    {
        if ($this->accessGranted() && !empty($_POST)) {
            ob_clean();
            ob_start();
            $result = $this->model->send_ticket($_POST);
            if ($result) {
                $data['message'] = "Тiкет успiшно створений!";
                include $this->prefix . $this->defaultPage . "/errors/info.php";
            } else {
                $data['message'] = "Помилка!";
                include $this->prefix . $this->defaultPage . "/errors/critical.php";
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_answer_ticket()
    {
        if ($this->accessGranted() && !empty($_POST)) {
            ob_clean();
            ob_start();
            $result = $this->model->send_ticket_message($_POST);
            if ($result) {
                $data['message'] = "Повiдомлення вiдправлено!";
                include $this->prefix . $this->defaultPage . "/errors/info.php";
            } else {
                $data['message'] = "Помилка!";
                include $this->prefix . $this->defaultPage . "/errors/critical.php";
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_close_feedback()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            $result = $this->model->close_ticket($routes[3]);
            if ($result) {
                $data['message'] = "Успiшно закритий!";
            } else {
                $data['message'] = "Помилка!";
            }
            $this->view->generateCpTpl($this->defaultPage . "/errors/info.php", $data);
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }
    /************************/

    private function accessGranted()
    {
        return Users::getSchoolLoginStatus()=="access_granted";
    }


}