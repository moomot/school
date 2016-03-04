<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 1:13 PM
 */
class Controller_404 extends Controller
{

    function action_index()
    {
        header("HTTP/1.0 404 Not Found");
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        try {
            $this->view->generate("errors/404.php");
        } catch (CustomException $e)
        {
            $exception_path = PATH_SITE."/application/views/exception/exception.php";
            if ( file_exists($exception_path) ) {
                include $exception_path;
            }
        }
    }
}