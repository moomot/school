<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 12:59 AM
 */
?>
<div class="aligner">
    <div class="row">
        <div class="center-block login-form">
            <div class="well">
                <form class="form-signin" method="POST" action="<? echo $baseURI."/user/login"; ?>" name="do_login">
                    <h2 class="form-signin-heading">
                        <?php if($login_status=="access_denied"): ?>
                            <p style="color:red">Логин и/или пароль введены неверно.</p>
                            <?php Session::destroy(); ?>
                        <?php endif; ?>
                    </h2>
                    <label for="inputEmail" class="sr-only">Login</label>
                    <input type="text" name="login" class="form-control" placeholder="Логин" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Запомнить?
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Авторизация</button>
                </form>
            </div>
        </div>
    </div>

</div>
