<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 11:31 PM
 */
class Loader
{
    public static function load($class)
    {
        $class = strtolower($class);
        $file_name = PATH_SITE.'/libraries/'.$class.'/'.$class.'.php';
        if(file_exists($file_name))
            include_once $file_name;
    }
    public static function init()
    {
        spl_autoload_register(array('Loader','load'));
    }
}