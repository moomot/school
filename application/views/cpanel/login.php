<?php
$config = Application::getConfig();
$baseURI = Url::$baseurl;

$login_status = Users::getSchoolLoginStatus();
$uID = Users::getUID();
$prefix = $baseURI."/assets";
ob_clean();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? echo $settings['title']; ?></title>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/style.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/bootstrap-datetimepicker.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include "sections/navbar.php"; ?>
<div class="container">
    <div class="aligner">
        <div class="row">
            <div class="center-block login-form">
                <div class="well">
                    <form class="form-signin" method="POST" action="<? echo $baseURI."/cpanel/login"; ?>" name="do_login">
                        <h2 class="form-signin-heading">
                            <?php if($login_status=="access_denied"): ?>
                                <p style="color:red">Неправильный логин или пароль</p>
                                <?php Session::destroy(); ?>
                            <?php endif; ?>
                        </h2>
                        <label for="inputEmail" class="sr-only">Login</label>
                        <input type="text" name="login" class="form-control" placeholder="Логин или почта" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me"> Запомнить меня?
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Авторизироваться</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<? echo $prefix; ?>/js/jquery-1.11.1.min.js"></script>
<script src="<? echo $prefix; ?>/js/moment-with-locales.js"></script>
<script src="<? echo $prefix; ?>/js/bootstrap.min.js"></script>
<script src="<? echo $prefix; ?>/js/bootstrap-datetimepicker.min.js"></script>
</body>
</html>
