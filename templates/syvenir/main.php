<div class="header_bg">
    <header class="wrapper">
        <div class="top_head_panel">
            <a href="#" class="hlogo">Студия сувенирной печати</a>
            <div class="right-panel">
                <div class="mail">
                    <div class="plane"></div>
                    <a href="mailto:info@art-print.su">info@art-print.su</a>
                </div>
                <div class="phone-panel">
                    <div class="phone"><a href="tel:+74996496956">+7 (499) 649-69-56</a></div>
                    <a href="#" class="order-call modal-call"
                       data-title="Заказать звонок"
                       data-btn="ЗАКАЗАТЬ ЗВОНОК"
                       data-source="Заказать звонок в шапке" data-goal="call_header">Заказать звонок</a>
                </div>
            </div>
        </div>
        <div class="text_panel">
            <h1><span class="yellow">П</span>роизводство <br>
                <span class="blue">с</span>увенирной продукции <br>
                <span class="pink">п</span>од ключ <br></h1>
            <div class="header_divider colored_divider"></div>
            <p>с типовым и индивидуальным дизайном</p>

        </div>
        <div class="left_header"></div>
        <a href="#" class="next-tab header_arrow" data-tabname="tab2"></a>
    </header>
</div>
<div class="tab2 clearfix">
    <div class="wrapper">
        <div class="left">
            <h1>ОСТАВЬТЕ ЗАЯВКУ<br>ПРЯМО СЕЙЧАС</h1>
            <p>и <span>получите скидку 15%</span><br>на изготовление сувенирной<br>продукции</p>
            <div class="divider colored_divider"></div>
            <div class="action_b_panel">
                <div class="left">
                    До конца акции<br>
                    осталось:
                </div>
                <div class="right">
                    <div class="timer"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="form-panel">
                <p>Заявка на получение<br><span>15%</span> скидки</p>
                <form method="post" name="form-1" class="arctic-form">
                    <input type="text" name="name" required value="" placeholder="Ваше имя..."/>
                    <input type="tel" name="phone" required value="" placeholder="Ваш телефон..."/>
                    <input type="email" name="email" required value="" placeholder="Ваш email..."/>
                    <input type="submit" class="feedback" name="send" value="ПОЛУЧИТЬ СКИДКУ" />
                    <input type="hidden" name="source" value="Заявка на получение 15% скидки после шапки" />
                    <input type="hidden" name="goal" value="discount_header" />
                    <div class="nospam">
                        <div class="nospam_icon"></div>
                        <p>Мы против спама</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="tab3 clearfix">
    <div class="wrapper">
        <div class="left">
            <h1>готовые <br>
                решения</h1>
            <div class="divider colored_divider"></div>
            <p>для наших клиентов</p>
            <div class="cup"></div>
        </div>
        <div class="right">
            <ul class="tab_pills">
                <li>
                    <div class="image"><img src="<? echo $prefix; ?>/css/images/cup1.png" alt=""></div>
                    <h2><a href="#" data-goal="logo">Логотип,<br> фирм.стиль</a></h2>
                    <div class="full-entry-link"><a href="#" data-goal="logo">Подробнее</a></div>
                </li>
                <li>
                    <div class="image"><img src="<? echo $prefix; ?>/css/images/cup2.png" alt=""></div>
                    <h2><a href="#" data-goal="present">Подарки<br> на праздники</a></h2>
                    <div class="full-entry-link"><a href="#" data-goal="present">Подробнее</a></div>
                </li>
                <li>
                    <div class="image"><img src="<? echo $prefix; ?>/css/images/cup3.png" alt=""></div>
                    <h2><a href="#" data-goal="party">Тематические<br> вечеринки</a></h2>
                    <div class="full-entry-link"><a href="#" data-goal="party">Подробнее</a></div>
                </li>
                <li>
                    <div class="image"><img src="<? echo $prefix; ?>/css/images/cup4.png" alt=""></div>
                    <h2><a href="#" data-goal="design">Индивидуальный<br> дизайн</a></h2>
                    <div class="full-entry-link"><a href="#" data-goal="design">Подробнее</a></div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="tab4 fonts-and-divider">
    <div class="left_shadow"></div>
    <div class="wrapper">
        <h1>ВЫБЕРИТЕ СУВЕНИРНУЮ<br>ПРОДУКЦИЮ</h1>
        <div class="divider colored_divider"></div>
        <p>на чем вам нужна печать?</p>
        <ul class="production clearfix">
            <?php
            $images_name = "shirt";
            $images_path = $prefix."/css/images/";
            $images_ext = ".png";

            $items = array(
                array("title" => "на футболке", "goal" => "t-shirt"),
                array("title" => "на толстовке", "goal" => "hoodle"),
                array("title" => "на ветровке", "goal" => "windbreaker"),
                array("title" => "на кружке", "goal" => "mug"),
                array("title" => "на тарелке", "goal" => "plate"),
                array("title" => "коврик мыши", "goal" => "mouse_pad"),
                array("title" => "на костере", "goal" => "Stand_mug"),
                array("title" => "на пазле", "goal" => "puzzles"),
                array("title" => "на подушке", "goal" => "pillow"),
                array("title" => "на фартуке", "goal" => "apron"),
                array("title" => "на шапке", "goal" => "hat"),
                array("title" => "на шарфе", "goal" => "scarf"),
                array("title" => "на галстуке", "goal" => "tie"),
                array("title" => "сумке с ручками", "goal" => "bag"),
                array("title" => "на зонте", "goal" => "umbrella"),
                array("title" => "на копилке", "goal" => "moneybox"),
                array("title" => "на ванном наборе", "goal" => "bathroom"),
                array("title" => "на мешочке", "goal" => "pouch"),
                array("title" => "на сапожке", "goal" => "boots")
            );
            $counter = 1;
            ?>

            <?php foreach($items as $item): ?>
                <?
                $image_uri = $images_path.$images_name.$counter.$images_ext;
                $counter++;
                ?>
                <li>
                    <div class="image"><span class="helper"></span><img src="<?php echo $image_uri; ?>" alt=""></div>
                    <p>Печать<br><span><?php echo $item['title']; ?></span></p>
                    <a href="#" class="item" data-title="Печать <?php echo $item['title']; ?>" data-goal="<?php echo $item['goal']; ?>"></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="btn-center"><a href="#" class="btn show-all-items">ПОСМОТРЕТЬ КАТАЛОГ ВСЕХ ТОВАРОВ</a></div>
    </div>
