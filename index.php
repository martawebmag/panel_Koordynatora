<?php
session_start();

// Ustaw swoje dane logowania
$password = "panel123";

// Sprawdź, czy dane logowania zostały przesłane
if ( isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['logged_in'] = true;
        header("Location: start.php"); // Przekierowanie na stronę główną formularza
        exit();
    } else {
        $error = "Nieprawidłowe hasło!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        /* Stylowanie strony */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            margin: 0;
            font-family: "Open Sans", sans-serif;
            background-color: #f2f2f2;
        }
        /* Stylowanie formularza */
        .login-container {
            background-color: #fff;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h3 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 22px;
        }
        .login-container label {
            display: block;
            font-size: 0.9rem;
            color: #666;
            margin-top: 1rem;
            text-align: left;
        }
        .login-container input[type="password"] {
            width: 91%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        .login-container button {
            width: 100%;
            padding: 0.8rem;
            background-color: #2059c2;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            margin-top: 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-container button:hover {
            background-color: #346bcf;
        }

        /* Stylowanie błędu */
        .error {
            color: #d9534f;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="login-container">
    <img src="images/logo.jpg" alt="logo Fundacji" style="width: 30%" />
        <h3>Wprowadź hasło, aby uzyskać dostęp do panelu:</h3>
        <form method="post">
  
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" class="password" required>

            <button type="submit">Zaloguj się</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>