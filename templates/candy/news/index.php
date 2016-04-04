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
    <script type="text/javascript">
        var baseURI = "<? echo $baseURI; ?>";
    </script>
    <!-- Script loading -->
    <script src="<? echo $prefix; ?>/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<?php include $templatePath . "/navbar.php"; ?>
<div class="container">
    <div class="col-md-12">
        <div class="right-panel">
            <?php if(sizeof($data) == 0): ?>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                    <div class="panel-body">
                        <div class="alert alert-info">Список новин пустий</div>
                    </div>
            <?php else: ?>
                <? foreach ($data as $item) { ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="<? echo $baseURI. "/news/page/" . $item['url']; ?>"><? echo $item['title']; ?></a>
                            </div>
                            <div class="col-lg-4 text-right">
                                Дата: <? echo date("Y-m-d H:i:s", $item['timestamp']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="well">
                            <?
                            if( empty($item['content_short']) )
                                echo $item['content'];
                            else
                                echo $item['content_short'];
                            ?>
                        </div>
                    </div>
                </div>
                <? } ?>
            <?php endif; ?>
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

