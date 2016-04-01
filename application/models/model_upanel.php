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
}