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
                    <div class="row">
                        <div class="col-lg-8 text-left ticket_title"><? echo $item['name'] ?></div>
                        <div class="col-lg-4 text-right go-test"><a href="choose_ticket/<? echo $item['id'] ?>" class="btn btn-default btn-success">Пройти тест</a></div>
                    </div>
                </td>
            </tr>
            <? } ?>
        </ ?>
        </tbody>
    </table>
</div>