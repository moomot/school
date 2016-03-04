<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 6:33 PM
 */
class Model_Static extends Model
{
    function getData($param)
    {
        try {
            // SQL Query
            $sql = "SELECT * FROM static_pages WHERE url = :url";

            // Connect to DB, set charset
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Prepare and execute query
            $query = $_dbh->prepare($sql);
            $query->execute(array(':url' => $param));

            $result = $query->fetch(PDO::FETCH_OBJ);

            $_dbh = null;
            if( !empty($result) ) {
                return $result;
            } else
            {
                return null;
            }
        } catch (PDOException $e) {
            throw new CustomException("PDO error");
        }
    }

}