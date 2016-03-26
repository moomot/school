$(function ()
{
    //video ui

    var videos=$(".videos");
    for(var i=0; i<data.length; i++)
    {
        videos.append("<div data-videourl=video"+data[i]['number']+">"
            +data[i]['name']+"</div>");
    }

    var panel=$("#video_panel");
    videos.find("div").click(function ()
    {
        var url=$(this).data('videourl');
        panel.find(".panel-heading").text($(this).text());
        panel.find("source").attr("src", "uploads/videos/"+url+".mp4");
        for(var i=0; i<data.length; i++)
        {
            if(data[i]['name']==$(this).text())
            {
                $("#ticket_ref").attr("href",
                    "upanel/tickets/"+data[i]['number']);
                break;
            }
        }
    });

    //imitate click for 1st video

    $('.videos').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });

    //end video ui

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
                if(nodes[i].prop("checked")==true)
                {
                    if (is_correct[i]) correct++;
                    else incorrect++;
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
    load_question(current_question);
});

var current_question=0;
var is_correct={};
var mark=0;
