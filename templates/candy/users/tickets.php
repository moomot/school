<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>

<link type="text/javascript" rel="../js/jquery-1.11.1.min.js" />
<script type="text/javascript">
    var data= <? echo json_encode($data); ?> ;
    data=data['questions'];
	
	var current_question=0;
	var is_correct={};
	var mark=0;
	
	//ticket ui
    function load_question(q)
    {
        $("#question").innerHTML="<th>"+data[q]['question']+"</th>";
        var variants=data[q]['variants'];
        for(var i=0; i<variants.length; i++)
        {
            is_correct[i]=variants[i]['correct'];
            $("#variants").append("<tr><td><input type=\"checkbox\" "+
                "name=\"variant"+i+"\">"
                +variants[i]['answer']+"</p></td></tr>");
        }
        $("#variants").append("<tr><td><input type=\"button\" "+
            "id=\"submit_answer\" class=\"btn btn-primary\" value=\"Прийняти\" ></td></tr>");
        $("#submit_answer").click(function ()
        {
            var nodes=$(":checkbox");
            var correct=0;
            var incorrect=0;
            var count_correct=0;
            var count_incorrect=0;
            for (var i=0; i<nodes.length; i++)
            {
                if (is_correct[i]==1) count_correct++;
                else count_incorrect++;
                if(nodes.eq(i).prop("checked")==true)
                {
                    if (is_correct[i]) correct++;
                    else incoupanelrrect++;
                }
            }
            alert(mark);
            mark+=correct/count_correct*(1-incorrect/count_incorrect);
            alert(mark);
            $("#question").children().remove();
            $("#variants").children().remove();
            if (++current_question==data.length)
            {
                $("#question").innerHTML="<th>Ваша оцінка: "+mark*5/data.length+"</th>";
            }
            else load_question(current_question);
        });
    }
    //TODO Пофиксить, подгружать load_question только на странице с вопросами. В этом видет она подгружается по всему сайту.
    load_question(current_question);
	
	
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