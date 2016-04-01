<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 27.03.16
 * Time: 0:47
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Профiль автошколи <? echo $data['login']; ?></div>
    <div class="panel-body">
        <!-- Table -->
        <form role="form" method="post" action="<? echo Url::$baseurl; ?>/cpanel/save_user" class="save_site_settings">
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
                    <td>Пароль(md5)</td>
                    <td><input class="form-control" type="text" name="password" value="<? echo $data['password']; ?>">
                        <a href="javascript://" class="btn btn-default md5-generate">MD5 Generate</a></td>
                </tr>
                <tr>
                    <td>Адреса</td>
                    <td><input class="form-control" type="text" name="address" value="<? echo $data['address']; ?>"></td>
                </tr>
                <tr>
                    <td>Iм`я</td>
                    <td><input class="form-control" type="text" name="firstname" value="<? echo $data['firstname']; ?>"></td>
                </tr>
                <tr>
                    <td>Прiзвище</td>
                    <td><input class="form-control" type="text" name="lastname" value="<? echo $data['lastname']; ?>"></td>
                </tr>
                <tr>
                    <td>Статус</td>
                    <td><input class="form-control" type="text" name="status" value="<? echo $data['status']; ?>"></td>
                </tr>
                <tr>
                    <td>Доступнi лекцiї<br>(через кому)</td>
                    <td><input class="form-control" type="text" name="available_lections" value="<? echo $data['available_lections']; ?>"></td>
                </tr>
                </tbody>
            </table>
            <div class="text-center">
                <input type="submit" class="btn btn-default btn-primary" value="Зберегти">
            </div>
        </form>
    </div>

</div>
