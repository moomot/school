<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 07.03.16
 * Time: 0:44
 */
?>
<!-- Table -->
<table class="table">
    <thead>
    <tr>
        <th>Пользователь</th>
        <th>Повiдомлення</th>
    </tr>
    </thead>
    <tbody>
    <?
    if (isset($data['status'])) {
        ?>
        <tr>
            <td>
                <? echo $data['status']; ?>
            </td>
        </tr>
        <?
    } else {
        foreach ($data as $item) {
            ?>
            <tr>
                <td><a href="<? echo Url::$baseurl. "/admin/list/" . $item['login']; ?>"><? echo $item['login']; ?></a></td>
                <td><? echo $item['message']; ?></td>
            </tr>
            <?
        }
    }
    ?>
    </tbody>
</table>
