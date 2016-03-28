<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>

<script type="text/javascript">
    var data= <? echo json_encode($data); ?> ;
</script>

<div class="row">
    <div class="well well-sm">
        Панель користувача
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-12 left_container">
        <div class="well well-sm">
            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <li class="active"><a href="<? echo $baseURI; ?>/upanel/lessons">Заняття</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/messages">Повiдомлення</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/tickets">Бiлети</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/shedule">Розклад занять</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-12 center_container">
        <div class="well well-sm" style="padding-bottom: 50px">
            <div class="videos">

            </div>
            <hr>
            <div id="video_panel" class="panel panel-default">
                <div class="panel-heading">Урок 1. Загальнi положення</div>
                <div class="panel-body">
                    <video width="827" height="400" controls>
                        <source src="<? echo $baseURI; ?>/assets/video/video1.mp4" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <hr>
            <div class="panel panel-default">
                <a id="ticket_ref" class="btn btn-primary btn-block" href="<? echo $baseURI; ?>/upanel/test">Почати тест</a>
            </div>
        </div>
    </div>
</div>