</div>
<div class="tab5">
    <div class="wrapper">
        <div class="top_cont clearfix">
            <div class="left">
                <h1>НАШИ<br>ПРЕИМУЩЕСТВА</h1>
                <div class="black_divider"></div>
                <p>перед другими компаниями</p>
            </div>
        </div>
        <div class="bigimage"></div>
        <div class="bottom_cont">
            <ul class="clearfix">
                <li>
                    <div class="image"><div class="printer"></div></div>
                    <p>Собственное<br>производство</p>
                </li>
                <li>
                    <div class="image"><div class="box"></div></div>
                    <p>Оперативная доставка<br>по всей России</p>
                </li>
                <li>
                    <div class="image"><div class="tshirt"></div></div>
                    <p>Высокое качество<br>товара</p>
                </li>
            </ul>
            <div class="btn-center"><a href="#" class="btn get_commercial_offer modal-call"
                                       data-title="Заказать звонок"
                                       data-source="Коммерческое предложение"
                                       data-btn="ОСТАВИТЬ ЗАЯВКУ" data-goal="offer">ПОЛУЧИТЬ КОММЕРЧЕСКОЕ ПРЕДЛОЖЕНИЕ</a></div>
        </div>
    </div>
</div>
<div class="tab6 fonts-and-divider clearfix">
    <div class="wrapper">
        <h1>как мы работаем?</h1>
        <div class="divider colored_divider"></div>
        <p>процесс нашей работы</p>
        <ul>
            <li>
                <div class="icon pda"></div>
                <p>Вы оставляете<br>заявку с описанием<br>заказа</p>
            </li>
            <li>
                <div class="icon sofa"></div>
                <p>Мы утверждаем<br>или редактируем<br>Ваш макет печати</p>
            </li>
            <li>
                <div class="icon doc"></div>
                <p>Делаем расчет<br>и формируем<br>Ваш заказ</p>
            </li>
            <li>
                <div class="icon sofa2"></div>
                <p>Быстро и качественно<br>печатаем и упаковываем<br>Ваш продукт</p>
            </li>
            <li>
                <div class="icon ok"></div>
                <p>Оперативно<br>доставляем Ваш<br>продукт</p>
            </li>
            <li>
                <a href="#" class="btn send_request modal-call" data-title="Оставить заявку" data-btn="ОСТАВИТЬ ЗАЯВКУ" data-source='Заявка с "Как мы работаем"' data-goal="application">ОСТАВИТЬ ЗАЯВКУ</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab7 fonts-and-divider">
    <div class="top"></div>
    <div class="wrapper">
        <h1>ОТЗЫВЫ<br>КЛИЕНТОВ</h1>
        <div class="divider colored_divider"></div>
        <div class="gb_container">
            <div class="gb_item">
                <div class="left">
                    <div class="image">
                        <img src="<? echo $prefix; ?>/css/images/ava2.png" alt="">
                    </div>
                    <p>Луиза Сулейманова</p>
                    <div class="vertical-divider"></div>
                    <a class="socials" href="https://www.facebook.com/profile.php?id=100008584784021" target="_blank">
                        <span class="fb"></span>
                    </a>
                </div>
                <div class="right">
                    <h2>Подарки на Новый год</h2>
                    <p>
                        <span class="grey">Данную Компанию мне порекомендовала подруга.</span>
                        Она заказывала себе футболку с <span class="purple">Angry Birds.</span> Надвигался Новый год, подарки… Решила заказать печать на кружке. <span class="grey">Как оказалось, НЕ ЗРЯ.</span> Описав свои желания, скинув пару картинок, они сделали мне несколько вариантов макетов. Мои идеи были превращены в произведения искусства. И как по веленью волшебной палочке доставлены на следующий день мне. Так что я в восторге! Спасибо, ребята! 
                    </p>
                </div>
            </div>

            <div class="gb_item clearfix">
                <div class="left">
                    <div class="image">
                        <img src="<? echo $prefix; ?>/css/images/ava1.png" alt="">
                    </div>
                    <p>Иван Шулекин</p>
                    <div class="vertical-divider"></div>
                    <a class="socials" href="http://vk.com/id8018785" target="_blank">
                        <span class="vk"></span>
                    </a>
                </div>
                <div class="right">
                    <h2>Футболки для музыкального клипа</h2>
                    <p><span class="purple">Мне срочно нужны были футболки с логотипом моей музыкальной группы для съемок.</span>
                        <span class="grey">Разместил заказ в группе вконтакте. </span>
                        Скорость приятно удивила, футболки были у меня на следующий день. Качество на высшем уровне. И цена приятно удивила, учитывая, что доставку делал на поздний вечер и прямо к порогу. Так что так держать! Позже сделаем заказ для наших поклонников!</p>
                </div>
            </div>

            <div class="gb_item clearfix">
                <div class="left">
                    <div class="image">
                        <img src="<? echo $prefix; ?>/css/images/ava3.png" alt="">
                    </div>
                    <p>Овсянников Алексей</p>
                    <div class="vertical-divider"></div>
                    <a class="socials" href="https://www.facebook.com/alex.ovsya" target="_blank">
                        <span class="fb"></span>
                    </a>
                </div>
                <div class="right">
                    <h2>Директор по маркетингу LAD RM Group </h2>
                    <p>Заказывали в подарок своим клиентам <span class="purple">оригинальные кружки с хамелеон.</span> Дизайн нам разработали под наш фирменный стиль на следующий день после заказа на сайте. Оперативно получили сувенирную продукцию в самые <span class="grey">"проблемные"</span> предновогодние дни и успели поздравить всех своих клиентов <span class="grey">с Новым Годом.</span> Спасибо коллективу ART PRINT за оперативность и качество продукции. </p>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="tab2 tab8_margin clearfix">
    <div class="wrapper">
        <a href="#" class="next-tab header_arrow" data-tabname="tab8_margin"></a>
        <div class="left">
            <h1>ОСТАВЬТЕ ЗАЯВКУ<br>ПРЯМО СЕЙЧАС</h1>
            <p>и <span>получите скидку 15%</span><br>на изготовление сувенирной<br>продукции</p>
            <div class="divider colored_divider"></div>
            <div class="action_b_panel">
                <div class="left">
                    До конца акции<br>
                    осталось:
                </div>
                <div class="right">
                    <div class="timer"></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="form-panel">
                <p>Заявка на получение<br><span>15%</span> скидки</p>
                <form method="post" name="form-1" class="arctic-form">
                    <input type="text" name="login" required value="" placeholder="Ваше имя..."/>
                    <input type="tel" name="phone" required value="" placeholder="Ваш телефон..."/>
                    <input type="email" name="email" required value="" placeholder="Ваш email..."/>
                    <input type="submit" class="feedback" name="send" value="ПОЛУЧИТЬ СКИДКУ" />
                    <input type="hidden" name="source" value="Заявка на получение 15% скидки после отзывов" />
                    <input type="hidden" name="goal" value="discount_footer" />
                    <div class="nospam">
                        <div class="nospam_icon"></div>
                        <p>Мы против спама</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="tab9 fonts-and-divider">
    <div class="wrapper">
        <h1>КОНТАКТЫ</h1>
        <div class="divider colored_divider"></div>
        <div class="content clearfix">
            <ul>
                <li>
                    <div class="icon location"></div>
                    <p>г. Москва, ст. м. Кунцевская, ул. Петра Алексеева,<br>д. 12, стр. 1 (Бизнес Парк "Октябрь")</p>
                </li>
                <li>
                    <div class="icon plane2"></div>
                    <p><a href="mailto:info@art-print.su" class="mail">info@art-print.su</a></p>
                </li>
                <li>
                    <div class="icon pda2"></div>
                    <p><a href="tel:+74996496956" class="phone">+7 (499) 649-69-56</a></p>
                </li>
            </ul>
        </div>
        <div class="map">
            <div class="inner">
                <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=klnmBsN60QdygRW48Hf0wf9u9ldYA0OW&width=960&height=406&lang=ru_UA&sourceType=constructor"></script>
            </div>
        </div>
    </div>
