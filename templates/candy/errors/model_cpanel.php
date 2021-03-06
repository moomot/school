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

    function get_login_by_id ($id) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT login FROM schools WHERE uid=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
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


            $stmt = $_dbh->prepare("SELECT message, login FROM private_messages, users WHERE user_id = :user_id AND users.uid = user2_id");
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
            $stmt = $_dbh->query("SELECT login, uid FROM users");
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
            $stmt = $_dbh->prepare("SELECT uid FROM users WHERE login = :login");
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

    function is_user_exists($login) {
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

    function add_user($data) {
        if ($this->is_user_exists($data['login'])) {
            return false;
        }
        try {
            unset($data['add']);

            $school_id = Session::get("uid");

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // SELECT UID
            $result = $_dbh->query("SELECT * FROM unical_users_id");
            $uid = $result->fetch(PDO::FETCH_ASSOC);
            $uid = $uid['uid'];

            // INSERT USER
            $stmt = $_dbh->prepare("INSERT INTO `users`(`login`, `firstname`, `lastname`, `address`, `school_id`, `password`, `uid`) VALUES (:login, :firstname, :lastname, :address, :school_id, :password, :uid)");

            $stmt->bindParam(":login", $data['login']);
            $stmt->bindParam(":address", $data['address']);
            $stmt->bindParam(":password", $data['password']);
            $stmt->bindParam(":firstname", $data['firstname']);
            $stmt->bindParam(":lastname", $data['lastname']);
            $stmt->bindParam(":school_id", $school_id);
            $stmt->bindParam(":uid", $uid);

            $result = $stmt->execute();


            // INCREMENT unical_users_id uid field
            $_dbh->query("UPDATE `unical_users_id` SET `uid` = `uid` + 1 WHERE 1");
            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function save_user($data)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            // UPDATE USER
            $stmt = $_dbh->prepare("UPDATE users SET `login`=:login, `address` = :address, `password` = :password, `firstname` = :firstname, `lastname` = :lastname, `status` = :status, `available_lections` = :available_lections WHERE `uid` = :uid");


            $stmt->bindParam(":login", $data['login']);
            $stmt->bindParam(":address", $data['address']);
            $stmt->bindParam(":password", $data['password']);
            $stmt->bindParam(":firstname", $data['firstname']);
            $stmt->bindParam(":lastname", $data['lastname']);
            $stmt->bindParam(":status", $data['status']);
            $stmt->bindParam(":uid", $data['uid']);
            $stmt->bindParam(":available_lections", $data['available_lections']);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function remove_user($login) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            // UPDATE USER
            $stmt = $_dbh->prepare("DELETE FROM users WHERE `login` = :login");

            $stmt->bindParam(":login", $login);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_user_by_login($login) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT * FROM users WHERE login=:login");
            $stmt->bindParam(":login", $login);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    /* Ticket feedback */
    function send_ticket($data)
    {
        $uid = Session::get("uid");
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();


            // INSERT PM
            $stmt = $_dbh->prepare("INSERT INTO feedback (`title`) VALUES (:title)");

            $stmt->bindParam(":title", $data['title']);
            $result = $stmt->execute();
            if( $result != null ) {
                $feedback_id = $_dbh->lastInsertId();
                $stmt = $_dbh->prepare("INSERT INTO feedback_messages (ticket_id, user_id, timestamp, message) VALUES (:ticket_id, :user_id, :timestamp, :message)");
                $stmt->bindParam(":message", $data['message']);
                $stmt->bindParam(":timestamp", $timestamp);
                $stmt->bindParam(":user_id", $uid, PDO::PARAM_INT);
                $stmt->bindParam(":ticket_id", $feedback_id);
                $result = $stmt->execute();
            }

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_tickets($status)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $result = $_dbh->query("SELECT * FROM feedback WHERE status = $status")->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_ticket_options($id)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT * FROM feedback WHERE id=:id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_ticket($id)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT timestamp, message, login FROM feedback f,
feedback_messages fm, (SELECT login, uid FROM schools
UNION
SELECT login, uid FROM admins) as tmp
WHERE f.id = :id AND fm.ticket_id = f.id AND tmp.uid = fm.user_id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function send_ticket_message($data)
    {
        $uid = Session::get("uid");
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $stmt = $_dbh->prepare("INSERT INTO feedback_messages (ticket_id, user_id, timestamp, message) VALUES (:ticket_id, :user_id, :timestamp, :message)");
            $stmt->bindParam(":message", $data['message']);
            $stmt->bindParam(":timestamp", $timestamp);
            $stmt->bindParam(":user_id", $uid, PDO::PARAM_INT);
            $stmt->bindParam(":ticket_id", $data['ticket_id'], PDO::PARAM_INT);
            $result = $stmt->execute();


            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function close_ticket($id)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("UPDATE feedback SET status = 0 WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }
    /* *************************** */

}