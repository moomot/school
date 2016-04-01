<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo $settings['title']; ?></title>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/style.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/slick.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/slick-theme.css"/>

    <!-- Script loading -->
    <script src="<? echo $prefix; ?>/js/jquery-1.11.1.min.js"></script>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="col-md-3">
            <div class="well well-sm">
                <?
                $nav = new Nav($baseURI);
                $nav->setModel(
                    [
                        "url" => '/upanel',
                        "content" => "<span class=\"glyphicon glyphicon-home\"></span> Головна"
                    ],
                    [
                        "url" => "/upanel/lessons",
                        "content" => "<span class=\"glyphicon glyphicon-list\"></span> Заняття"
                    ],
                    [
                        "url" => "/upanel/messages",
                        "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Повiдомлення"
                    ],
                    [
                        "url" => "/upanel/tickets",
                        "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Бiлети"
                    ],
                    [
                        "url" => "/upanel/schedule",
                        "content" => "<span class=\"glyphicon glyphicon-tasks\"></span> Розклад занять"
                    ]
                )->render("nav nav-pills nav-stacked");
                ?>
            </div>
        </div>
        <div class="col-md-9 left_container">
            <div class="right-panel">
                <?php include $this->getView(); ?>
            </div>
        </div>
    </div>
    <script src="<? echo $prefix; ?>/js/moment-with-locales.js"></script>
    <script src="<? echo $prefix; ?>/js/bootstrap.min.js"></script>
    <script src="<? echo $prefix; ?>/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<? echo $prefix; ?>/js/slick.min.js"></script>
    <script  src="<? echo $prefix; ?>/js/ui.js"></script>
</body>
</html>