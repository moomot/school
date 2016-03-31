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
    <div class="panel-body feedback-ticket list-group">
        <?php foreach($data as $item): ?>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading"><? echo $data['user'] ?></h4>
                <p class="list-group-item-text">...</p>
            </a>
        <? endforeach; ?>
        <div class="clearfix"></div>
    </div>
</div>

