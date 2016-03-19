<form action="<? echo Url::$baseurl;
                  if(isset($data['create'])) echo '/admin/add_lecture';
                  else echo '/admin/edit_lecture'; ?>"
                  method="post" accept-charset="utf-8">
    <h3>Редагування лекції</h3>
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
        </span>
        <input type="number" class="form-control" required name="number"
        value="<?if(isset($data['number'])) echo $data['number']; ?>" placeholder="Номер лекції" />
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock"></span>
        </span>
        <input type="text" class="form-control" required name="name" placeholder="Назва"
        value="<? if(isset($data['name'])) echo $data['name']; ?>">
    </div>
    <? if(!isset($data['create'])) echo "<input type=\"hidden\" name=\"old_number\" value=\"$data[number]\" >" ?>
    <p>
        <input type="submit" class="btn btn-success btn-block" name="save" value="Зберегти &rarr;" />
    </p>
</form>
