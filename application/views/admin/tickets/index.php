<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Редактор білетів</div>

    <? if($data['ticket']==-1) { ?>

    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Назва</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($data['tickets'] as $item) {?>
            <tr>
                <td>
                    <a href="<? echo $baseURI. "/admin/tickets/" . $item['id']; ?>">
                        <? echo $item['name']; ?>
                    </a>
                </td>
                <td>
                    <div class="text-right">
                        <a href="<? echo $baseURI; ?>/admin/remove_ticket<? echo "/$item[id]"; ?>"
                            class="btn btn-danger">
                            Видалити білет
                        </a>
                    </div>
                </td>
            </tr>
            <? } ?>
        </tbody>
    </table>
    <div class="panel-body">
    <form action="<? echo $baseURI; ?>/admin/add_ticket" method="post" accept-charset="utf-8">
        <input type="text" class="form-control" required name="name" placeholder="Назва" />
        <input type="submit" class="btn btn-success btn-block" name="save" value="Додати білет &rarr;" />
    </form>
        </div>
    <? } else { ?>
    <div class="panel-heading">Список питань</div>
    <form action="<? echo $baseURI; ?>/admin/set_ticket_data" method="post" accept-charset="utf-8">
    <? foreach ($data['lectures'] as $litem) { ?>
    <div class="panel-heading"><? echo $litem['name'] ?></div>
    <table class="table">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Питання</th>
                <th>Включити в білет</th>
            </tr>
        </thead>
        <tbody>
            <?
           $count=1;
           foreach ($litem['questions'] as $qitem) {
            ?>
            <tr>
                <td>
                    <? echo $count; ?>
                </td>
                <td>
                    <? echo $qitem['question']; ?>
                </td>
                <td>
                    <input name="question<? echo $qitem['id'] ?>" type="checkbox" <? if(isset($qitem['included'])) echo "checked=\"checked\""; ?> value="<? echo $qitem['id'] ?>"/>
                </td>
            </tr>
            <? ;
           $count++; } ?>
        </tbody>
    </table>
    <? } ?>
    <input type="submit" class="btn btn-success btn-block" name="save" value="Зберегти &rarr;" />
    <input name="ticket" value="<? echo $data['ticket']; ?>" type="hidden" />
    </form>
    <? } ?>
</div>