<?php 
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
            <form>

                <div class="input-group">
                    <p style="margin-bottom: 8px; font-size: 18px;">Na podanego emaila wysłano wiadomość z linkiem resetującym hasło.</p>
                    <p style="font-size: 18px">Link jest aktywny przez godzinę.</p>
                </div>

              
            </form>
        </div>
    </div>
 


        <?php include "includes/footer.php" ?>
</body>
</html>