<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 19:27
 */
class Controller_Form extends Controller
{
    function action_send()
    {
        $this->model->add_form($_POST);
    }

    function action_send_feedback()
    {
        echo "SEND FORM";
    }

    function action_test()
    {
        $str = "[{\"role\":\"name\",\"label\":\"Як до Вас звертатись\",\"value\":\"sdfsdf\"},{\"role\":\"general\",\"label\":\"Мiсто\",\"value\":\"sdffsdsdf\"},{\"role\":\"phone\",\"label\":\"Телефон\",\"value\":\"33332423\"}]";
        $decoded = json_decode($str);
        $format_str = "";
        foreach($decoded as $item)
        {
            $label = $item->{'label'};
            $val = $item->{'value'};
            $format_str .= $label . ": " . $val . "<br>";
        }
        echo $format_str;
    }
}