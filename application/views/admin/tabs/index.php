<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/31/16
 * Time: 12:20 AM
 */


$editor = new CKeditor(Url::$baseurl."/assets/ckeditor/");
$content = file_get_contents(TEMPLATES_DIR."/".Application::getInstance()->_config->template."/main.php");
?>
<div id="editor1">
    <? echo $content; ?>
</div>
<a class="get_code btn btn-default">GET CODE</a>