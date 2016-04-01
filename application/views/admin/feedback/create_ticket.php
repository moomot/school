<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 31.03.16
 * Time: 23:18
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Створення тiкету
    </div>
    <div class="panel-body feedback-ticket">
        <div class="sendform">
            <form action="submit_ticket" class="message_submit" method="post" accept-charset="utf-8">
                <div class="form-group col-lg-12">
                    <input type="text" class="form-control" required name="title" value=""  placeholder="Назва тiкету">
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
    </div>
</div>

