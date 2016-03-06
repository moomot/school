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
    function get_settings($login)
    {
        try {


            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $stmt = $_dbh->prepare("SELECT password FROM admins WHERE login=:login");
            $stmt->bindParam(":login", $login);
            $result = $stmt->execute();

            if($result) {
                $data['status'] = true;
            } else {
                if($stmt->rowCount() == 0)
                {
                    $data['status'] = false;
                }
            }
            $out_data = $stmt->fetch(PDO::FETCH_ASSOC);

            $data['password'] = $out_data['password'];
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $data;
    }

    function get_site_templates()
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

    function get_schools() {
        try {
            $sql = "SELECT id, login, full_name, phone FROM schools";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $query = $_dbh->query($sql);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function is_school_exists($login) {
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT login FROM schools WHERE login=:login");
            $stmt->bindParam(":login", $login);
            $stmt->execute();
            $result = $stmt->rowCount();
            $result = $result > 0 ? true : false;
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function add_school($data) {
        if ($this->is_school_exists($data['login'])) {
            echo "fl";
            return false;
        }
        try {
            unset($data['add']);

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("INSERT INTO schools (login, address, password, full_name, phone, description, email) VALUES (:login, :address, :password, :full_name, :phone, :description, :email)");

            $stmt->bindParam(":login", $data['login']);
            $stmt->bindParam(":address", $data['address']);
            $stmt->bindParam(":password", $data['password']);
            $stmt->bindParam(":full_name", $data['full_name']);
            $stmt->bindParam(":phone", $data['phone']);
            $stmt->bindParam(":description", $data['description']);
            $stmt->bindParam(":email", $data['email']);

            $result = $stmt->execute();
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_input_pm() {
        $uid = Session::get("uid");
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT message, login FROM private_messages, schools WHERE user2_id = :user_id AND schools.id = user_id");
            $stmt->bindParam(":user_id", $uid);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }
}