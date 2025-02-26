<?php
session_start();

if ((!isset($_POST['email'])) || (!isset($_POST['pass'])) ) {
    // Jeśli użytkownik jest już zalogowany, przekieruj na stronę główną
    header('Location: start.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    require 'db_connect.php'; // Połączenie z bazą danych

    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['pass']);

    // Sprawdzanie poprawności danych
    if (!empty($email) && !empty($password)) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['blad'] = 'Nieprawidłowy format e-maila!';
            header('Location: start.php');
            exit();
        }

            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();
    
                if ($user && password_verify($password, $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_email'] = $user['email'];
                    unset($_SESSION['blad']);
                    header('Location: user_panel.php');
                    exit();
                } else {
                    if (!$user) {
                        $_SESSION['blad'] = 'Użytkownik o podanym e-mailu nie istnieje.';
                    } elseif (!password_verify($password, $user['password'])) {
                        $_SESSION['blad'] = 'Nieprawidłowe hasło.';
                    }
                }
            } catch (PDOException $e) {
                $_SESSION['blad'] = 'Wystąpił problem z połączeniem do bazy danych.';
            }
        } else {
            $_SESSION['blad'] = 'Proszę wypełnić wszystkie pola.';
        
    }
        header('Location: start.php');
        exit();
}
?>
