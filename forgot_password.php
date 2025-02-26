<?php
session_start();
// Sprawdzenie, czy użytkownik jest zalogowany
if (isset($_SESSION['user_id'])) {
    $user_logged_in = true;
    $user_name = $_SESSION['user_name']; // Możesz używać tej zmiennej wszędzie
} else {
    $user_logged_in = false;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streafa Koordynatora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tektur:wght@400..900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" type="image/icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "includes/header.php" ?>

    <div class="container">
        <div class="login-container">
            <form id="reset-form" action="send_reset_link.php" method="POST">
                <div class="input-group">
                    <label for="reset-email">Podaj swój email:</label>
                    <input type="email" id="reset-email" name="email" required>

                    <?php
                    if (isset($_SESSION['e_mail'])) {
                        echo '<div class="error">' . $_SESSION['e_mail'] . '</div>';
                        unset($_SESSION['e_mail']); 
                    }
                ?>
                    <button type="submit" class="btn" style="margin-bottom: 18px;">Wyślij link resetujący</button>
                    <a href="start.php" style="font-size: 15px;">Wróć</a>
                </div>
            </form>
        </div>
    </div>
 


        <?php include "includes/footer.php" ?>
</body>
</html>