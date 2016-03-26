<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 27.03.16
 * Time: 0:37
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Профiль студента <? echo $data['login']; ?></div>
    <div class="panel-body">
        <!-- Table -->
        <table class="table list">
            <tbody>
            <tr>
                <td>#</td>
                <td><? echo $data['uid']; ?></td>
            </tr>
            <tr>
                <td>Логiн</td>
                <td><? echo $data['login']; ?></td>
            </tr>
            <tr>
                <td>Адреса</td>
                <td><? echo $data['address']; ?></td>
            </tr>
            <tr>
                <td>Iм`я</td>
                <td><? echo $data['firstname']; ?></td>
            </tr>
            <tr>
                <td>Прiзвище</td>
                <td><? echo $data['lastname']; ?></td>
            </tr>
            <tr>
                <td>Статус</td>
                <td><? echo $data['status']; ?></td>
            </tr>
            </tbody>
        </table>
        <div class="text-right">
            <a href="<? echo $baseURI; ?>/cpanel/edit_user/<? echo $data['login']; ?>" class="btn btn-default btn-primary">Редагувати</a>
            <a href="<? echo $baseURI; ?>/cpanel/remove_user/<? echo $data['login']; ?>" class="btn btn-default btn-danger">Видалити</a>
        </div>
    </div>

</div>
