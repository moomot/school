<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>
<script type="text/javascript">
    var data= <? echo json_encode($data); ?> ;
    data=data['questions'];

    var current_page = "test";

    var current_question=0;
    var is_correct={};
    var mark=0;
</script>

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
                <li><a href="<? echo $baseURI; ?>/upanel/messages">Повiдомлення</a></li>
                <li class="active"><a href="<? echo $baseURI; ?>/upanel/tickets">Бiлети</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/shedule">Розклад занять</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-12 center_container">
        <div class="well well-sm" style="padding-bottom: 50px">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Перевірка знань</div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <tr id="question">

                    </tr>
                    </thead>
                    <tbody id="variants">
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
