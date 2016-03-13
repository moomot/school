<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 12.03.16
 * Time: 23:31
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Список сторiнок</div>

    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Назва</th>
            <th>URL</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($data as $item) { ?>
            <tr>
                <td><? echo $item['id']; ?></td>
                <td><a href="<? echo $baseURI. "/admin/pages/" . $item['url']; ?>"><? echo $item['title']; ?></a></td>
                <td><? echo $item['url']; ?></td>
            </tr>
        <? } ?>
        </tbody>
    </table>
</div>
<div class="text-center">
    <a href="<? echo $baseURI; ?>/admin/add_page" class="btn btn-primary">Створити сторiнку</a>
</div>
