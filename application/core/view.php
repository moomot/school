<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 10:54 PM
 */
class View
{

    /*
    $view - виды отображающие контент страниц;
    $data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
    */
    private $view;

    /**
     * View constructor.
     */

    public function __construct() {  }

    function generate($view, $data = null)
    {
        $this->view = $view;

        if ( file_exists(PATH_SITE."/application/views/index.php") )
        {
            // Include default index template
            include PATH_SITE."/application/views/index.php";
        }
        else
        {
            throw new CustomException("Шаблон не найден");
        }
    }

    function generateAdminTpl($view, $data = null)
    {
        $this->view = $view;

        include PATH_SITE . '/application/views/cpanel/index.php';
    }

    function getView() {
        $application = Application::getInstance();
        $template = $application->getTemplatePath();

        $view_path = $template."/".$this->view;
        try {
            if (!file_exists($view_path))
                throw new CustomException('Шаблон не найден');
            else
                return $view_path;
        } catch (Exception $e) {
            include PATH_SITE . '/application/views/exception/exception.php';
        }
    }

    function getPrivateView()
    {
        $view_path = PATH_SITE.'/application/views/'.$this->view;
        if( file_exists($view_path) )
        {
            return $view_path;
        } else {
            throw new CustomException('Шаблон не найден');
        }
    }
}