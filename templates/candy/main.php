<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/30/16
 * Time: 8:33 PM
 */
?>
<div class="row">
    <div class="page-header text-center">
        <h2>Навчайся теорiї не виходячи з дому!</h2>
    </div>
</div>
<div class="aligner">
    <div class="row">
        <?php if($login_status=="access_granted"): ?>
            <div class="center-block panel-link">
                <a href="<? echo $baseURI."/upanel"; ?>" class="btn btn-block btn-primary btn-lg panel-link">Панель пользователя</a>
            </div>
        <?php elseif($login_status=="access_denied" OR $login_status == ""): ?>
            <div class="center-block panel-link">
                <a href="<? echo $baseURI."/user/login"; ?>" class="btn btn-block btn-primary btn-lg panel-link">Почати навчання</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="bottom_link text-right">
    <a href="<? echo $baseURI."/admin"; ?>" class="panel-link">Вхiд для автошколи</a>
</div>