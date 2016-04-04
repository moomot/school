<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 13:06
 */
class Model_News extends Model
{
    function get_news()
    {
        try {
            $sql = "SELECT id, title, url, content, timestamp, status, content_short FROM news WHERE status = 1";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }

        return $result;
    }

    function get_news_item($url)
    {
        try {
            $sql = "SELECT * FROM news WHERE url = :url AND status = 1";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare($sql);
            $stmt->bindParam(":url", $url);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }

        return $result;
    }

    function is_news_exists($name)
    {
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT title FROM news WHERE url=:url");
            $stmt->bindParam(":url", $name);
            $stmt->execute();
            $result = $stmt->rowCount();
            $result = $result > 0 ? true : false;
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }
}