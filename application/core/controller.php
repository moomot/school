<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 10:53 PM
 */
class Controller
{
    public $model = null;
    public $view = null;
    public $defaultPage = "/";

    function __construct()
    {
        $this->view = new View();
    }

    // действие (action), вызываемое по умолчанию
    function action_index()
    {
        header("Location: ".Url::$baseurl);
    }

    function getModel($model_name) {
        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
            $this->model = new $model_name;
        }
    }


    public function redirect_to_main($redirectPage = "/")
    {
        header('Location:'.Url::$baseurl.$redirectPage);
    }
}