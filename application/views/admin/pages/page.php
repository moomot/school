<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 12.03.16
 * Time: 23:28
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Сторiнка "<? echo $data['title']; ?>"</div>
    <div class="panel-body">
        <!-- Table -->
        <table class="table list">
            <tbody>
            <tr>
                <td>#</td>
                <td><? echo $data['id']; ?></td>
            </tr>
            <tr>
                <td>Назва</td>
                <td><? echo $data['title']; ?></td>
            </tr>
            <tr>
                <td>Контент</td>
                <td><? echo $data['content']; ?></td>
            </tr>
            <tr>
                <td>Статус</td>
                <td><? echo $data['status'] == 1? "Опублiкована" : "Не опублiкована"; ?></td>
            </tr>
            <tr>
                <td>Коментарi</td>
                <td><? echo $data['comments_status'] == 1? "Вiдкритi" : "Закритi"; ?></td>
            </tr>
            <tr>
                <td>URL</td>
                <td><? echo $data['url']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>