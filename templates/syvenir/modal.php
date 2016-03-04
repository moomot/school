<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/17/16
 * Time: 3:35 PM
 */
?>
<div style="display: none">
    <div class="box-modal modal">
        <div class="modal-content-box">
            <div class="modal-cont">
                <h2>Заказать звонок</h2>
                <a class="close" href="#"></a>
                <form  class="form-control arctic-form" method="post" name="form-1">
                    <input type="text" name="name" required value="" placeholder="Ваше имя..."/>
                    <input type="tel" name="phone" required value="" placeholder="Ваш телефон..."/>
                    <input type="email" name="email" required value="" placeholder="Ваш email..."/>
                    <input type="submit" class="feedback" name="send" value="ПОЛУЧИТЬ СКИДКУ" />
                    <div class="nospam">
                        <div class="nospam_icon"></div>
                        <p>Мы против спама</p>
                    </div>
                    <input type="hidden" name="source" value='Обратный звонок (шапка)'/>
                    <input type="hidden" name="goal" value="" />
                </form>
            </div>
        </div>
    </div>

    <div class="box-modal modal_question">
        <div class="modal-content-box">
            <div class="modal-cont">
                <h2>Задать вопрос</h2>
                <a class="close" href="#"></a>
                <form  class="form-control arctic-form" method="post" name="form-2">
                    <input type="text" name="name" required value="" placeholder="Ваше имя..."/>
                    <input type="tel" name="phone" required value="" placeholder="Ваш телефон..."/>
                    <textarea name="question" id="" cols="30" rows="10" required placeholder="Ваш вопрос..."></textarea>
                    <input type="submit" class="feedback" name="send" value="ПОЛУЧИТЬ ОТВЕТ" />
                    <div class="nospam">
                        <div class="nospam_icon"></div>
                        <p>Мы против спама</p>
                    </div>
                    <input type="hidden" name="source" value='Вопрос'/>
                    <input type="hidden" name="goal" value="ask_question" />
                </form>
            </div>
        </div>
    </div>

    <div class="box-modal modal_faq">
        <div class="modal-content-box">
            <div class="modal-cont">
                <a class="close" href="#"></a>
                <div class="faq-title">В чем преимущество работы<br>с нашей компанией?</div>
                <div class="faq-content">Исчерпывающий ассортимент. Наличие собственного производства
                    позволяет быстро и качественно изготавливать сувениры с логотипом,
                    а так же иметь постоянный контроль над качеством изделий.</div>
            </div>
        </div>
    </div>

    <div class="box-modal modal_item">
        <div class="modal-content-box">
            <div class="modal-cont">
                <a class="close" href="#"></a>
                <div class="modal-item-title">
                    <h2>Заказать печать на футболке</h2>
                    <div class="form-container clearfix">
                        <form action="" method="post" class="calc-form">
                            <div class="left">
                                <input type="text" name="login" required value="" placeholder="Ваше имя..."/>
                                <input type="tel" name="phone" required value="" placeholder="Ваш телефон..."/>
                                <input type="email" name="email" required value="" placeholder="Ваш email..."/>

                                <input type="hidden" name="source" value="Заказ продукции" />
                                <input type="hidden" name="goal" value="" />
				<input type="hidden" name="item" value="" />
                            </div>
                            <div class="right">
                                <div class="file_upload up1">
                                    <button type="button"></button>
                                    <div>Прикрепить макет вида спереди</div>
                                    <input type="file" name="file1">
                                </div>
                                <div class="file_upload up2">
                                    <button type="button"></button>
                                    <div>Прикрепить макет вида сзади</div>
                                    <input type="file" name="file2">
                                </div>
                                <input type="submit" name="calc" value="РАССЧИТАТЬ СТОИМОСТЬ" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-item-content">
                    <h3>Инструкция по заказу:</h3><br><div class="line"></div>
                    Исчерпывающий ассортимент. Наличие собственного производства
                    позволяет быстро и качественно изготавливать сувениры с логотипом,
                    а так же иметь постоянный контроль над качеством изделий.</div>
            </div>
        </div>
    </div>
</div>
