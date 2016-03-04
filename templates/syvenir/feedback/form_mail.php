<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/20/16
 * Time: 1:27 AM
 */
require 'PHPMailerAutoload.php';
require 'Config.php';

if ($_POST) { // eсли пeрeдaн мaссив POST
    $login = htmlspecialchars($_POST["login"]); // пишeм дaнныe в пeрeмeнныe и экрaнируeм спeцсимвoлы
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $item = htmlspecialchars($_POST["item"]);
    $source = htmlspecialchars($_POST["source"]);

    //$login = iconv("UTF-8", "WINDOWS-1251", $login);
    //$email = iconv("UTF-8", "WINDOWS-1251", $email);
    ///$item = iconv("UTF-8", "WINDOWS-1251", $item);
    //$source = iconv("UTF-8", "WINDOWS-1251", $source);
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    $config = new Config;
    $mail->CharSet = $config->charset;
    //Set who the message is to be sent from
    $mail->SetFrom($config->fromMail, $config->fromName);

    //Set who the message is to be sent to
    $mail->AddAddress($config->address);
    //Set the subject line
    $mail->Subject = $item;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->Body = "Имя: ${login}<br>Почта: ${email}<br>Телефон: {$phone}<br>{$item}<br>Источник: {$source}";
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    //Attach an image file

    $mail->AddAttachment($_FILES['file1']['tmp_name'], $_FILES['file1']['name']);
    $mail->AddAttachment($_FILES['file2']['tmp_name'], $_FILES['file2']['name']);

    $mail->IsHTML(true);
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}
