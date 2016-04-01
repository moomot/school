<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:15
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Написання повiдомлення
    </div>
    <div class="panel-body feedback-ticket">
        <div class="sendform row">
            <form action="submit_send_message" class="message_submit" method="post" accept-charset="utf-8">
                <input type="hidden" name="school_name" id="template" value="<?= $data; ?>">
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

