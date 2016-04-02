<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 03.04.16
 * Time: 2:27
 */
?>
<div class="well well-sm notopmargin">

        <div class="alert alert-info">Ви вже пройшли цей тест! Ваша оцінка: <?= $data['result'] ?>%</div>
        <div class="progress">
            <div class="progress-bar progress-bar-success" style="width: <?= $data['result'] ?>%">
            </div>
            <div class="progress-bar progress-bar-danger" style="width: <?= $data['wrong_tests'] ?>%">
            </div>
        </div>
        Правильних: <?= $data['right_tests'] ?><br>Неправильних: <?= $data['wrong_tests'] ?>
</div>
