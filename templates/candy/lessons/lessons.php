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

<div class="well well-sm">
    <div class="videos">

    </div>
</div>
<hr>
<div id="video_panel" class="panel panel-default">
    <div class="panel-heading">Урок 1. Загальнi положення</div>
    <div class="panel-body text-center">
        <iframe id="player" type="text/html" width="740" height="390"
                src="http://www.youtube.com/embed/<?= $data[0]['video_id']; ?>?enablejsapi=1&origin=http://example.com"
                frameborder="0"></iframe>
    </div>
</div>
<hr>
<div class="panel panel-default">
    <a id="ticket_ref" class="btn btn-primary btn-block" href="<? echo $baseURI; ?>/upanel/test">Почати тест</a>
</div>