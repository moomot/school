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

<div class="videos">

</div>
<hr>
<div id="video_panel" class="panel panel-default">
    <div class="panel-heading">Урок 1. Загальнi положення</div>
    <div class="panel-body">
        <video width="774" height="397" controls>
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