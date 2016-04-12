<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 19:41
 */
class Model_Form extends Model
{
    function add_form($data)
    {
        $decoded = json_decode($data['checks']);
        $format_str = "";
        foreach($decoded as $item)
        {
            $label = $item->{'label'};
            $val = $item->{'value'};
            $format_str .= $label . ": " . $val . "<br>";
        }

        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();

            // Insert page

            $stmt = $_dbh->prepare("INSERT INTO form (timestamp, content)
                                    VALUES (:timestamp, :content)");
            $stmt->bindParam(":content", $format_str);
            $stmt->bindParam(":timestamp", $timestamp);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }
}