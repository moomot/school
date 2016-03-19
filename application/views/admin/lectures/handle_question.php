<form action="<? echo Url::$baseurl;
                 if(isset($data['create'])) echo '/admin/add_question';
                 else echo '/admin/edit_question'; ?>"
    method="post" accept-charset="utf-8">
    <h3>Редагування питання</h3>
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
        </span>
        <input type="number" class="form-control" required name="lecture"
            value="<?if(isset($data['lecture'])) echo $data['lecture']; ?>" placeholder="Номер лекції" />
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock"></span>
        </span>
        <textarea type="text" class="form-control" required name="question" placeholder="Питання"
                  id="" cols="30" rows="10"><? if(isset($data['question'])) echo $data['question']; ?></textarea>
    </div>
    <? if(!isset($data['create'])) echo "<input type=\"hidden\" name=\"old_id\" value=\"$data[id]\" >" ?>
    <p>
        <input type="submit" class="btn btn-success btn-block" name="save" value="Зберегти &rarr;" />
    </p>
</form>
