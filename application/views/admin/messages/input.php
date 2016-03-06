
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
        <th>Автор</th>
        <th>Повiдомлення</th>
    </tr>
    </thead>
    <tbody>
    <?
if(isset($data['status'])) {
    echo $data['status'];
} else {
    foreach($data as $item) {
        ?>
        <tr>
            <td><a href="#"><? echo $item['login']; ?></a></td>
            <td><? echo $item['message']; ?></td>
        </tr>
        <?
    }
}
?>
    </tbody>
</table>
