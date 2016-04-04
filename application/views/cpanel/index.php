<?php
$application = Application::getInstance();
$config = $application->_config;
$baseURI = Url::$baseurl;
$settings = $application->getSettings();

$login_status = Users::getSchoolLoginStatus();
$uID = Users::getUID();
$login = $application->get_login_by_id($uID);
$prefix = $baseURI."/assets";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админка | <? echo $settings['title']; ?></title>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/style.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap-datetimepicker.min.css"/>
</head>
<body>
<?php include "sections/navbar.php"; ?>
<div class="container">
   <div class="col-md-3">
       <div class="well well-sm">
           <?
           $nav = new Nav($baseURI);
           $nav->setModel(
               [
                   "url" => '/cpanel',
                   "content" => "<span class=\"glyphicon glyphicon-home\"></span> Головна"
               ],
               [
                   "url" => "/cpanel/list",
                   "content" => "<span class=\"glyphicon glyphicon-list\"></span> Список студентiв"
               ],
               [
                   "url" => "/cpanel/messages",
                   "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Повiдомлення"
               ],
               [
                   "url" => "/cpanel/stat",
                   "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Статистика студентiв"
               ],
               [
                   "url" => "/cpanel/feedback",
                   "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Зворотнiй зв'язок"
               ]
           )->render("nav nav-pills nav-stacked");
           ?>
       </div>
   </div>
    <div class="col-md-9 left_container">
        <div class="right-panel">
            <?php include $this->getPrivateView(); ?>
        </div>
    </div>
</div>

<script src="<? echo $prefix; ?>/js/jquery-1.11.1.min.js"></script>
<script src="<? echo $prefix; ?>/js/moment-with-locales.js"></script>
<script src="<? echo $prefix; ?>/js/bootstrap.min.js"></script>
<script src="<? echo $prefix; ?>/js/bootstrap-datetimepicker.min.js"></script>
<script src="<? echo $prefix; ?>/js/custom.js"></script>
</body>
</html>