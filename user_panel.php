<?php
session_start();

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika</title>
    <link rel="shortcut icon" type="image/icon" href="images/favicon.ico" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tektur:wght@400..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/789005376d.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php" ?>
    
    <div class="container">
        <div class="panel_container">
            <div class="user_header">
                <h3>Witaj <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h3>
                <p>Twój email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                <a href="logout.php"> >>> Wyloguj się</a>
            </div>
                <br>

            <div class="user_text">
                <h3>Raporty - zapisy na obozy wakacyjne </h3> 
                <ol>
                    <li> Stypendyści - uczniowie - zapisani na obóz letni 2024r</li> 
                    <a href="raport_excel.php">
                    <button class="btn3">Pobierz raport (Excel)</button>
                    </a>
                    <li> Stypendyści - studenci - zapisani na obóz letni 2024r</li>  <a href="raport_excel.php"><button class="btn3">Pobierz raport (Excel)</button></a> 
                    <li>Wolontariusze</li>  <a href="#">Pobierz raport</a> 
                    <li>Usprawiedliwienia</li>  <a href="#">Pobierz raport</a> 
                </ol>
                    
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>
</body>
</html>