<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/9/16
 * Time: 12:54 AM
 * For USERS
 */

$application = Application::getInstance();
$templatePath = $application->getTemplatePath();
$template = $application->getTemplateName();
$settings = $application->getSettings();

$baseURI = Url::$baseurl;

$login_status = Users::getLoginStatus();
$uid = Users::getUID();

$prefix = $baseURI . "/templates/" . $template;

// Site is on reconstruction
if( $application->isOnReconstruction() )
{
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    header('Retry-After: 300');//300 seconds
    $error_file = $templatePath."/errors/503.php";
    if ( file_exists($error_file) )
        include $error_file;
    else
        throw new CustomException("Шаблон не найден");
    die();
}
// ===========================================

// Generate main site page
if (file_exists($templatePath."/index.php")) {
    // Include default index template
    include $templatePath."/index.php";
} else {
    throw new CustomException("Шаблон не найден");
}
// ===========================================