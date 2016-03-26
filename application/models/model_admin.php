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

    function get_admin($login)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $stmt = $_dbh->prepare("SELECT password, uid FROM admins WHERE login=:login");
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

    /**
     * Get site settings from "settings" table
     * @return array
     * @throws CustomException
     */
    function get_settings()
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $result = $_dbh->query("SELECT * FROM settings");
            $tmp_data = $result->fetchAll(PDO::FETCH_ASSOC);
            $data = [];
            foreach ($tmp_data as $item=>$val) {
                $data[$val['param']] = $val['val'];
            }

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
            $sql = "SELECT uid, login, full_name, phone FROM schools";

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

    function get_school_by_login($login) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT * FROM schools WHERE login=:login");
            $stmt->bindParam(":login", $login);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
            return false;
        }
        try {
            unset($data['add']);

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // SELECT UID
            $result = $_dbh->query("SELECT * FROM unical_users_id");
            $uid = $result->fetch(PDO::FETCH_ASSOC);
            $uid = $uid['uid'];

            // INSERT USER
            $stmt = $_dbh->prepare("INSERT INTO schools (login, address, password, full_name, phone, description, email, uid) VALUES (:login, :address, :password, :full_name, :phone, :description, :email, :uid)");

            $stmt->bindParam(":login", $data['login']);
            $stmt->bindParam(":address", $data['address']);
            $stmt->bindParam(":password", $data['password']);
            $stmt->bindParam(":full_name", $data['full_name']);
            $stmt->bindParam(":phone", $data['phone']);
            $stmt->bindParam(":description", $data['description']);
            $stmt->bindParam(":email", $data['email']);
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

    function save_school($data)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            // UPDATE USER
            $stmt = $_dbh->prepare("UPDATE schools SET `login`=:login, `address` = :address, `password` = :password, `full_name` = :full_name, `phone` = :phone, `description` = :description, `email` = :email WHERE `uid` = :uid");

            $pass = md5($data['password']);

            $stmt->bindParam(":login", $data['login']);
            $stmt->bindParam(":address", $data['address']);
            $stmt->bindParam(":password", $pass);
            $stmt->bindParam(":full_name", $data['full_name']);
            $stmt->bindParam(":phone", $data['phone']);
            $stmt->bindParam(":description", $data['description']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":uid", $data['uid']);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function remove_school($login) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            // UPDATE USER
            $stmt = $_dbh->prepare("DELETE FROM schools WHERE `login` = :login");

            $stmt->bindParam(":login", $login);

            $result = $stmt->execute();

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


            $stmt = $_dbh->prepare("SELECT message, login FROM private_messages, schools WHERE user_id = :user_id AND schools.uid = user2_id");
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
            $stmt = $_dbh->prepare("SELECT message, login FROM private_messages, schools WHERE user2_id = :user_id AND schools.uid = user_id");
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
        if (! $this->is_school_exists($data['school_name'])) {
            return false;
        }
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get school id by login
            $stmt = $_dbh->prepare("SELECT uid FROM schools WHERE login = :login");
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

    function get_pages() {
        try {
            $sql = "SELECT id, title, url FROM static_pages";

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

    function get_page_by_url($name) {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT * FROM static_pages WHERE url=:url");
            $stmt->bindParam(":url", $name);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function is_page_exists($name) {
        try {

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT title FROM static_pages WHERE url=:url");
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

    function add_page($data) {
        $url = Url::formURL($data['title']);
        if ($this->is_page_exists($url)) {
            return false;
        }
        try {
            unset($data['add']);

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            // Get timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();

            // Insert page

            $stmt = $_dbh->prepare("INSERT INTO static_pages (title, content, timestamp, status, comments_status, url)
                                    VALUES (:title, :content, :timestamp, :status, :comments_status, :url)");
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":content", $data['content']);
            $stmt->bindParam(":timestamp", $timestamp);
            $stmt->bindParam(":status", $data['status']);
            $stmt->bindParam(":comments_status", $data['comments_status']);
            $stmt->bindParam(":url", $url);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function save_page($data)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            // UPDATE USER
            $stmt = $_dbh->prepare("UPDATE static_pages SET `title`=:title, `content` = :content, `url` = :url, `comments_status` = :comments_status, `status` = :status WHERE `id` = :id");

            $url = Url::formURL($data['title']);
            $stmt->bindParam(":title", $data['title']);
            $stmt->bindParam(":content", $data['content']);
            $stmt->bindParam(":url", $url);
            $stmt->bindParam(":comments_status", $data['comments_status']);
            $stmt->bindParam(":status", $data['status']);
            $stmt->bindParam(":id", $data['id']);

            $result = $stmt->execute();

            $_dbh = null;

        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
    }

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

    //$lecture [in] number of lecture
    function get_lecture_name($lecture)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT name FROM lectures WHERE number=:lecture");
            $stmt->bindParam(":lecture", $lecture);
            $stmt->execute();
            $result=$stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result[0]['name'];
    }

    //$pdata [in,out] array with current lecture for which
    //we find questions and variants,
    //output array will have format
    //array(pdata) => [array(questions) => [id, question, array(variants) => [text, correct]]]
    //exclusive previous content
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

    function add_lecture($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("INSERT INTO lectures (number, name)
                                    VALUES (:number, :name)");

            $stmt->bindParam(":number", $data['number']);
            $stmt->bindParam(":name", $data['name']);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function edit_lecture($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("update lectures
                                    set number=:number, name=:name
                                    where number=:old_number");

            $stmt->bindParam(":number", $data['number']);
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":old_number",$data['old_number']);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function remove_lecture($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("delete from lectures
                                    where number=:number");

            $stmt->bindParam(":number", $data);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    //$question [in] id of question
    function get_question_by_id($question)
    {
        try
        {
            $sql = "SELECT lecture,question FROM questions WHERE id=$question";

            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("SELECT lecture,question FROM questions WHERE id=:question");
            $stmt->bindParam(":question", $question);
            $stmt->execute();
            $result=$stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result[0];
    }

    function add_question($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("INSERT INTO questions (lecture,question)
                                    VALUES (:lecture, :question)");

            $stmt->bindParam(":lecture", $data['lecture']);
            $stmt->bindParam(":question", $data['question']);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function edit_question($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("update questions
                                    set lecture=:lecture, question=:question
                                    where id=:old_id");

            $stmt->bindParam(":lecture", $data['lecture']);
            $stmt->bindParam(":question", $data['question']);
            $stmt->bindParam(":old_id",$data['old_id']);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function remove_question($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("delete from questions
                                    where id=:id");

            $stmt->bindParam(":id", $data);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function add_variant($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("INSERT INTO variants (question,answer,correct)
                                    VALUES (:question, :answer, :correct)");

            $stmt->bindParam(":question", $data['question']);
            $stmt->bindParam(":answer", $data['answer']);
            if(!isset($data['correct'])) $correct=0;
            else $correct=1;
            $stmt->bindParam(":correct", $correct);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function remove_variant($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("delete from variants
                                    where id=:id");

            $stmt->bindParam(":id", $data);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }
}
