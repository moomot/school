<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 04.04.16
 * Time: 20:34
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Форми</div>

    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <th>Дата</th>
            <th>Текст</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($data as $item) { ?>
            <tr>
                <td><?= date("Y-m-d H:i:s", $item['timestamp']); ?></td>
                <td><?= $item['content']; ?></a></td>
            </tr>
        <? } ?>
        </tbody>
    </table>
</div>
