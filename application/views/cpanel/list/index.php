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
      <div class="panel-heading">Список студентiв</div>

      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Имя пользователя</th>
              <th>Адрес</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['firstname']; ?></td>
                <td><?php echo $item['lastname']; ?></td>
                <td><?php echo $item['login']; ?></td>
                <td><?php echo $item['address']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>