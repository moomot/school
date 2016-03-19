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
        if ($this->accessGranted())
            $this->view->generateAdminTpl($this->defaultPage . "/dashboard.php");
        else
            $this->view->generateAdminTpl($this->defaultPage . "/login.php");
    }

    function action_login()
    {
        if ($this->accessGranted()) {
            $this->redirect_to_main("/" . $this->defaultPage);
        } else {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $data = $this->model->get_admin($login);
                if (!empty($data['status'])){
                if ($data['status']) {
                    if (md5($password) == $data['password']) {
                        Session::set("admin_login_status", "access_granted");
                        Session::set("uid", $data['uid']);;
                        $this->redirect_to_main("/" . $this->defaultPage);
                    } else {
                        Session::set("admin_login_status", "access_denied");
                        $this->redirect_to_main("/" . $this->defaultPage);
                    }
                }
                } else {
                    Session::set("admin_login_status", "access_denied");
                    $this->redirect_to_main("/" . $this->defaultPage);
                }

            } else {
                $this->redirect_to_main("/" . $this->defaultPage);
            }
        }
    }

    function action_logout()
    {
        Session::destroy();
        header('Location:' . Url::$baseurl);
    }

    function action_settings()
    {
        if ( $this->accessGranted() ) {
            $data = $this->model->get_settings();
            $data['tpl_list'] = $this->model->get_site_templates();
            $this->view->generateAdminTpl($this->defaultPage . "/settings/index.php", $data);
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
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


    function action_messages()
    {
        if ($this->accessGranted())
            $this->view->generateAdminTpl($this->defaultPage . "/messages/index.php");
        else
            $this->redirect_to_main("/" . $this->defaultPage);
    }

    function action_send_message()
    {
        $data = $this->model->get_schools();
        if ($this->accessGranted())
            $this->view->generateAdminTpl($this->defaultPage . "/messages/send.php", $data);
        else
            $this->redirect_to_main("/" . $this->defaultPage);
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

    /**
     * Add school page
     */
    function action_add_school()
    {
        if ($this->accessGranted()) {
            if (isset($_POST['add'])) {
                $_POST['password'] = md5($_POST['password']);
                $result = $this->model->add_school($_POST);
                if ($result) {
                    $data['message'] = "Школа успешно добавлена!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/info.php", $data);
                } else {
                    $data['message'] = "Ошибка в добавлении школы!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }

            } else {
                $this->view->generateAdminTpl($this->defaultPage . "/school/add.php");
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_list()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data = $this->model->get_school_by_login($routes[3]);
                if ($this->model->is_school_exists($routes[3])) {
                    $this->view->generateAdminTpl($this->defaultPage . "/school/user.php", $data);
                } else {
                    $data['message'] = "Школа не знайдена";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_schools();
                $this->view->generateAdminTpl($this->defaultPage . "/school/index.php", $data);
            }

        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_edit_school()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data = $this->model->get_school_by_login($routes[3]);
                if ($this->model->is_school_exists($routes[3])) {
                    $this->view->generateAdminTpl($this->defaultPage . "/school/edit.php", $data);
                } else {
                    $data['message'] = "Школа не знайдена";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_schools();
                $this->view->generateAdminTpl($this->defaultPage . "/school/index.php", $data);
            }

        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_save_school()
    {
        if ($this->accessGranted()) {
            $this->model->save_school($_POST);
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_remove_school()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                if ($this->model->remove_school($routes[3])) {
                    $data['message'] = "Видалено успiшно!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/info.php", $data);
                } else {
                    $data['message'] = "Помилка при видаленнi";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    /* Static pages */
    function action_pages()
    {
        if ($this->accessGranted()) {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data = $this->model->get_page_by_url($routes[3]);
                if ($this->model->is_page_exists($routes[3])) {
                    $this->view->generateAdminTpl($this->defaultPage . "/pages/page.php", $data);
                } else {
                    $data['message'] = "Сторiнка не знайдена";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_pages();
                $this->view->generateAdminTpl($this->defaultPage . "/pages/index.php", $data);
            }

        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_add_page()
    {
        if ($this->accessGranted()) {
            if (isset($_POST['add'])) {

                $result = $this->model->add_page($_POST);
                if ($result) {
                    $data['message'] = "Сторiнка успiшно створена!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/info.php", $data);
                } else {
                    $data['message'] = "Помилка у створеннi сторiнки!";
                    $this->view->generateAdminTpl($this->defaultPage . "/errors/critical.php", $data);
                }

            } else {
                $this->view->generateAdminTpl($this->defaultPage . "/pages/add.php");
            }
        } else {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_lectures()
    {
        if ($this->accessGranted())
        {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            $data['lectures'] = $this->model->get_lectures();
            $data['current_lecture']=-1;
            if (!empty($routes[3]))
            {
                $data['current_lecture']=$routes[3];
                $this->model->get_questions($data);
            }
            $this->view->generateAdminTpl($this->defaultPage . "/lectures/index.php", $data);
        } 
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_add_lecture()
    {
        if($this->accessGranted())
        {
            if(isset($_POST['save']))
            {
                $this->model->add_lecture($_POST);
                $this->forward_index($_POST['number']);
            }
            else
            {
                $data['create']=true;
                $this->view->generateAdminTpl($this->defaultPage . "/lectures/handle_lecture.php",$data);
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_edit_lecture()
    {
        if($this->accessGranted())
        {
            if(isset($_POST['save']))
            {
                $this->model->edit_lecture($_POST);
                $this->forward_index($_POST['number']);
            }
            else
            {
                $base = Url::$baseurl;
                $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
                $routes = explode('/', $request_uri);
                $data['number']=$routes[3];
                $data['name']=$this->model->get_lecture_name($routes[3]);
                $this->view->generateAdminTpl($this->defaultPage . "/lectures/handle_lecture.php",$data);
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_remove_lecture()
    {
        if($this->accessGranted())
        {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            $this->model->remove_lecture($routes[3]);
            $this->forward_index();
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_add_question()
    {
        if($this->accessGranted())
        {
            if(isset($_POST['save']))
            {
                $this->model->add_question($_POST);
                $this->forward_index($_POST['lecture']);
            }
            else
            {
                $base = Url::$baseurl;
                $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
                $routes = explode('/', $request_uri);
                $data['lecture']=$routes[3];
                $data['create']=true;
                $this->view->generateAdminTpl($this->defaultPage . "/lectures/handle_question.php",$data);
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_edit_question()
    {
        if($this->accessGranted())
        {
            if(isset($_POST['save']))
            {
                $this->model->edit_question($_POST);
                $this->forward_index($_POST['lecture']);
            }
            else
            {
                $base = Url::$baseurl;
                $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
                $routes = explode('/', $request_uri);
                $data['id']=$routes[3];
                $result=$this->model->get_question_by_id($routes[3]);
                $data=array_merge($data,$result);
                $this->view->generateAdminTpl($this->defaultPage . "/lectures/handle_question.php",$data);
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_remove_question()
    {
        if($this->accessGranted())
        {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            $this->model->remove_question($routes[3]);
            $this->forward_index();
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_add_variant()
    {
        if($this->accessGranted())
        {
            if(isset($_POST['save']))
            {
                $this->model->add_variant($_POST);
                $this->forward_index($_POST['lecture']);
            }
            else
            {
                $base = Url::$baseurl;
                $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
                $routes = explode('/', $request_uri);
                $data['question']=$routes[3];
                $data['lecture']=$routes[4];
                $this->view->generateAdminTpl($this->defaultPage . "/lectures/add_variant.php",$data);
            }
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    function action_remove_variant()
    {
        if($this->accessGranted())
        {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            $this->model->remove_variant($routes[3]);
            $this->forward_index($routes[4]);
        }
        else
        {
            $this->redirect_to_main("/" . $this->defaultPage);
        }
    }

    private function forward_index($lecture=-1)
    {
        $data['lectures'] = $this->model->get_lectures();
        $data['current_lecture']=$lecture;
        if($lecture!=-1) $this->model->get_questions($data);
        $this->view->generateAdminTpl($this->defaultPage . "/lectures/index.php",$data);
    }

    private function accessGranted()
    {
        return Users::getAdminLoginStatus()=="access_granted";
    }


}