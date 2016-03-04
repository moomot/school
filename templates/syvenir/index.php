<?
header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
ob_start("sanitize_output");
function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><? echo $settings['title']; ?></title>
    <link rel="shortcut icon" href="<? echo $prefix; ?>/images/favicon.png" type="image/x-icon">
    <!-- Styles -->
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/screen.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/feedback/css/jquery.arcticmodal.css">
    <link rel="stylesheet" href="<? echo $prefix; ?>/feedback/css/jquery.jgrowl.css">
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/slick.css"/>
    <link rel="stylesheet" href="<? echo $prefix; ?>/css/slick-theme.css"/>

</head>
<body>
<div class="all_wrap">
    <? include $this->getView(); ?>
</div>
<!-- Libraries -->
<? include "modal.php"; ?>
<script src="<? echo $prefix; ?>/js/jquery-2.2.0.min.js"></script>

<script src="<? echo $prefix; ?>/feedback/js/feedback.min.js"></script>
<script src="<? echo $prefix; ?>/feedback/js/jquery.arcticmodal.js"></script>
<script src="<? echo $prefix; ?>/js/jquery.maskedinput.min.js"></script>
<script src="<? echo $prefix; ?>/js/slick.min.js"></script>
<script src="<? echo $prefix; ?>/js/dscountdown.js"></script>

<script src="<? echo $prefix; ?>/js/ui.js"></script>
</body>
</html>
