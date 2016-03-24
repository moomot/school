<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 13.03.16
 * Time: 11:12
 */

Class Model_Cpanel extends Model {
    function get_school_auth_data($login) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT password, uid FROM schools WHERE login=:login");
            $stmt->bindParam(":login", $login);
            $stmt->execute();
            $out_data = $stmt->fetch(PDO::FETCH_ASSOC);
            if($out_data) {
                $data['status'] = true;
            } else {
                if($stmt->rowCount() == 0)
                {
                    $data['status'] = false;
                }
            }
            $data['password'] = $out_data['password'];
            $data['uid'] = $out_data['uid'];

            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $data;
    }

    function get_students_list()
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->query("SELECT id, login, firstname, lastname, address FROM users");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $data;
    }

    function get_output_pm() {
        $uid = Session::get("uid");
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');


            $stmt = $_dbh->prepare("SELECT message, login FROM private_messages, admins WHERE user_id = :user_id AND admins.uid = user2_id");
            $stmt->bindParam(":user_id", $uid);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            $stmt = $_dbh->prepare("SELECT message, login FROM private_messages, admins WHERE user2_id = :user_id AND admins.uid = private_messages.user_id");
            $stmt->bindParam(":user_id", $uid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_receivers()
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $stmt = $_dbh->query("SELECT login, uid FROM admins UNION SELECT login, uid FROM users");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function send_message($data) {
        $uid = Session::get("uid");
        if (! $this->is_user_exists($data['school_name'])) {
            return false;
        }
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get school id by login
            $stmt = $_dbh->prepare("SELECT uid FROM admins WHERE login = :login UNION SELECT uid FROM users WHERE login = :login");
            $stmt->bindParam(":login", $data['school_name']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $reciever_id = $result['uid'];

            // Get timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();


            // INSERT PM
            $stmt = $_dbh->prepare("INSERT INTO private_messages (user_id, user2_id, message, timestamp) VALUES (:user_id, :user2_id, :message, :timestamp)");

            $stmt->bindParam(":user_id", $uid);
            $stmt->bindParam(":user2_id", $reciever_id);
            $stmt->bindParam(":message", $data['message']);
            $stmt->bindParam(":timestamp", $timestamp);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    private function is_user_exists($login) {
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT login, uid FROM admins WHERE login = :login UNION SELECT login, uid FROM users WHERE login = :login");
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

    function get_users()
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $stmt = $_dbh->query("SELECT login, lections_available FROM users");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }


}