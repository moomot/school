<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 6:33 PM
 */
class Model_Admin extends Model
{
    /**
     * Save site settings to table "settings"
     * @param $data
     * @throws CustomException
     */
    function save_settings($data)
    {
        try {
            $sql = "UPDATE settings SET val = ? WHERE param = ?";
            // Connect to DB, set charset
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $query = $_dbh->prepare($sql);

            foreach ($data as $param => $val) {
                // Execute query
                $query->execute(array($val, $param));
            }

            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
    }

    /**
     * Get site settings from "settings" table
     * @return array
     * @throws CustomException
     */
    function get_settings()
    {
        $data = [];
        try {
            $sql = "SELECT param, val FROM settings";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $query = $_dbh->query($sql);

            while ($result = $query->fetch(PDO::FETCH_OBJ)) {
                $data[$result->param] = $result->val;
            }
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $data;
    }

    function getSiteTemplates()
    {
        $data = [];
        foreach (new DirectoryIterator(TEMPLATES_DIR) as $fileInfo) {
            if ($fileInfo->isDot() || $fileInfo->isFile()) continue;
            if (file_exists($fileInfo->getPathname() . "/tpl_info.xml")) {
                array_push($data, $fileInfo->getFilename());
            }
        }
        return $data;
    }
}