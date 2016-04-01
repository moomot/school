<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 31.03.16
 * Time: 22:12
 */
?>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Вiдкритi тiкети
                </a>
            </h4>
        </div>
            <div id="collapseOne" class="list-group panel-collapse collapse in">
                <?php if($data['active_tickets'] == null) :?>
                    <div class="panel-body">
                        Активних тiкетiв не iснує
                    </div>
                <?php else: ?>
                    <?php foreach ($data['active_tickets'] as $item): ?>
                        <a href="<? echo $baseURI . "/admin/feedback/" . $item['id']; ?>" class="list-group-item"><?php echo $item['title'] ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

    </div>

    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Закритi тiкети
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="list-group panel-collapse collapse">
                <?php if($data['inactive_tickets'] == null) :?>
                    <div class="panel-body">
                        Закритих тiкетiв не iснує
                    </div>
                <?php else: ?>
                    <?php foreach ($data['inactive_tickets'] as $item): ?>
                        <a href="<? echo $baseURI . "/admin/feedback/" . $item['id']; ?>" class="list-group-item"><?php echo $item['title'] ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>
</div>