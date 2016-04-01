<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 31.03.16
 * Time: 23:18
 */
extract($data);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Тiкет "<?php echo $opt['title']; ?>"
    </div>
</div>

<div id="ticket-answers">
    <?php foreach($data as $item): ?>
        <?php if($currentUserLogin['login'] == $item['login']): ?>
            <a class="list-group-item">
                <h5 class="list-group-item-heading"><? echo $item['login'] . " - " . date("Y-m-d H:i:s", $item['timestamp']); ?></h5>
                <p class="list-group-item-text"><? echo $item['message'] ?></p>
            </a>
        <?php else: ?>
            <a class="list-group-item list-group-item-right list-group-item-info">
                <h5 class="list-group-item-heading"><? echo $item['login'] . " - " . date("Y-m-d H:i:s", $item['timestamp']); ?></h5>
                <p class="list-group-item-text"><? echo $item['message'] ?></p>
            </a>
        <?php endif; ?>
    <? endforeach; ?>
</div>
    <?php if($opt['status'] == 1): ?>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Нова вiдповiдь</a>
        </div>
        <div id="collapseTwo" class="panel-body feedback-ticket panel-collapse collapse in">
            <div class="ticket_status_msg">
                <div class="alert alert-info"><? echo $data['message']; ?></div>
            </div>
            <div class="sendform">
                <form action="<?= $baseURI;?>/admin/answer_ticket" class="answer_ticket" method="post" accept-charset="utf-8">
                    <div class="form-group col-lg-12">
                        <label for="message">Повiдомлення</label>
                        <textarea id="message" class="form-control" rows="5" placeholder="Напишiть повiдомлення" name="message" required></textarea>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-default btn-success pull-right" value="Надiслати &rarr;"/>
                    </div>
                    <input type="hidden" name="ticket_id" value="<?= $opt['id']; ?>">
                </form>
            </div>
        </div>
    </div>

    <div class="text-right">
        <a href="<?= $baseURI; ?>/admin/close_feedback/<?= $opt['id']; ?>" class="btn btn-default btn-danger">Закрити звернення</a>
    </div>
    <?php else: ?>
            <br>
            <div class="alert alert-danger">Тiкет закритий</div>
    <?php endif; ?>
