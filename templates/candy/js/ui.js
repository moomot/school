$(document).ready(function () {
    var videos = $(".videos");
    if (typeof data != 'undefined') {
        for (var i = 0; i < data.length; i++) {
            videos.append("<div><img src=\"http://img.youtube.com/vi/"+data[i]['video_id']+"/mqdefault.jpg\" width='185' height='190'></div>");
        }
    }
    var panel = $("#video_panel");

    videos.find("div").click(function () {
        var number_item_clicked = $(this).index();
        panel.find(".panel-heading").text(data[number_item_clicked]['name']);
        $("#ticket_ref").attr("href", "test/" + data[number_item_clicked]['number']);

        $("#player").replaceWith('<iframe id="player" type="text/html" width="640" height="390"\
        src="http://www.youtube.com/embed/'+data[number_item_clicked]['video_id']+'?enablejsapi=1&origin=http://example.com"\
        frameborder="0"></iframe>');
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";

        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player = new YT.Player('player', {
            videoId: data[number_item_clicked]['video_id'],
            events: {
                //'onReady': onPlayerReady
            }
        });

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }
    });

    videos.slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
    videos.find("div:first-child").click();

})
$(function () {
    if (typeof current_page != 'undefined' && current_page == "test") {
        //ticket ui
        var correct_all = 0;
        var incorrect_all = 0;
        function load_question(q) {
            $("#question").html("<th>" + data[q]['question'] + "</th>");
            var variants = data[q]['variants'];

            for (var i = 0; i < variants.length; i++) {
                is_correct[i] = variants[i]['correct'];
                $("#variants").append("<tr><td><div class=\"checkbox\"> <label> <input type=\"checkbox\" " +
                    "name=\"variant" + i + "\">"
                    + variants[i]['answer'] + "</label> </div></td></tr>");
            }
            $("#variants").append("<tr><td><input type=\"button\" " +
                "id=\"submit_answer\" class=\"btn btn-primary btn-success\" value=\"Прийняти\" ></td></tr>");

            $("#submit_answer").click(function () {
                var nodes = $(":checkbox");
                var correct = 0;
                var incorrect = 0;
                var count_correct = 0;
                var count_incorrect = 0;
                for (var i = 0; i < nodes.length; i++) {
                    if (is_correct[i] == 1) {
                        count_correct++;
                        if (nodes.eq(i).prop("checked") == true) {
                            nodes.eq(i).parent().parent().parent().parent().css("background", "#2ecc71");
                        } else {
                            nodes.eq(i).parent().parent().parent().parent().css("background", "#f39c12");
                        }
                    }
                    else {
                        count_incorrect++;
                        if (nodes.eq(i).prop("checked") == true) {
                            nodes.eq(i).parent().parent().parent().parent().css("background", "#c0392b");
                        }
                    }
                    if (nodes.eq(i).prop("checked") == true) {
                        if (is_correct[i] == 1)
                            correct = 1;
                        else {
                            correct = 0;
                        }

                    }
                }
                //mark+=correct/count_correct*(1-incorrect/count_incorrect);
                mark += correct;
                if (correct == 1)
                    correct_all++;
                else
                    incorrect_all++;
                console.log(correct + " " + incorrect);
                $("#submit_answer").unbind();
                $("#submit_answer").val("Наступне питання");
                $("#submit_answer").click(function () {
                    $("#question").children().remove();
                    $("#variants").children().remove();
                    if (++current_question == data.length) {
                        //$("#question").html("<th><div class=\"alert alert-info\">Ваша оцінка: "+Math.floor(mark*100/data.length)+"%</div>Правильних: "+correct+"<br>Неправильних: "+incorrect+"<br> Неповних: "+unchecked+"</th>");
                        $("#question").html("<div class=\"col-lg-12 result_padding\"><div class=\"alert alert-info\">Ваша оцінка: " + Math.floor(mark * 100 / data.length) + "%</div><div class=\"progress\">\
                    <div class=\"progress-bar progress-bar-success\" style=\"width: " + Math.floor(mark * 100 / data.length) + "%\">\
                        </div>\
                        <div class=\"progress-bar progress-bar-danger\" style=\"width: " + Math.floor(incorrect_all / data.length) + "%\">\
                        </div></div>Правильних: " + correct_all + "<br>Неправильних: " + incorrect_all + "</div>");

                        //put to statistic
                        $.ajax({ // инициaлизируeм ajax зaпрoс
                            type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
                            url: baseURI+"/upanel/add_to_ustat", // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
                            data:{
                                result: Math.floor(mark*100/data.length),
                                right_tests: correct_all,
                                wrong_tests: incorrect_all,
                                test_id: data_lection,
                                ticket_type: ticket_type
                            },
                            success: function (data) {

                            },
                            error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
                                alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
                                alert(thrownError); // и тeкст oшибки
                            },
                            complete: function (data) { // сoбытиe пoслe любoгo исхoдa

                            }
                        });

                    }
                    else load_question(current_question);
                });
            });
        }

        load_question(current_question);
    }
});
$(function () {
    var $in_pm = $(".in_pm"),
        $out_pm = $(".out_pm");
    $in_pm.click(function (e) {
        e.preventDefault();
        $out_pm.removeClass("active");
        $(this).addClass("active");
        var action = $(this).data('action');
        $.ajax({ // инициaлизируeм ajax зaпрoс
            type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
            url: action, // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
            success: function (data) {
                $(".pm_content").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
                alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
                alert(thrownError); // и тeкст oшибки
            },
            complete: function (data) { // сoбытиe пoслe любoгo исхoдa

            }
        });
    });

    $out_pm.click(function (e) {
        e.preventDefault();
        $in_pm.removeClass("active");
        $(this).addClass("active");
        var action = $(this).data('action');
        $.ajax({ // инициaлизируeм ajax зaпрoс
            type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
            url: action, // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
            success: function (data) {
                $(".pm_content").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
                alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
                alert(thrownError); // и тeкст oшибки
            },
            complete: function (data) { // сoбытиe пoслe любoгo исхoдa

            }
        });
    });

    $in_pm.click();
});
$(function () {
    var $message_sbm = $(".message_submit");
    $message_sbm.submit(function (e) {
        e.preventDefault();
        var action = $(this).attr("action");
        $.ajax({ // инициaлизируeм ajax зaпрoс
            type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
            url: action, // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
            data: $(this).serialize(),
            success: function (data) {
                $(".sendform").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
                alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
                alert(thrownError); // и тeкст oшибки
            },
            complete: function (data) { // сoбытиe пoслe любoгo исхoдa

            }
        });
    });
});
$(function() {

    var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),
        $fluidEl = $("figure");

    $allVideos.each(function() {

        $(this)
        // jQuery .data does not work on object/embed elements
            .attr('data-aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');

    });

    $(window).resize(function() {

        var newWidth = $fluidEl.width();
        $allVideos.each(function() {

            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.attr('data-aspectRatio'));

        });

    }).resize();

});