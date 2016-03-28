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

    var current_question=0;
    var is_correct={};
    var mark=0;

    $(document).ready(function () {
        //ticket ui
        function load_question(q)
        {
            $("#question").html("<th>"+data[q]['question']+"</th>");
            var variants=data[q]['variants'];

            for(var i=0; i<variants.length; i++)
            {
                is_correct[i]=variants[i]['correct'];
                $("#variants").append("<tr><td><div class=\"checkbox\"> <label> <input type=\"checkbox\" "+
                    "name=\"variant"+i+"\">"
                    +variants[i]['answer']+"</label> </div></td></tr>");
            }
            $("#variants").append("<tr><td><input type=\"button\" "+
                "id=\"submit_answer\" class=\"btn btn-primary btn-success\" value=\"Прийняти\" ></td></tr>");
            $("#submit_answer").click(function ()
            {
                var nodes=$(":checkbox");
                var correct=0;
                var incorrect=0;
                var count_correct=0;
                var count_incorrect=0;
                for (var i=0; i<nodes.length; i++) {
                    if (is_correct[i] == 1) {
                        count_correct++;
                        if(nodes.eq(i).prop("checked")==true) {
                            nodes.eq(i).parent().parent().parent().parent().css("background", "green");
                        } else {
                            nodes.eq(i).parent().parent().parent().parent().css("background", "yellow");
                        }
                    }
                    else {
                        count_incorrect++;
                        if(nodes.eq(i).prop("checked")==true) {
                            nodes.eq(i).parent().parent().parent().parent().css("background", "red");
                        }
                    }
                    if(nodes.eq(i).prop("checked")==true)
                    {
                        if (is_correct[i])
                            correct++;
                        else
                            incorrect++;
                    }
                }
                mark+=correct/count_correct*(1-incorrect/count_incorrect);
                console.log(correct + " " + incorrect);

                $("#submit_answer").val("Наступне питання");
                $("#submit_answer").click(function () {
                    $("#question").children().remove();
                    $("#variants").children().remove();
                    if (++current_question==data.length)
                    {
                        $("#question").html("<th>Ваша оцінка: "+mark*5/data.length+"</th>");
                    }
                    else load_question(current_question);
                });
            });
        }
        load_question(current_question);
    });
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
