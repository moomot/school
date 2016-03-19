<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/7/16
 * Time: 1:00 PM
 */
?>
<div class="navbar navbar-default navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-left">
            <div class="hello">Здравствуй, <? echo $uid; ?></div>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="<? echo $baseURI; ?>">Головна</a></li>
                <li><a href="<? echo $baseURI; ?>/static/about">Про проект</a></li>
                <li class="disabled"><a href="<? echo $baseURI; ?>">Форум</a></li>
                <?php if($login_status == "access_granted"): ?>
                    <li><a href="<? echo $baseURI; ?>/upanel">Мiй кабiнет</a></li>
                <?php endif; ?>
                <li class="disabled"><a href="<? echo $baseURI; ?>/static/zaconodavstvo">Законодавство</a></li>
                <?php if($login_status == "access_granted"): ?>
                    <li><a href="<? echo $baseURI; ?>/user/terms">Термiни</a></li>
                    <li><a href="<? echo $baseURI; ?>/user/logout">Выход</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
