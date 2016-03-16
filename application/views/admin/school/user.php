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
                <td>Адрес</td>
                <td><? echo $data['address']; ?></td>
            </tr>
            <tr>
                <td>Повна назва</td>
                <td><? echo $data['full_name']; ?></td>
            </tr>
            <tr>
                <td>Статус</td>
                <td><? echo $data['status']; ?></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><? echo $data['phone']; ?></td>
            </tr>
            <tr>
                <td>Опис</td>
                <td><? echo $data['description']; ?></td>
            </tr>
            <tr>
                <td>Пошта</td>
                <td><? echo $data['email']; ?></td>
            </tr>
            </tbody>
        </table>
        <div class="text-right">
            <a href="<? echo $baseURI; ?>/admin/edit_school/<? echo $data['login']; ?>" class="btn btn-default btn-primary">Редагувати</a>
            <a href="<? echo $baseURI; ?>/admin/remove_school/<? echo $data['login']; ?>" class="btn btn-default btn-danger">Видалити</a>
        </div>
    </div>

</div>