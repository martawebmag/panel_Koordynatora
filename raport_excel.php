<?php

session_start();

// Sprawdzamy, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Jeśli użytkownik nie jest zalogowany, przekierowujemy go na stronę logowania
    exit();
}

require 'db_connect.php';
require 'vendor/autoload.php'; // Załaduj autoloader Composer, jeśli używasz Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Zapytanie do bazy danych (przykład)
$query = "SELECT typ_uczestnika, imie, nazwisko, email, numer_telefonu FROM widok_uczniowie";
$stmt = $pdo->query($query);

// Sprawdzamy, czy zapytanie zwróciło dane
if ($stmt->rowCount() > 0) {
    // Tworzymy nowy obiekt Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Nagłówki kolumn
    $sheet->setCellValue('A1', 'Typ uczestnika');
    $sheet->setCellValue('B1', 'Imię');
    $sheet->setCellValue('C1', 'Nazwisko');
    $sheet->setCellValue('D1', 'Email');
    $sheet->setCellValue('E1', 'Telefon');
    
    // Wypełnianie tabeli danymi
    $rowNum = 2; // zaczynamy od drugiego wiersza, bo pierwszy to nagłówki
    while ($row = $stmt->fetch()) {
        $sheet->setCellValue('A' . $rowNum, $row['typ_uczestnika']);
        $sheet->setCellValue('B' . $rowNum, $row['imie']);
        $sheet->setCellValue('C' . $rowNum, $row['nazwisko']);
        $sheet->setCellValue('D' . $rowNum, $row['email']);
        $sheet->setCellValue('E' . $rowNum, $row['numer_telefonu']);
        $rowNum++;
    }
    
    // Tworzymy plik Excel (XLSX)
    $writer = new Xlsx($spreadsheet);
    
    // Wysyłamy plik do pobrania
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="raport_uzytkownicy.xlsx"');
    
    $writer->save('php://output'); // Zapisujemy plik do wyjścia (będzie pobrany przez użytkownika)
    exit();
} else {
    echo "Brak danych do pobrania.";
}
?>
