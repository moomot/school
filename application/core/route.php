<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 10:55 PM
 */
class Route
{
    static function start() {
        // контроллер и действие по умолчанию
        $controller_name = 'Index';
        $action_name = 'index';

        $base = Url::$baseurl;
        $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
        $routes = explode('/', $request_uri);

        if($routes[1]=='?XDEBUG_SESSION_START=CCFE3E94')
            $routes[1]=null;

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        // получаем имя параметра
        if ( !empty($routes[3]) )
        {
            $param = $routes[3];
        }
        if ( !empty($base) )
            $param_cnt = -1;
        else
            $param_cnt = 0;

        $param_cnt += sizeof($routes);

        if( $controller_name == 'static') {
            $param = $action_name;
            $action_name = 'page';
        }

        //wtf?
        //if( $param_cnt >= 4 )
        //    Route::ErrorPage404();

        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;
        /*
        echo "Param: $param <br> ";
        echo "Model: $model_name <br>";
        echo "Controller: $controller_name <br>";
        echo "Action: $action_name <br>";
         */
        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
             */
            Route::ErrorPage404();
        }
        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        $controller->getModel($model_name);
        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            if( !isset($param) )
            {
                $controller->$action();
            }
            else
            {
                $controller->$action($param);
            }
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }
    }

    function ErrorPage404()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.Url::$baseurl.'/404');
    }
}