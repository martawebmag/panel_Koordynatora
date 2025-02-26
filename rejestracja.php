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
            <div class="login-container">

                <h3>Rejestracja</h3>
                <form action="register.php" method="post" id="form">
            
                    <div class="input-group-register">
                        <div class="input-group">
                            <label for="name">Imię</label>
                            <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                        <?php
                            if (isset($_SESSION['e_name']))
                            {
                                echo '<div class="error">'.$_SESSION['e_name'].'</div>';
                                unset($_SESSION['e_name']);
                            }
                        ?>
                        </div>
                        <div class="input-group">
                            <label for="surname">Nazwisko</label>
                            <input type="text" id="surname" name="surname">
                            <?php
                            if (isset($_SESSION['e_surname']))
                            {
                                echo '<div class="error">'.$_SESSION['e_surname'].'</div>';
                                unset($_SESSION['e_surname']);
                            }
                             ?>
                         </div>
                
                        <div class="input-group">
                            <label for="diocese">Diecezja</label>
                            <select id="diocese" name="diocese">
                                <option value="">---</option>
                                <option>białostocka</option>
                                <option>bielsko-żywiecka</option>
                                <option>bydgoska</option>
                                <option>częstochowska</option>
                                <option>drohiczyńska</option>
                                <option>elbląska</option>
                                <option>ełcka</option>
                                <option>gdańska</option>
                                <option>gliwicka</option>
                                <option>gnieznieńska</option>
                                <option>kaliska</option>
                                <option>katowicka</option>
                                <option>kielecka</option>
                                <option>koszalińsko-kołobrzeska</option>
                                <option>krakowska</option>
                                <option>legnicka</option>
                                <option>lubelska</option>
                                <option>łomżyńska</option>
                                <option>łowicka</option>
                                <option>łódzka</option>
                                <option>opolska</option>
                                <option>ordynariat polowy</option>
                                <option>pelplińska</option>
                                <option>płocka</option>
                                <option>poznańska</option>
                                <option>przemyska</option>
                                <option>radomska</option>
                                <option>rzeszowska</option>
                                <option>sandomierska</option>
                                <option>siedlecka</option>
                                <option>sosnowiecka</option>
                                <option>szczecińsko-kamieńska</option>
                                <option>świdnicka</option>
                                <option>tarnowska</option>
                                <option>toruńska</option>
                                <option>warmińska</option>
                                <option>warszawska</option>
                                <option>warszawsko-praska</option>
                                <option>włocławska</option>
                                <option>wrocławska</option>
                                <option>zamojsko-lubaczowska</option>
                                <option>zielonogórsko-gorzowska</option>
                            </select>
                            <?php
                            if (isset($_SESSION['e_diocese']))
                            {
                                echo '<div class="error">'.$_SESSION['e_diocese'].'</div>';
                                unset($_SESSION['e_diocese']);
                            }
                        ?>
                        </div>
                          <br>
                        <div class="input-group">
                            <label for="email">Email <span style="font-size: 14px; color: #040842; margin-left: 6px;">(email w domenie dzielo.pl)</span></label>
                            <input type="email" id="email" name="email">
                            <?php
                            if (isset($_SESSION['e_email']))
                            {
                                echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                                unset($_SESSION['e_email']);
                            }
                          ?>

                        </div>
                        <div class="input-group">
                            <label for="password">Hasło  <span style="font-size: 14px; color: #040842; margin-left: 6px;">(min. 8 znaków)</span></label>
                            <input type="password" id="password" name="password">
                            <?php
                            if (isset($_SESSION['e_password1']))
                            {
                                echo '<div class="error">'.$_SESSION['e_password1'].'</div>';
                                unset($_SESSION['e_password1']);
                            }
                              ?>

                        </div>
                        <div class="input-group">
                            <label for="password2">Powtórz hasło </label>
                            <input type="password" id="password2" name="password2">
                            <?php
                            if (isset($_SESSION['e_password2']))
                            {
                                echo '<div class="error">'.$_SESSION['e_password2'].'</div>';
                                unset($_SESSION['e_password2']);
                            }
                              ?>
                        </div>

                        <!-- <div class="g-recaptcha" data-sitekey="6LdSx4UqAAAAALdxrCkfmNwVbg-xhYd8e35w8SAl"></div> -->


                       </div>
                     <br>  
                        <button type="submit" class="btn" id="send-button" name="send">Zarejestruj się</button>
                </form>
                    
            </div>
        </div>
    </main>

        <?php include "includes/footer.php" ?>
       <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>