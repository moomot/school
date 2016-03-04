<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>

<div class="row">
    <div class="well well-sm">
        Панель користувача
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-12 left_container">
        <div class="well well-sm">
            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <li><a href="<? echo $baseURI; ?>/upanel/lessons">Заняття</a></li>
                <li class="active"><a href="<? echo $baseURI; ?>/upanel/messages">Повiдомлення</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/tickets">Бiлети</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/shedule">Розклад занять</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-12 center_container">
        <div class="well well-sm" style="padding-bottom: 50px">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Повiдомлення</div>

                <!-- Table -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Повiдомлення</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>20.01.2016</td>
                        <td>Very long message, which will be sh... Very long message, which will be sh... Very long message, which will be sh...
                            Very long message, which will be sh...</td>
                    </tr>
                    <tr>
                        <td>20.01.2016</td>
                        <td>Very long message, which will be sh...</td>
                    </tr>
                    <tr>
                        <td>20.01.2016</td>
                        <td>Very long message, which will be sh...</td>
                    </tr>
                    <tr>
                        <td>20.01.2016</td>
                        <td>Very long message, which will be sh...</td>
                    </tr>
                    <tr>
                        <td>20.01.2016</td>
                        <td>Very long message, which will be sh...</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <a href="<? echo $baseURI; ?>/upanel/send_message" class="btn-default btn btn-primary center-block">Написати повiдомлення</a>


        </div>
    </div>
</div>