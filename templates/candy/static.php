<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 11:50 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 11:35
 */
ob_clean();
ob_start();
?>

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
    <link rel="shortcut icon" type="image/x-icon" href="<? echo $prefix; ?>/img/favicon.ico" />
    <script type="text/javascript">
        var baseURI = "<? echo $baseURI; ?>";
    </script>
    <!-- Script loading -->
    <script src="<? echo $prefix; ?>/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script type="text/javascript">(function() {
        if (window.pluso)if (typeof window.pluso.start == "function") return;
        if (window.ifpluso==undefined) { window.ifpluso = 1;
            var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
            s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
            var h=d[g]('body')[0];
            h.appendChild(s);
        }})();</script>
<style>
    .pluso-wrapper{
        position: fixed;
        right: 10px;
        top: 70px;
        z-index: 9999
    }
</style>
<div class="pluso-wrapper">
    <div class="pluso" data-background="transparent" data-options="big,round,line,vertical,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,linkedin,google" data-user="1650209034"></div>

</div>
<?php include $templatePath . "/navbar.php"; ?>
<div class="container">
    <div class="col-md-12">
        <div class="right-panel">
            <div class="page-header"><h1><?php echo $data->title; ?></h1></div>
            <p><?php echo $data->content; ?></p>
        </div>
    </div>
    <script src="<? echo $prefix; ?>/js/moment-with-locales.js"></script>
    <script src="<? echo $prefix; ?>/js/bootstrap.min.js"></script>
    <script src="<? echo $prefix; ?>/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<? echo $prefix; ?>/js/slick.min.js"></script>
    <script  src="<? echo $prefix; ?>/js/ui.js"></script>
</body>
</html>
