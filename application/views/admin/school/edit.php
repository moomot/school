<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 07.03.16
 * Time: 11:53
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Профiль автошколи <? echo $data['login']; ?></div>
    <div class="panel-body">
        <!-- Table -->
        <form role="form" method="post" action="<? echo Url::$baseurl; ?>/admin/save_school" class="save_site_settings">
        <table class="table list">
            <tbody>
            <tr>
                <td>#</td>
                <td><input class="form-control" type="text" name="uid" value="<? echo $data['uid']; ?>"></td>
            </tr>
            <tr>
                <td>Логiн</td>
                <td><input class="form-control" type="text" name="login" value="<? echo $data['login']; ?>"></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input class="form-control" type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td><input class="form-control" type="text" name="address" value="<? echo $data['address']; ?>"></td>
            </tr>
            <tr>
                <td>Повна назва</td>
                <td><input class="form-control" type="text" name="full_name" value="<? echo $data['full_name']; ?>"></td>
            </tr>
            <tr>
                <td>Статус</td>
                <td><input class="form-control" type="text" name="status" value="<? echo $data['status']; ?>"></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><input class="form-control" type="text" name="phone" value="<? echo $data['phone']; ?>"></td>
            </tr>
            <tr>
                <td>Опис</td>
                <td><input class="form-control" type="text" name="description" value="<? echo $data['description']; ?>"></td>
            </tr>
            <tr>
                <td>Пошта</td>
                <td><input class="form-control" type="text" name="email" value="<? echo $data['email']; ?>"></td>
            </tr>
            </tbody>
        </table>
        <div class="text-center">
            <input type="submit" class="btn btn-default btn-primary" value="Зберегти">
        </div>
            </form>
    </div>

</div>