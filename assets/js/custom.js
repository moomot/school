/**
 * Created by kiko on 1/31/16.
 */
$(document).ready(function () {
    // Change template action
    var $dropdown = $(".settings-dropdown");

    $dropdown.find("li a").on("click", func);

    function func(e) {
        e.preventDefault();
        var val = $(this).text();
        $(this).parent().parent().prev().find("span").text(val);
        $(this).parent().parent().parent().prev().val(val);
    }

    function setValFromData()
    {
        var val = $("body").find('#template').val();
        $dropdown.find("span").text(val);
    }

    function showReconstructionReason()
    {
        var $container = $(".save_site_settings");
        var $reason = $container.find(".reason");
        var isEnabled = $container.find('.reconstruction input').attr('checked');
        if (isEnabled == 'checked')
            $reason.show();
        else
            $reason.hide();
    }
    // =============================================

    // Change is on reconstruction
    $(".reconstruction input").click(function() {
        $(".reason").toggle(this.checked);
    });
    // =============================================

    // Save site settings
    $(".save_site_settings").submit(function (e) {
        e.preventDefault();

        var _this = $(this);
        var action = _this.attr('action');
        var $sbmButton = _this.find('input[type="submit"]');
        var sbmButtonText = $sbmButton.val();

        $.ajax({ // инициaлизируeм ajax зaпрoс
            type: 'POST', // oтпрaвляeм в POST фoрмaтe, мoжнo GET
            url: action, // путь дo oбрaбoтчикa, у нaс oн лeжит в тoй жe пaпкe
            data: _this.serialize(),

            beforeSend: function(data) { // сoбытиe дo oтпрaвки
                $sbmButton.val("Сохранение...");
            },
            success: function(data){
                setTimeout(function() {
                    $sbmButton.val("Сохранено");
                }, 1500);
                setTimeout(function() {
                    $sbmButton.val(sbmButtonText);
                }, 3500);

            },
            error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
                alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
                alert(thrownError); // и тeкст oшибки
            },
            complete: function(data) { // сoбытиe пoслe любoгo исхoдa

            }
        });

    });

    $(".get_code").click(function () {
        $("#editor1").find("div").each(function () {
            $(this).attr("contenteditable","true");
            CKEDITOR.inline( $(this).className );
        });
    });

    function onLoad()
    {
        setValFromData();
        showReconstructionReason();
    }
    onLoad();
});