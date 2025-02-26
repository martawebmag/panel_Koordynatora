<?php

session_start();

require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Walidacja długości hasła
    if (strlen($newPassword) < 8) {
        // Zapisz komunikat o błędzie w sesji
        session_start();
        $_SESSION['e_password'] = "Hasło musi mieć co najmniej 8 znaków.";
        // Przekierowanie z powrotem do strony reset_password.php
        header("Location: reset_password.php?token=" . htmlspecialchars($token));
        exit();
    }

    // Sprawdzenie, czy hasła się zgadzają
    if ($newPassword !== $confirmPassword) {
        session_start();
        $_SESSION['e_password'] = "Hasła się nie zgadzają.";
        header("Location: reset_password.php?token=" . htmlspecialchars($token));
        exit();
    }


        
    // Weryfikacja tokenu
    $stmt = $pdo->prepare('SELECT user_id, expiry FROM password_resets WHERE token = :token');
    $stmt->execute(['token' => $token]);
    $reset = $stmt->fetch();

    if ($reset && strtotime($reset['expiry']) > time()) {
        // Aktualizacja hasła
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');
        $stmt->execute(['password' => $hashedPassword, 'id' => $reset['user_id']]);

        // Usunięcie tokenu
        $stmt = $pdo->prepare('DELETE FROM password_resets WHERE token = :token');
        $stmt->execute(['token' => $token]);

        header('Location: changed_password.php');
    } else {
        echo "Nieprawidłowy lub wygasły token.";
    }
}
?>
