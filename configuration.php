<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 10:48 PM
 */
class Config {
    public $db_host = "localhost";
    public $db_user = "root";
    public $db_password = "";
    public $db_name = "school_cms";

   // public $template = "cand32y";
    public $onReconstruction = false;

    /**
     * @param boolean $onReconstruction
     */
    public function setOnReconstruction($onReconstruction)
    {
        $this->onReconstruction = $onReconstruction;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }


}
