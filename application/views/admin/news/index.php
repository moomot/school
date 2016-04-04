<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 11:35
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Список новин</div>

    <?php if(sizeof($data) == 0): ?>
        <div class="panel-body">
            <div class="alert alert-info">Список новин пустий</div>
        </div>
    <?php else: ?>
    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Назва</th>
            <th>URL</th>
            <th>Дата</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($data as $item) { ?>
            <tr>
                <td><? echo $item['id']; ?></td>
                <td><a href="<? echo $baseURI. "/admin/news/" . $item['url']; ?>"><? echo $item['title']; ?></a></td>
                <td><? echo $item['url']; ?></td>
                <td><? echo date("Y-m-d H:i:s", $item['timestamp']); ?></td>
                <td><? echo $item['status'] == 1? "Опублiкована" : "Не опублiкована"; ?></td>
            </tr>
        <? } ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<div class="text-right">
    <a href="<? echo $baseURI; ?>/admin/add_news" class="btn btn-success">Створити новину</a>
</div>

