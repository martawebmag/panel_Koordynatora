<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $user_logged_in = true;
    $user_name = $_SESSION['user_name']; // Możesz używać tej zmiennej wszędzie
} else {
    $user_logged_in = false;
}

// Import biblioteki PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer autoload

require 'db_connect.php'; 

// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        // Sprawdź, czy e-mail istnieje w bazie danych
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Użytkownik istnieje, generujemy token resetu
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Usuń stare tokeny dla użytkownika (opcjonalne)
            $pdo->prepare("DELETE FROM password_resets WHERE user_id = :user_id")
                ->execute(['user_id' => $user['id']]);

            // Wstaw nowy token do tabeli password_resets
            $stmt = $pdo->prepare("
                INSERT INTO password_resets (user_id, token, expiry)
                VALUES (:user_id, :token, :expiry)
            ");
            $stmt->execute([
                ':user_id' => $user['id'],
                ':token' => $token,
                ':expiry' => $expiry
            ]);

            // Tworzenie linku resetu hasła
            $resetLink = "https://localhost/panel_Koordynatora/reset_password.php?token=" . $token;

            // Konfiguracja i wysyłka e-maila za pomocą PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Konfiguracja serwera SMTP
                $mail->isSMTP();                                      // Użyj SMTP
                $mail->Host = 'dzielopl.home.pl';                     // Podaj adres serwera SMTP
                $mail->SMTPAuth = true;                               // Włącz uwierzytelnianie SMTP
                $mail->Username = 'marta.galecka@dzielo.pl';           // Twój e-mail SMTP
                $mail->Password = 'H_kVDyNY';                      // Hasło SMTP
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Włącz szyfrowanie TLS
                $mail->Port = 587;      
                $mail->CharSet = 'UTF-8';    

                // Treść wiadomości
                $mail->setFrom('marta.galecka@dzielo.pl', 'Marta Gałecka');
                $mail->addAddress($email); // Adres odbiorcy
                $mail->Subject = 'Resetowanie hasła';
                $mail->Body = "Witaj,\n\nKliknij w poniższy link, aby zresetować swoje hasło:\n\n$resetLink\n\nLink wygaśnie za 1 godzinę.";

                $mail->send();
                header('Location: send_mail_info.php');
            } catch (Exception $e) {
                echo "Błąd podczas wysyłania e-maila: {$mail->ErrorInfo}";
            }
        } else {
            $_SESSION['e_mail'] = "Nie znaleziono użytkownika z podanym adresem e-mail.";
            header("Location: forgot_password.php?token=" . htmlspecialchars($token));
            exit();
        }
    } else {
        $_SESSION['e_mail'] = "Podaj poprawny adres email.";
        header("Location: forgot_password.php?token=" . htmlspecialchars($token));
        exit();
    }
} else {
    echo "Nieautoryzowane żądanie.";
}
?>

