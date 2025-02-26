<?php

// Połączenie z bazą MySQL za pomocą PDO

$username = 'root';
$dsn = 'mysql:host=localhost;dbname=koordynatorzy;charset=utf8';
$password = '';

// $username = '03333200_obozy_2025';
// $dsn = 'mysql:host=mysql8;dbname=03333200_obozy_2025;charset=utf8';
// $password = 'hEVWmt_e';


try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->exec("SET NAMES 'utf8'");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
