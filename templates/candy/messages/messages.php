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
        <th>Повiдомлення</th>
        <th style="text-align:right">Дата</th>
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
                <td><? echo $item['message']; ?></td>
                <td align="right"><?= date("Y-m-d H:i:s", $item['timestamp']); ?></td>
            </tr>
            <?
        }
    }
    ?>
    </tbody>
</table>
