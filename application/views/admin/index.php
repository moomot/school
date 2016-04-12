<?php
$application = Application::getInstance();
$config = $application->_config;
$baseURI = Url::$baseurl;
$settings = $application->getSettings();

$login_status = Users::getAdminLoginStatus();
$login = Users::getUID();
$prefix = $baseURI."/assets";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админка | <? echo $settings['title']; ?></title>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/style.css"/>
    <link rel="stylesheet"gu href="<? echo $prefix; ?>/css/bootstrap.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap-datetimepicker.min.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="<? echo $prefix; ?>/img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include "sections/navbar.php"; ?>
<div class="container">
   <div class="row">
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
                       "url" => "/admin/lectures",
                       "content" => "<span class=\"glyphicon glyphicon-list\"></span> Редактор лекцій"
                   ],
                   [
                       "url" => "/admin/lectures_video",
                       "content" => "<span class=\"glyphicon glyphicon-list\"></span> Управлiння вiдео"
                   ],
                   [
                       "url" => "/admin/tickets",
                       "content" => "<span class=\"glyphicon glyphicon-list\"></span> Редактор білетів"
                   ],
                   [
                       "url" => "/admin/pages",
                       "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Статичнi сторiнки"
                   ],
                   [
                       "url" => "/admin/news",
                       "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Управлiння новинами"
                   ],
                   [
                       "url" => "/admin/forms",
                       "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Форми зв'язку"
                   ],
                   [
                       "url" => "/admin/feedback",
                       "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Тiкети"
                   ],
                   [
                       "url" => "/admin/settings",
                       "content" => "<span class=\"glyphicon glyphicon-wrench\"></span> Налаштування"
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
</div>

<script src="<? echo $prefix; ?>/js/jquery-1.11.1.min.js"></script>
<script src="<? echo $prefix; ?>/js/moment-with-locales.js"></script>
<script src="<? echo $prefix; ?>/js/bootstrap.min.js"></script>
<script src="<? echo $prefix; ?>/js/bootstrap-datetimepicker.min.js"></script>
<script src="<? echo $prefix; ?>/js/custom.js"></script>
<script type="text/javascript" src="<? echo $prefix; ?>/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">

    tinyMCE.init({

        mode:"textareas",

        theme:"modern",
        lang:"ru",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
        external_filemanager_path:"/school/assets/js/filemanager/filemanager/",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "/school/assets/js/filemanager/filemanager/plugin.min.js"}
    });

</script>
</body>
</html>