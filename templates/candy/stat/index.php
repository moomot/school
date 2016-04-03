<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 03.04.16
 * Time: 2:47
 */
?>
<!-- Table -->

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Статистика</div>

            <?
            if(sizeof($data) == 0) {
                ?>
                <div class="panel-body">
                    <div class="alert alert-info">Нема результатiв</div>
                </div>
                <?
            } else {
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Тип</th>
                        <th>Результат</th>
                        <th>+</th>
                        <th>-</th>
                        <th>Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? $i = 1; foreach ($data as $item) {?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><? echo $item['test_type'] == 1 ? "Билет" . " #" . $item['test_id'] : "ЛЕКЦИЯ" . " #" . $item['test_id']; ?></td>
                            <td><?= $item['result']; ?>%</td>
                            <td><?= $item['right_tests']; ?></td>
                            <td><?= $item['wrong_tests']; ?></td>
                            <td><?= date("Y-m-d H:i:s", $item['timestamp']); ?></td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
                <?
            }
            ?>


    </div>
