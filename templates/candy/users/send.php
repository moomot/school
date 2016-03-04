<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:15
 */
?>



<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>

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
                <li class="active"><a href="<? echo $baseURI; ?>/upanel/messages">Повiдомлення</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/tickets">Бiлети</a></li>
                <li><a href="<? echo $baseURI; ?>/upanel/shedule">Розклад занять</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-12 center_container">
        <div class="well well-sm">

            <div class="form-group">
                <label for="message" class="h4 ">Повiдомлення</label>
                <textarea id="message" class="form-control" rows="5" placeholder="Ваше повiдомлення" required></textarea>
            </div>
            <button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Надiслати</button>
            <div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>