</div>
<div class="tab10 fonts-and-divider">
    <div class="top"></div>
    <div class="wrapper">
        <h1>FAQ</h1>
        <div class="divider colored_divider"></div>
        <p>ответы на часто задаваемые вопросы</p>
        <div class="content clearfix">
            <ul class="left">
                <li><a href="#" data-answer="Сделать заказ в ART PRINT очень просто.<br><br>
Заказ можно оформить на нашем сайте www.art-print.su в разделе «Выберите сувенирную продукцию». Для этого достаточно кликнуть на нужную услугу, ввести контактные данные и загрузить макет или картинку которую вы хотите видеть на продукции.
<br><br>Макет (фото, картинку) можете выслать на электронную почту Info@art-print.su с указанием контактных данных ФИО, телефон.   Менеджер свяжется с вами, обсудит все детали, а так же предоставит макет на изделии.">Как сделать заказ?</a></li>
                <li><a href="#" data-answer="Да, конечно.">Возможна ли печать на рукавах одежды?</a></li>
                <li><a href="#" data-answer="Да. Наша компания выполняет индивидуальные заказы на печать на футболках, толстовках, кружках и т.д.  в одном экземпляре.">Можно ли заказать печать в одном экземпляре?</a></li>
                <li><a href="#" class="multiline" data-answer="Мы делаем печать на одежде со спецэффектами, с применением различных технологий: теснение фольгой, флокирование.">Делаете ли печать на  <br>футболках/толстовках со спецэффектами?</a></li>
            </ul>
            <ul class="right">
                <li><a href="#" data-answer="От одного дня. Для единичных экземпляров при готовом макете возможна срочная печать в течение часа.">Каковы сроки выполнения заказа?</a></li>
                <li><a href="#" data-answer="Конечно можно! Мы принимаем заказы на печать фото на футболках, кружках и других изделиях.">Можно ли напечатать фотографию на изделии?</a></li>
                <li><a href="#" data-answer="Да, мы работаем по всей России. Доставляем любым удобным для вас способом, это Почта России, Транспортная компания, EMS.">Отправляете заказы в регионы России?</a></li>
                <li><a href="#" data-answer="Можно, если она имеет специальное покрытие. Мы рекомендуем заказывать печать с кружкой, т.к. мы используем кружки «премиум» что гарантирует качество.
На кружках из класса «стандарт» могут присутствовать не ровности, пузырьки, сколы. ">Можно ли напечатать на своей кружке?</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="tab11 fonts-and-divider">
    <div class="wrapper">
        <h1>остались вопросы?</h1>
        <div class="divider colored_divider"></div>
        <a href="#" class="ask_question">Задайте их нашему менеджеру</a>
    </div>
</div>
<footer>
    <div class="wrapper">
        <div class="top_head_panel">
            <a href="#" class="hlogo">Студия сувенирной печати</a>
            <div class="right-panel">
                <div class="mail">
                    <div class="plane"></div>
                    <a href="mailto:info@art-print.su">info@art-print.su</a>
                </div>
                <div class="phone-panel">
                    <div class="phone"><a href="tel:+74996496956">+7 (499) 649-69-56</a></div>
                    <a href="#" class="order-call modal-call"
                       data-title="Заказать звонок"
                       data-btn="ЗАКАЗАТЬ ЗВОНОК"
                       data-source="Заказать звонок в футере" data-goal="call_footer">Заказать звонок</a>
                </div>
            </div>
        </div>
        <p class="about_pp">ИП Куликов В.В.333</p>
    </div>
</footer>