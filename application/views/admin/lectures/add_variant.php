<form action="<? echo Url::$baseurl; ?>/admin/add_variant" method="post" accept-charset="utf-8">
    <h3>Створення варіанту</h3>
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
        </span>
        <input type="text" class="form-control" required name="answer"
            value="" placeholder="Варіант відповіді" />
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock"></span>
        </span>
        <input type="checkbox" class="form-control" name="correct" value="checked">Правильний</input>
    </div>
    <input type="hidden" name="question" value="<? echo $data['question'] ?>" />
    <input type="hidden" name="lecture" value="<? echo $data['lecture'] ?>" />
    <p>
        <input type="submit" class="btn btn-success btn-block" name="save" value="Зберегти &rarr;" />
    </p>
</form>
