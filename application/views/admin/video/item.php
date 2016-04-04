<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 03.04.16
 * Time: 22:40
 */
$base = Url::$baseurl;
$request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
$routes = explode('/', $request_uri);
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Редагування вiдео</div>
    <div class="panel-body">
        <!-- Table -->
        <form role="form" method="post" action="<? echo Url::$baseurl; ?>/admin/save_video" class="save_site_settings">
            <p>
                URL з youtube.com
            </p>
            <input type="hidden" name="lecture_id" value="<?= $routes[3]; ?>">
            <textarea class="form-control" name="video_frame" id="" cols="30" rows="10"><?= $data['video_frame']; ?></textarea>
            <div class="text-center">
                <input type="submit" class="btn btn-default btn-primary" value="Зберегти">
            </div>
        </form>
    </div>

</div>
