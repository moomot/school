<?php
$application = Application::getInstance();
$config = $application->_config;
$baseURI = Url::$baseurl;
$settings = $application->getSettings();

$login_status = Users::getLoginStatus();
$login = Users::getLogin();
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
                   "url" => '/admin',
                   "content" => "<span class=\"glyphicon glyphicon-home\"></span> Головна"
               ],
               [
                   "url" => "/admin/list",
                   "content" => "<span class=\"glyphicon glyphicon-list\"></span> Список шкiл"
               ],
               [
                   "url" => "/admin/messages",
                   "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Повiдомлення"
               ],
               [
                   "url" => "/admin/pages",
                   "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Статичнi сторiнки"
               ],
               [
                   "url" => "/admin/settings",
                   "content" => "<span class=\"glyphicon glyphicon-wrench\"></span> Налаштування"
               ]
           )->render("nav nav-pills nav-stacked");
           ?>
       </div>
   </div>
    <div class="col-md-9">
        <div class="well well-sm">
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