<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 1:16 PM
 */
class Database
{
    private $_connection;
    private static $_instance; //The single instance
    private $_host;
    private $_username;
    private $_password;
    private $_database;
    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct()
    {
        $config = Application::getConfig();
        $this->_host = $config->db_host;
        $this->_username = $config->db_user;
        $this->_password = $config->db_password;
        $this->_database = $config->db_name;
        try {
            $this->_connection  = new PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
        } catch (PDOException $e) {
            throw new CustomException("Database connection error");
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }
    // Get mysql pdo connection
    public function getConnection()
    {
        return $this->_connection;
    }
}
// usage:
//try {
//$sql = "SELECT * FROM posts";
//foreach ($this->_dbh->query($sql) as $row) {
//    var_dump($row);
//}
//$this->_dbh = null;
//} catch (PDOException $e) {
//    echo $e->getMessage();
//}
