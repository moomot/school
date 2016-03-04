<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 11:08 PM
 */
class Controller_Index extends Controller
{
    function action_index() {
        try {
            $this->view->generate("main.php");
        } catch (CustomException $e)
        {
            $exception_path = PATH_SITE."/application/views/exception/exception.php";
            if ( file_exists($exception_path) ) {
                include $exception_path;
            }
        }
    }
}