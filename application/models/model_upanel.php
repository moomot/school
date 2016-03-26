<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 27.03.16
 * Time: 0:14
 */
class Model_Upanel extends Model
{
    function get_lectures()
    {
        try
        {
            $sql = "SELECT number, name FROM lectures ORDER BY number";

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
}