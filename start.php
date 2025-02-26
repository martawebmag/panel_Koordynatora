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
    <title>Strefa Koordynatora</title>
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
 
        <main>
            <div class="container">
            <?php if ($user_logged_in): ?>
                    <p class="zalogowanie">Jesteś zalogowany jako: <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong></p>
                <?php endif; ?>
            </div>

            <div class="container_index">
            <div class="login-container">
                <form method="post" action="login.php">
                    <h3>Logowanie</h3>

                    <div class="input-group">
                        <label for="login">Email</label>
                        <input type="text" id="email" name="email">
                    </div>
                    <div class="input-group">
                        <label for="haslo">Hasło</label>
                        <input type="password" id="password" name="pass">
                    </div>
                    <br>
                    <?php 
                    if(isset($_SESSION['blad'])) {
                        echo '<div class="error2">'.$_SESSION['blad'].'</div>';
                        unset($_SESSION['blad']);
                    }
                    ?>
                    <button type="submit" class="btn" name="login">Zaloguj się</button>

            
                    <div class="input-group">
                        <br>
                    <a href="forgot_password.php" style="font-size: 15px;">Zapomniałeś hasła?</a>
                    </div>
              
                </form>
            </div>

     

                    <div class="login-container">
                        <h4 style="color: #034180">Nie masz jeszcze konta? Zarejestruj się!</h4>
                       <a href="rejestracja.php" style="font-size: 15px;">Rejestracja</a>
            
                    </div>
            </div>
                
           
        </main>

        <?php include "includes/footer.php" ?>
</body>
</html>