<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 11:27 PM
 */
class Url
{
    public static $baseurl = '';
    /**
     * Метод получения базового урл сайта
     * Пример: из 'localhost/test-site' -> '/test-site'
     * @return string
     */
    public static function init()
    {
        $path = PATH_SITE;
        //нахожу в строке название сайта
        $pos = strrpos($path,DIRECTORY_SEPARATOR);
        //извлекаю название
        self::$baseurl = "/".substr($path,(int) $pos+1);
    }
}