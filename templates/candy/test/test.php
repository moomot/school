<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:27
 */
?>
<script type="text/javascript">
    var data= <? echo json_encode($data); ?> ;
    data=data['questions'];

    var current_page = "test";

    var current_question=0;
    var is_correct={};
    var mark=0;
</script>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Перевірка знань</div>
    <!-- Table -->
    <table class="table">
        <thead>
        <tr id="question">

        </tr>
        </thead>
        <tbody id="variants">

        </tbody>
    </table>
</div>