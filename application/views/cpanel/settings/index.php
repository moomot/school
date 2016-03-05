
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Основные настройки
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <form role="form" method="post" action="<? echo Url::$baseurl; ?>/admin/save_site_settings" class="save_site_settings">
                    <div class="form-group">
                        <label for="title">Название сайта</label>
                        <input name="title" type="text" class="form-control" id="title" value="<? echo $data['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="desc">Описание сайта (meta)</label>
                        <input name="desc" type="text" class="form-control" id="desc" value="<? echo $data['description']; ?>">
                    </div>
                    <hr>
                    <div class="checkbox reconstruction">
                        <label><input name="reconstruction_status" type="checkbox" <? echo $data['onReconstruction'] == 1 ? 'checked' : null ; ?> >Сайт на реконструкции</label>
                    </div>
                    <div class="reason">
                        <label for="desc">Причина</label>
                        <input type="text" name="reconstruction_text" class="form-control" id="desc" value="<? echo $data['reconstructionReason']; ?>">
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                <label for="template" style="line-height: 34px;">Шаблон</label>
                            </div>
                            <div class="col-md-11">
                                <input type="hidden" name="template" id="template" value="<? echo $data['template']; ?>">
                                <div class="dropdown settings-dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown"><span><? echo $data['template']; ?></span> <b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="navbarDrop1">
                                        <?
                                        foreach ($data['tpl_list'] as $tpl) {
                                            echo '<li><a tabindex="-1">'.$tpl.'</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <input type="submit" class="btn btn-default" value="Сохранить">
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
