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


    function get_admin_by_id($id)
    {
        try {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');
            $stmt = $_dbh->prepare("SELECT login FROM admins WHERE uid=:uid");
            $stmt->bindParam(":uid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_dbh = null;
        } catch (PDOException $e) {
            throw new CustomException("Query error");
        }
        return $result;
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


    function get_feedback_tickets($status)
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
WHERE f.id = :id AND fm.ticket_id = f.id AND tmp.uid = fm.user_id ORDER BY fm.id");
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

    function add_ticket($name)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("INSERT INTO tickets (name)
                                    VALUES (:name)");

            $stmt->bindParam(":name", $name);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    function remove_ticket($ticket)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("delete from tickets
                                    where id=:id");

            $stmt->bindParam(":id", $ticket);

            $result=$stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
        return $result;
    }

    /**
     * /
     * @param mixed $pdata [in,out]
     * input values: pdata[ticket] (id of ticket)
     * output format: pdata => [ticket,name,lectures => array[name,questions => array[id,question,included]]]
     * pdata[i_lecture][j_question][included]=1 if id of j_question is already present in ticket
     */
    function get_ticket_data(&$pdata)
    {
        $db = Database::getInstance();
        $_dbh = $db->getConnection();
        $_dbh->exec('SET NAMES utf8');

        $stmt = $_dbh->prepare("SELECT id, name, questions FROM tickets WHERE id=:id");
        $stmt->bindParam(":id", $pdata['ticket']);
        $stmt->execute();
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        $pdata['name']=$data['name'];

        $included=explode(",",$data['questions']);
        if($included[0]=="")
            unset($included[0]);

        $pdata['lectures']=$this->get_lectures();
        foreach($pdata['lectures'] as &$item)
        {
            $stmt = $_dbh->prepare("SELECT id,question FROM questions WHERE lecture=:lecture");
            $stmt->bindParam(":lecture", $item['number']);
            $stmt->execute();
            $item['questions']=$stmt->fetchAll();
            foreach($included as $incitem)
            {
                foreach($item['questions'] as &$qitem)
                {
                    if($qitem['id']==$incitem)
                        $qitem['included']=1;
                }
            }
        }
        return $pdata;
    }

    function set_ticket_data($data)
    {
        try
        {
            $db = Database::getInstance();
            $_dbh = $db->getConnection();
            $_dbh->exec('SET NAMES utf8');

            $stmt = $_dbh->prepare("update tickets
                                    set questions=:questions
                                    where id=:id");
            $questions="";
            foreach($data as $key => $value)
            {
                if(preg_match("/question/",$key))
                {
                    $questions=$questions.",".$value;
                }
            }
            if($questions!="")
                $questions=substr($questions,1,strlen($questions)-1);
            $stmt->bindParam(":questions", $questions);
            $stmt->bindParam(":id", $data['ticket']);
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new CustomException("Query error");
        }
    }

}
