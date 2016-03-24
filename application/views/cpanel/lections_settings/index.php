<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 24.03.16
 * Time: 13:51
 */
?>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Основнi налаштування лекцiй
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <form action="" class="message_submit" method="post" accept-charset="utf-8">
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="school_name" id="template" value="Оберiть користувача">
                        <div class="dropdown settings-dropdown">
                            <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown"><span></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="navbarDrop1">
                                <?
                                foreach ($data['users'] as $item) {
                                    echo '<li><a tabindex="-1">'.$item['login'].'</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <?php foreach($data['available_lections'] as $item): ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Лекция номер <?php echo $item['lection_number']; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Настройки учетной записи администратора
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                <a href="" class="btn btn-default">Смена логина</a>
                <a href="" class="btn btn-default">Смена пароля</a>
                <a href="" class="btn btn-default">Напомнить пароль</a>
            </div>
        </div>
    </div>
</div>
