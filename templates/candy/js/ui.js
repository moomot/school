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
                    "test/"+data[i]['number']);
                break;
            }
        }
    });


    $('.videos').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });

    //end video ui

});