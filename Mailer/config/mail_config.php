<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

function mailConfig() {

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'example@gmail.com';   // 🔴 မင်း Gmail
    $mail->Password = '**********';     // 🔴 16-digit
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('example@gmail.com', 'Job Portal System');
    $mail->isHTML(true);

    return $mail;
}
