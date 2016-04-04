<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Редактор вiдео</div>
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Назва</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($data as $item) {?>
            <tr>
                <td>
                    <? echo $item['number']; ?>
                </td>
                <td>
                    <a href="<? echo $baseURI. "/admin/lectures_video/" . $item['id']; ?>">
                        <? echo $item['name']; ?>
                    </a>
                </td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
