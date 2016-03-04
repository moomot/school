<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/6/16
 * Time: 11:52 PM
 */
class Application
{
    public $_config = "";
    private $_db_h;
    private static $_instance; //The single instance
    private $settings = [];


    /**
     * @return Application instance
     */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->_config = self::getConfig();
        try {
            $db = Database::getInstance();
            $this->_db_h = $db->getConnection();
            $this->_db_h->exec('SET NAMES utf8');

            $this->setTemplate();
            $this->setOnReconstruction();
            $this->setSettings();

        } catch (CustomException $e) {
            $exception_path = PATH_SITE . '/application/views/exception/exception.php';
            if ( file_exists($exception_path) )
            {
                include $exception_path;
            } else {
                echo "Exception view not found";
                exit;
            }
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }

    /**
     * Get template PATH from config
     * @return bool|string
     */
    public function getTemplatePath() {
        if(is_dir(PATH_SITE.'/templates/'.$this->_config->template)) {
            $template = PATH_SITE.'/templates/'.$this->_config->template;
            return $template;
        }
        return false;
    }

    public function getTemplateName() {
        return $this->_config->template;
    }

    /**
     * Get config object
     * @return Config
     */
    public static function getConfig() {
        require_once(PATH_SITE.'/configuration.php');
        return new Config();
    }

    /**
     * Get PDO
     * @return PDO
     */
    public function getDBH() {
        return $this->_db_h;
    }

    private function setTemplate() {
        // Set params to config
        $sql = 'SELECT param, val FROM settings WHERE param = :param';
        // Prepare and execute query
        $query = $this->_db_h->prepare($sql);
        $query->execute(array(':param' => 'template'));
        $result = $query->fetch(PDO::FETCH_OBJ);
        $this->_config->setTemplate($result->val);
    }

    private function setOnReconstruction() {
        // Set params to config
        $sql = 'SELECT param, val FROM settings WHERE param = :param';
        // Prepare and execute query
        $query = $this->_db_h->prepare($sql);
        $query->execute(array(':param' => 'onReconstruction'));
        $result = $query->fetch(PDO::FETCH_OBJ);
        $val = $result->val == 1 ? true : false;
        $this->_config->setOnReconstruction($val);
    }

    public function isOnReconstruction()
    {
        return $this->_config->onReconstruction;
    }

    private function setSettings()
    {
        try {
            $sql = "SELECT param, val FROM settings";

            $this->_db_h->exec('SET NAMES utf8');

            $query = $this->_db_h->query($sql);

            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $this->settings[$result->param] = $result->val;
            }
            $_dbh = null;
        } catch(PDOException $e)
        {
            throw new CustomException("Query error");
        }
    }

    public function getSettings()
    {
        return $this->settings;
    }
}