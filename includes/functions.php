<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_activated_mail() {

$mail = new PHPMailer(true);
$email = $_POST['email'];
$activation_token = $_POST['activation_token'];

try {
    // Konfiguracja SMTP
    $mail->isSMTP();                                      // Użyj SMTP
    $mail->Host = 'dzielopl.home.pl';                     // Podaj adres serwera SMTP
    $mail->SMTPAuth = true;                               // Włącz uwierzytelnianie SMTP
    $mail->Username = 'marta.galecka@dzielo.pl';           // Twój e-mail SMTP
    $mail->Password = 'H_kVDyNY';                      // Hasło SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Włącz szyfrowanie TLS
    $mail->Port = 587;      
    $mail->CharSet = 'UTF-8';    

    // Dane nadawcy i odbiorcy
    $mail->setFrom('marta.galecka@dzielo.pl', 'Marta Gałecka');
    $mail->addAddress($email); // Adres odbiorcy

    // Treść maila
    $activation_link = "https://localhost/panel_nowy3/activate_user.php?token=$activation_token";
    $mail->isHTML(true);
    $mail->Subject = 'Aktywacja konta';
    $mail->Body = "
        <html>
        <head>
          <title>Aktywacja konta</title>
        </head>
        <body>
          <p>Cześć,</p>
          <p>Dziękujemy za rejestrację! Kliknij poniższy link, aby aktywować swoje konto:</p>
          <p><a href='$activation_link'>$activation_link</a></p>
        </body>
        </html>
    ";

    // Wyślij mail
    $mail->send();
    header('Location: index_success.php');
} catch (Exception $e) {
    echo "Błąd wysyłki maila: {$mail->ErrorInfo}";
}

}