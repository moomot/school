<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 27.03.16
 * Time: 1:05
 */
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Редагування сторiнки "<? echo $data['title']; ?>"</div>
    <div class="panel-body">
        <!-- Table -->
        <form role="form" method="post" action="<? echo Url::$baseurl; ?>/admin/save_page" class="save_site_settings">
            <table class="table list">
                <tbody>
                <tr>
                    <td>#</td>
                    <td><input class="form-control" type="text" name="id" value="<? echo $data['id']; ?>"></td>
                </tr>
                <tr>
                    <td>Назва</td>
                    <td><input class="form-control" type="text" name="title" value="<? echo $data['title']; ?>"></td>
                </tr>
                <tr>
                    <td>Контент</td>
                    <td>
                        <textarea class="form-control" required name="content" placeholder="Контент" id="" cols="30" rows="10"><? echo $data['content']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Статус публикации (1, 0)</td>
                    <td><input class="form-control" type="text" name="status" value="<? echo $data['status']; ?>"></td>
                </tr>
                <tr>
                    <td>Статус комментариев (1, 0)</td>
                    <td><input class="form-control" type="text" name="comments_status" value="<? echo $data['comments_status']; ?>"></td>
                </tr>
                </tbody>
            </table>
            <div class="text-center">
                <input type="submit" class="btn btn-default btn-primary" value="Зберегти">
            </div>
        </form>
    </div>

</div>
