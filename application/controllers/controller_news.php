<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 13:03
 */
class Controller_News extends Controller
{
    function action_index()
    {
            $base = Url::$baseurl;
            $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
            $routes = explode('/', $request_uri);
            if (!empty($routes[3])) {
                $data = $this->model->get_news_item($routes[3]);
                if ($this->model->is_news_exists($routes[3])) {
                    $this->view->generate($this->defaultPage . "/news/edit.php", $data);
                } else {
                    $data['message'] = "Новина не знайдена";
                    $this->view->generate($this->defaultPage . "/errors/critical.php", $data);
                }
            } else {
                $data = $this->model->get_news();
                $this->view->generate("/news/index.php", $data);
            }
    }

    function action_page()
    {
        $base = Url::$baseurl;
        $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
        $routes = explode('/', $request_uri);
        if (!empty($routes[3])) {
            $data = $this->model->get_news_item($routes[3]);
            if ($this->model->is_news_exists($routes[3])) {
                $this->view->generate($this->defaultPage . "/news/item.php", $data);
            } else {
                $data['message'] = "Новина не знайдена";
                $this->view->generate($this->defaultPage . "/errors/critical.php", $data);
            }
        }
    }
}