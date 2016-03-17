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
       // $path = PATH_SITE;
        //нахожу в строке название сайта
//        $pos = strrpos($path,DIRECTORY_SEPARATOR);
//        //извлекаю название
//        self::$baseurl = "/".substr($path,(int) $pos+1);
        self::$baseurl = implode('/', array_slice(explode('/', $_SERVER['PHP_SELF']), 0, -1));
    }
    public static function formURL($name)
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ', "&quot;", "ї", "і");
        $lat = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_', "", 'yi', 'i');
        return str_replace($rus, $lat, $name);
    }
}