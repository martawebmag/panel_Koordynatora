<?php

session_start();
require 'db_connect.php';

if (isset($_GET['activation_token'])) {
    $activation_token = $_GET['activation_token'];

    $sql = "SELECT * FROM users WHERE activation_token = :activation_token LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['activation_token' => $activation_token]);
    $user = $stmt->fetch();

    if ($user) {
        $update_sql = "UPDATE users SET is_active = 1, activation_token = NULL WHERE id = :id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->execute(['id' => $user['id']]);

        header('Location: index_success2.php');
    } else {
        echo "Nieprawidłowy token!";
    }
} else {
    echo "Token aktywacyjny nie został przesłany.";
}


?>
