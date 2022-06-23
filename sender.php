<?php

require './vendor/autoload.php';

use Dotenv\Dotenv;

// Load dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Konfigurasi untuk Mengirim Email
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'in-v3.mailjet.com';
$mail->SMTPAuth = true;
$mail->Username = $_ENV['USERNAME'];
$mail->Password = $_ENV['PASSWORD'];
$mail->SMTPSecure = 'tls';
$mail->Port = 587;


// print_r($_POST['email'])

$mail->setFrom('theissentani@gmail.com', 'no-reply');

$mail->isHTML(true);

$mail->Subject = $_POST['subjek'];
$mail->addAddress($_POST['email'], $_POST['nama_penerima']);
$mail->Body = $_POST['body'];

if (!$mail->send()) {

    echo "Email tidak berhasil dikirim.!";
} else {
    header("Location: success.php");
}
