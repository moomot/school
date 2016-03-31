<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:15
 */
?>

<div class="row sendform col-lg-12">
    <form action="<? echo $baseURI; ?>/cpanel/messages/submit_send_message" class="message_submit" method="post" accept-charset="utf-8">
        <div class="form-group col-lg-12">
            <input type="hidden" name="school_name" id="template" value="Оберiть отримувача">
            <div class="dropdown settings-dropdown">
                <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown"><span></span> <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="navbarDrop1">
                    <?
                    foreach ($data as $item) {
                        echo '<li><a tabindex="-1">'.$item['login'].'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label for="message">Повiдомлення</label>
            <textarea id="message" class="form-control" rows="5" placeholder="Напишiть повiдомлення" name="message" required></textarea>
        </div>
        <div class="col-lg-12">
            <input type="submit" class="btn btn-default btn-success pull-right" value="Надiслати &rarr;"/>
        </div>
    </form>
</div>
<div class="clearfix"></div>