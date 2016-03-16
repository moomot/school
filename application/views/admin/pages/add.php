<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 06.03.16
 * Time: 1:12
 */
?>
<form action="<? echo Url::$baseurl; ?>/admin/add_page" method="post" accept-charset="utf-8">
    <h3>Добавление автошколы</h3>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" class="form-control" required name="title" value="" placeholder="Назва сторiнки">
    </div>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <textarea class="form-control" required name="content" placeholder="Контент" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="text" class="form-control" required name="phone" value=""  placeholder="Статус пуб.">
    </div>

    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="text" class="form-control" required name="full_name" value=""  placeholder="Полное название">
    </div>

    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="text" class="form-control" required name="description" value=""  placeholder="Описание">
    </div>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
        <input type="text" class="form-control" required name="address" value=""  placeholder="Адрес">
    </div>

    <p><input type="submit" class="btn btn-success btn-block" name="add" value="Додати &rarr;"/></p>
</form>