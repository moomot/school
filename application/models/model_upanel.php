<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 27.03.16
 * Time: 0:14
 */
class Model_Upanel extends Model
{
    function get_user_auth_data($login) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT password, uid FROM users WHERE login=:login");
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
    function get_lectures()
    {
        $uid = Session::get("uid");
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $stmt = $_dbh->prepare("SELECT available_lections FROM users WHERE uid=:uid");
            $stmt->bindParam(":uid", $uid);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data == null) return false;
            $sql = "SELECT number, name FROM lectures WHERE number IN (".$data['available_lections'].") ORDER BY number";
            $query = $_dbh->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }

        return $result;
    }

    function get_questions(&$pdata)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            //get questions for lecture
            $stmt = $_dbh->prepare("SELECT id,question FROM questions WHERE lecture=:lecture");
            $stmt->bindParam(":lecture", $pdata['current_lecture']);
            $stmt->execute();
            $pdata['questions']=$stmt->fetchAll();

            //get variants and add to our questions
            foreach($pdata['questions'] as &$item)
            {
                $sql = "SELECT id,answer,correct FROM variants WHERE question=$item[id]";
                $query = $_dbh->query($sql);
                $item['variants'] = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
    }

    function get_tickets()
    {
        try
        {
            $sql = "SELECT id, name FROM tickets";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $query = $_dbh->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }

        return $result;
    }

    function get_questions_of_ticket(&$pdata)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            //get questions for ticket
            $stmt = $_dbh->prepare("SELECT questions FROM tickets WHERE id=:id");
            $stmt->bindParam(":id", $pdata['ticket']);
            $stmt->execute();
            $q=$stmt->fetchAll();

            $pdata['questions']=explode(",",$q[0]['questions']);

            if($pdata['questions'][0]=="")
            {
                unset($pdata['questions'][0]);
                return;
            }

            //get variants and add to our questions
            foreach($pdata['questions'] as &$item)
            {
                $sql="select id,question from questions where id=$item";
                $query=$_dbh->query($sql);
                $item=$query->fetch(PDO::FETCH_ASSOC);

                $sql = "SELECT id,answer,correct FROM variants WHERE question=$item[id]";
                $query = $_dbh->query($sql);
                $item['variants'] = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
    }
    /* Messages */
    function get_receivers()
    {
        $uid = Session::get("uid");
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $sql = "SELECT school_id FROM users WHERE uid = :uid";
            $stmt = $_dbh->prepare($sql);
            $stmt->bindParam(":uid", $uid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC)['school_id'];
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function get_output_pm() {
        $uid = Session::get("uid");
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');


            $stmt = $_dbh->prepare("SELECT message, timestamp FROM private_messages WHERE user_id = :user_id");
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
            $stmt = $_dbh->prepare("SELECT message, timestamp FROM private_messages WHERE user2_id = :user_id");
            $stmt->bindParam(":user_id", $uid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function send_message($data) {
        $uid = Session::get("uid");

        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();


            // INSERT PM
            $stmt = $_dbh->prepare("INSERT INTO private_messages (user_id, user2_id, message, timestamp) VALUES (:user_id, :user2_id, :message, :timestamp)");

            $stmt->bindParam(":user_id", $uid);
            $stmt->bindParam(":user2_id", $data['school_name']);
            $stmt->bindParam(":message", $data['message']);
            $stmt->bindParam(":timestamp", $timestamp);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }
    /**********************/
    /* USTAT */
    function add_to_ustat()
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
            $stmt = $_dbh->prepare("INSERT INTO ustat (user_id, test_type, result, timestamp, right_tests, wrong_tests, test_id) VALUES (:user_id, :test_type, :result, :timestamp, :right_tests, :wrong_tests, :test_id)");

            $stmt->bindParam(":user_id", $uid);
            $stmt->bindParam(":test_type", $_POST['ticket_type']);
            $stmt->bindParam(":result", $_POST['result']);
            $stmt->bindParam(":timestamp", $timestamp);
            $stmt->bindParam(":right_tests", $_POST['right_tests']);
            $stmt->bindParam(":wrong_tests", $_POST['wrong_tests']);
            $stmt->bindParam(":test_id", $_POST['test_id']);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function isTestAvaliableForThisUser($test_id)
    {
        $uid = Session::get("uid");

        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // INSERT PM
            $stmt = $_dbh->prepare("SELECT result, timestamp, right_tests, wrong_tests FROM ustat WHERE test_type = 0 AND user_id = :user_id AND test_id = :test_id");
            $stmt->bindParam(":user_id", $uid);
            $stmt->bindParam(":test_id", $test_id);

            $result = $stmt->execute();
            $data['status'] = $result;

            if($stmt->rowCount() == 0)
            {
                $data['status'] = false;
            }
            else {
                $data['data'] = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $data;
    }

    function get_stats()
    {
        $uid = Session::get("uid");
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // INSERT PM
            $stmt = $_dbh->prepare("SELECT result, timestamp, right_tests, wrong_tests, test_type, test_id FROM ustat WHERE user_id = :user_id");
            $stmt->bindParam(":user_id", $uid);

            $result = $stmt->execute();
            $data['status'] = $result;

            if($stmt->rowCount() == 0)
            {
                $data['status'] = false;
            }
            else {
                $data['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $data;
    }
    /**********************/
}