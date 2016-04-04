<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 11:57
 */
?>
<form action="<? echo Url::$baseurl; ?>/admin/add_news" method="post" accept-charset="utf-8">
    <h3>Створення новини</h3>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" required name="title" value="" placeholder="Назва сторiнки">
    </div>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <textarea class="form-control" required name="content_short" placeholder="Стислий контент" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <textarea class="form-control" required name="content" placeholder="Контент" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="text" class="form-control" required name="status" value=""  placeholder="Статус публикации (1, 0)">
    </div>

    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="text" class="form-control" required name="comments_status" value=""  placeholder="Статус комментариев (1, 0)">
    </div>
    <p><input type="submit" class="btn btn-success btn-block" name="add" value="Додати &rarr;"/></p>
</form>
