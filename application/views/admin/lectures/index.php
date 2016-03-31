<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Редактор лекцій</div>

    <? if($data['current_lecture']==-1) { ?>

    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Назва</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($data['lectures'] as $item) {?>
            <tr>
                <td>
                    <? echo $item['number']; ?>
                </td>
                <td>
                    <a href="<? echo $baseURI. "/admin/lectures/" . $item['number']; ?>">
                        <? echo $item['name']; ?>
                    </a>
                </td>
            </tr>
            <? } ?>
        </tbody>
    </table>
    <?
 } else {
    foreach ($data['lectures'] as $item) {
    if($data['current_lecture']==$item['number']) {
    ?>
    <div class="panel-heading">Список питань</div>
    <table class="table">
        <thead>
            <tr>
                <? if(count($data['questions'])!=0) {?>
                <th>Номер</th>
                <th>Питання</th>
                <? } else { ?>
                <th>Питань немає</th>
                <? } ?>
            </tr>
        </thead>
        <tbody>
            <?
           $count=1;
           foreach ($data['questions'] as $qitem) {
            ?>
            <tr>
                <td>
                    <? echo $count; ?>
                </td>
                <td>
                    <? echo $qitem['question']; ?>
                </td>
                <td>
                    <div class="text-right">
                        <a href="<? echo $baseURI; ?>/admin/edit_question<? echo "/$qitem[id]"; ?>"
                           class="btn btn-primary">
                            Змінити питання
                        </a>
                        <a href="<? echo $baseURI; ?>/admin/remove_question<? echo "/$qitem[id]"; ?>"
                           class="btn btn-danger">
                            Видалити питання
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="table">
                        <thead>
                            <tr>
                                <? if(count($qitem['variants'])!=0) {?>
                                <th>Варіант відповіді</th>
                                <th>Правильний</th>
                                <? } else { ?>
                                <th>Варіантів немає</th>
                                <? } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?foreach ($qitem['variants'] as $vitem) { ?>
                            <tr>
                                <td>
                                    <? echo $vitem['answer']; ?>
                                </td>
                                <td>
                                    <? echo $vitem['correct']; ?>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <a href="<? echo $baseURI; ?>/admin/remove_variant<? echo "/$vitem[id]/$data[current_lecture]"; ?>"
                                           class="btn btn-primary">
                                            Видалити варіант
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a href="<? echo $baseURI; ?>/admin/add_variant<? echo "/$qitem[id]/$data[current_lecture]"; ?>"
                           class="btn btn-success">
                            Додати варіант
                        </a>
                    </div>
                </td>
            </tr>
            <?
 $count++;
           }
            ?>
        </tbody>
    </table>
    <div class="text-right">
        <a href="<? echo $baseURI; ?>/admin/add_question<? echo "/$data[current_lecture]"; ?>"
           class="btn btn-success">
            Додати питання
        </a>
        <a href="<? echo $baseURI; ?>/admin/edit_lecture<? echo "/$data[current_lecture]"; ?>"
           class="btn btn-primary">
            Змінити лекцію
        </a>
        <a href="<? echo $baseURI; ?>/admin/remove_lecture<? echo "/$data[current_lecture]"; ?>"
           class="btn btn-danger">
            Видалити лекцію
        </a>
        <form action="admin/choose_video/<? echo "/$data[current_lecture]"; ?>" method="post" accept-charset="utf-8">
            <input name="video_file" type="file" />
            <input name="submit" type="submit" value="Завантажити відео" class="btn btn-success" />
        </form>
    </div>
    <? } ?>
    <? } ?>
    <? } ?>
</div>
<div class="text-right">

    <a href="<? echo $baseURI; ?>/admin/add_lecture" class="btn btn-success">Додати лекцію</a>
</div>
