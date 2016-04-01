<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Бiлети</div>

    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <th>Назва бiлету</th>
        </tr>
        </thead>
        <tbody >
            <? foreach($data as $item) { ?>
            <tr>
                <td>
                    <a href="choose_ticket/<? echo $item['id'] ?>"><? echo $item['name'] ?></a>
                </td>
            </tr>
            <? } ?>
        </ ?>
        </tbody>
    </table>
</div>