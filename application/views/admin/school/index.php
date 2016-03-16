<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:07
 */
?>
<div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Список шкiл</div>

      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Логин</th>
            <th>Название</th>
            <th>Телефон</th>
          </tr>
        </thead>
        <tbody>
        <? foreach ($data as $item) { ?>
          <tr>
            <td><? echo $item['uid']; ?></td>
            <td><a href="<? echo $baseURI. "/admin/list/" . $item['login']; ?>"><? echo $item['login']; ?></a></td>
            <td><? echo $item['full_name']; ?></td>
            <td><? echo $item['phone']; ?></td>
          </tr>
        <? } ?>
        </tbody>
      </table>
    </div>
<div class="text-right">
    <a href="<? echo $baseURI; ?>/admin/add_school" class="btn btn-success">Створити школу</a>
</div>