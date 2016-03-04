<? ob_clean(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exception</title>
    <style>
        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            font-family: Arial;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .alert-danger hr {
            border-top-color: rgba(228, 185, 192, 0.35);
            border-bottom: 0;
            border-left: 0;
            border-right: 0;
        }
        .alert-danger p {
            font-size: 11px;
        }
    </style>
</head>
<body>
<div class="container">
    <?
        $trace = $e->getTraceAsString();
        $trace = preg_replace("/#/","<br>#", $trace);
    ?>
    <div class="alert alert-danger"><? echo $e->getMessage().'<hr><p>'.$trace.'</p>'; ?></div>
</div>

</body>
</html>
<?
    exit;
?>