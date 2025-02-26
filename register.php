<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'includes/functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność inputów
		$name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $diocese = trim($_POST['diocese']);
		
		//Sprawdzenie pól
		if ((empty($name)))
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Pole jest wymagane!";
		}
		if (empty($surname))
		{
			$wszystko_OK=false;
			$_SESSION['e_surname']="Pole jest wymagane!";
		}
		if ((empty($diocese)))
		{
			$wszystko_OK=false;
			$_SESSION['e_diocese']="Pole jest wymagane!";
		}


		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$password1 = trim($_POST['password']);
		$password2 = trim($_POST['password2']);
		
		if ((strlen($password1)<8) || (strlen($password1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_password1']="Hasło musi mieć minimum 8 znaków!";
		}
		
		if ($password1!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['e_password2']="Podane hasła nie są identyczne!";
		}	

		$password_hash = password_hash($password1, PASSWORD_DEFAULT);

		$activation_token = bin2hex(random_bytes(32));

		//Bot or not? Oto jest pytanie!
		$sekret = "6LdSx4UqAAAAALTFkV5aQWMGklntwBtKjgcakbd0";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";

		}

		require_once 'db_connect.php';

	
		//Czy email już istnieje?
		$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		
		if ($stmt->fetchColumn() > 0) {
			$wszystko_OK = false;
			$_SESSION['e_email'] = "Podany adres email jest już zajęty.";
		}
		
		if($wszystko_OK == true) {

			try {
	
				$stmt = $pdo->prepare("INSERT INTO users (name, surname, diocese, email, password, activation_token, created_at) VALUES (:name, :surname, :diocese, :email, :password, :activation_token, NOW())");
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':surname', $surname);
				$stmt->bindParam(':diocese', $diocese);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':password', $password_hash);
				$stmt->bindParam(':activation_token', $activation_token);
				$stmt->execute();
			
				$_SESSION['udanarejestracja'] = true;


				$mail = new PHPMailer(true);
				$email = $_POST['email'];
					
				// Konfiguracja SMTP
				$mail->isSMTP();                                      // Użyj SMTP
				$mail->Host = 'dzielopl.home.pl';                     // Podaj adres serwera SMTP
				$mail->SMTPAuth = true;                               // Włącz uwierzytelnianie SMTP
				$mail->Username = 'marta.galecka@dzielo.pl';           // Twój e-mail SMTP
				$mail->Password = 'H_kVDyNY';                      // Hasło SMTP
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Włącz szyfrowanie TLS
				$mail->Port = 587;      
				$mail->CharSet = 'UTF-8';    

				// Dane nadawcy i odbiorcy
				$mail->setFrom('marta.galecka@dzielo.pl', 'Marta Gałecka');
				$mail->addAddress($email); // Adres odbiorcy

				// Treść maila
				$activation_link = "https://obozy.dzielo.pl/test-Marta/panel2/activate_user.php?activation_token=" . $activation_token;
				$mail->isHTML(true);
				$mail->Subject = 'Aktywacja konta';
				$mail->Body = "
					<html>
					<head>
					<title>Aktywacja konta</title>
					</head>
					<body>
					<p>Szczęść Boże,</p>
					<p>Dziękujemy za rejestrację! Kliknij poniższy link, aby aktywować swoje konto:</p>
					<p><a href='$activation_link'>$activation_link</a></p>
					<br>
					<p>Fundacja Dzieło Nowego Tysiąclecia</p>
					</body>
					</html>
				";

				// Wyślij mail
				$mail->send();
				header('Location: index_success.php');
			} catch (Exception $e) {
				echo "Błąd wysyłki maila: {$mail->ErrorInfo}";
			}


									
				header('Location: index_success.php');
				exit();
		
		} else {
			header('Location: rejestracja.php');
            exit();
		}
	}







