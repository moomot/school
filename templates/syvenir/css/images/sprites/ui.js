$(document).ready(function(){$('.timer').dsCountDown({endDate:new Date("December 24, 2040 0:23:00"),theme:'black',titleHours:"часов",titleMinutes:"минут",titleSeconds:"секунд"});$(".close").click(function(e){$.arcticmodal('close');e.preventDefault();});$(".btn").click(function(){$(this).blur();});$('.gb_container').slick({infinite:true,slidesToShow:1,slidesToScroll:1,variableWidth:false,dots:true,arrows:false,customPaging:function(slider,i){return'<a href="javascript://">'+(i+1)+'</a>';}});$('input[type="tel"]').mask("+7(999) 999-99-99");$(function(){var $production=$(".production");var $all_items_btn=$(".show-all-items");var items_on_page=8;showItems(0,items_on_page,$production);var click=0,isNew=false;var constText=$all_items_btn.text();$all_items_btn.click(function(e){e.preventDefault();if(isNew){isNew=false;$(this).text(constText);hideItems($production);showItems(0,items_on_page,$production);return;}if(click==0){$(this).text("ПОКАЗАТЬ ЕЩЕ ТОВАРЫ");}click++;var index=findLastVisible($production);showItems(index+1,items_on_page,$production);if(click==2){click=0;$(this).text("СВЕРНУТЬ КАТАЛОГ ВСЕХ ТОВАРОВ");isNew=true;}});function showItems(startIndex,items_on_page,$block){for(var i=0;i<items_on_page;i++,startIndex++){$block.find("li").eq(startIndex).fadeIn();}}function findLastVisible($block){var index=0;$block.find("li").each(function(){if($(this).css("display")=='list-item')index=$(this).index();});return index;}function hideItems($block){$block.find("li").each(function(){$(this).hide();});}});$(function(){$(".next-tab").click(function(e){e.preventDefault();var next_tab_name=$(this).data('tabname');var $body=$('body');var topOffset=$body.find('.'+next_tab_name).offset().top;$body.animate({scrollTop:topOffset+135});});});$(".modal-call").click(function(e){e.preventDefault();var title=$(this).data('title');var btn=$(this).data('btn');var source=$(this).data('source');var $modal=$(".modal");$modal.arcticmodal({beforeOpen:function(){$modal.find("h2").html(title);if(btn!=' '){$modal.find('input[type="submit"]').val(stripHTML(btn));}if(source!=' '){$modal.find('input[name="source"]').val(stripHTML(source));}}});});$(".production .item").click(function(e){e.preventDefault();var title=$(this).data('title');var $modal=$(".modal_item");$modal.arcticmodal({beforeOpen:function(){$modal.find("h2").html(title);$modal.find('input[name="item"]').val(title);if(title!='Печать на футболке'&&title!='Печать на толстовке'&&title!='Печать на свитшоте'&&title!='Печать на ветровке'){$modal.find(".up2").hide();$modal.find(".up1").find("div").text("Прикрепить макет");}else{$modal.find(".up2").show();$modal.find(".up1").find("div").text("Прикрепить макет вида спереди");}}});});$(".ask_question").click(function(e){e.preventDefault();$(".modal_question").arcticmodal();});$(".tab10 li a").click(function(e){e.preventDefault();var title=$(this).html();var content=$(this).data('answer');var $modal=$(".modal_faq");$modal.arcticmodal({beforeOpen:function(){$modal.find('.faq-title').html(title);$modal.find('.faq-content').html(content);}});});$(".tab_pills li a").click(function(e){e.preventDefault();var $modal=$(".modal");var source=$(this).parent().parent().find("h2").text();$modal.arcticmodal({beforeOpen:function(){$modal.find('input[name="source"]').val('Обратный звонок: '+stripHTML(source));}});});function stripHTML(dirtyString){var container=document.createElement('div');var text=document.createTextNode(dirtyString);container.appendChild(text);return container.innerHTML;}$(function(){var wrapper=$(".up1"),inp=wrapper.find("input"),btn=wrapper.find("button"),lbl=wrapper.find("div");btn.focus(function(){wrapper.addClass("focus");}).blur(function(){wrapper.removeClass("focus");});btn.add(lbl).click(function(){inp.click();});var file_api=(window.File&&window.FileReader&&window.FileList&&window.Blob)?true:false;inp.change(function(){var file_name;if(file_api&&inp[0].files[0])file_name=inp[0].files[0].name;else
file_name=inp.val().replace("C:\\fakepath\\",'');if(!file_name.length)return;if(lbl.is(":visible")){lbl.text(file_name);btn.text("");}else
btn.text(file_name);}).change();});$(function(){var wrapper=$(".up2"),inp=wrapper.find("input"),btn=wrapper.find("button"),lbl=wrapper.find("div");btn.focus(function(){wrapper.addClass("focus");}).blur(function(){wrapper.removeClass("focus");});btn.add(lbl).click(function(){inp.click();});var file_api=(window.File&&window.FileReader&&window.FileList&&window.Blob)?true:false;inp.change(function(){var file_name;if(file_api&&inp[0].files[0])file_name=inp[0].files[0].name;else
file_name=inp.val().replace("C:\\fakepath\\",'');if(!file_name.length)return;if(lbl.is(":visible")){lbl.text(file_name);btn.text("");}else
btn.text(file_name);}).change();});$(window).resize(function(){$(".up1 input").triggerHandler("change");});var up1=$(".up1").find("div");var up2=$(".up2").find("div");var up1_text=up1.text();var up2_text=up2.text();$(".calc-form").submit(function(){var form=$(this);var btn=form.find('input[type="submit"]');var defVal=btn.val();$.ajax({type:'POST',url:'feedback/form_mail.php',data:new FormData(this),contentType:false,cache:false,processData:false,beforeSend:function(data){btn.attr('disabled','disabled');btn.val("Загрузка...");},success:function(data){$.arcticmodal('close');var m=$('<div class="box-modal" id="feedback-modal-box" />');m.html('<div class="result_heading">Спасибо <br> за Ваш заказ!</div><div class="result_content">Мы сделаем вариант<br>Вашего макета в течение<br>24 часов!</div>');m.prepend('<div class="modal-close arcticmodal-close close"></div>');$.arcticmodal({content:m});},error:function(xhr,ajaxOptions,thrownError){alert(xhr.status);alert(thrownError);},complete:function(data){btn.prop('disabled',false);btn.val(defVal);form[0].reset();up1.text(up1_text);up2.text(up2_text);}});return false;});});