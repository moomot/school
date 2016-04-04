<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 27.03.16
 * Time: 0:36
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Створення студента</div>
    <div class="panel-body">
        <form action="<? echo Url::$baseurl; ?>/cpanel/add_user" method="post" accept-charset="utf-8">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" required name="login" value="" placeholder="Логин">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input type="password" class="form-control" required name="password" placeholder="Пароль">
            </div>

            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" class="form-control" required name="firstname" value=""  placeholder="Iм`я">
            </div>

            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" class="form-control" required name="lastname" value=""  placeholder="Прiзвище">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="text" class="form-control" required name="address" value=""  placeholder="Адреса">
            </div>

            <p><input type="submit" class="btn btn-success btn-block" name="add" value="Додати &rarr;"/></p>
        </form>
    </div>

   </div>