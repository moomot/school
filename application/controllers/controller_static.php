<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 1:07 PM
 */
class Controller_Static extends Controller
{

    function action_index()
    {
        // Redirect while access to default index static page. Example site.com/static
        header("Location: ".Url::$baseurl);
    }

    function action_page($param) {

        // Get data PDO::FETCH_OBJ
        $data = $this->model->getData($param);

        // If there is no something data - redirect to 404
        // else - show static page
        if($data == null)
            header("Location: ".Url::$baseurl.'/404');
        else
            $this->view->generate("static.php", $data);
    }
}