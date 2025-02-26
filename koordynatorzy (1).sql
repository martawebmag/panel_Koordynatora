-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 12:13 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koordynatorzy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `2025_uczniowie`
--

CREATE TABLE `2025_uczniowie` (
  `Id` int(11) NOT NULL,
  `typ_uczestnika` text NOT NULL,
  `imie` mediumtext DEFAULT NULL,
  `nazwisko` mediumtext DEFAULT NULL,
  `pesel` mediumtext DEFAULT NULL,
  `data_urodzenia` mediumtext DEFAULT NULL,
  `email` mediumtext DEFAULT NULL,
  `email_prywatny` mediumtext DEFAULT NULL,
  `numer_telefonu` mediumtext DEFAULT NULL,
  `plec` mediumtext DEFAULT NULL,
  `wspolnota` mediumtext DEFAULT NULL,
  `ulica` mediumtext DEFAULT NULL,
  `numer_domu` mediumtext DEFAULT NULL,
  `numer_mieszkania` mediumtext DEFAULT NULL,
  `kod_pocztowy` mediumtext DEFAULT NULL,
  `poczta` mediumtext DEFAULT NULL,
  `miejscowosc` mediumtext DEFAULT NULL,
  `imie_kontaktu` mediumtext DEFAULT NULL,
  `nazwisko_kontaktu` mediumtext DEFAULT NULL,
  `telefon_kontaktowy` mediumtext DEFAULT NULL,
  `zdrowie` mediumtext DEFAULT NULL,
  `dieta` mediumtext DEFAULT NULL,
  `jaka_dieta` text NOT NULL,
  `dieta_szczegoly` mediumtext DEFAULT NULL,
  `obrona` mediumtext DEFAULT NULL,
  `sesja` mediumtext DEFAULT NULL,
  `koniec_sesji` mediumtext DEFAULT NULL,
  `koszulka_rozmiar` mediumtext DEFAULT NULL,
  `chor` mediumtext DEFAULT NULL,
  `instrument` mediumtext DEFAULT NULL,
  `posluga` mediumtext DEFAULT NULL,
  `medycyna` mediumtext DEFAULT NULL,
  `uwagi` mediumtext DEFAULT NULL,
  `zgoda_regulamin` mediumtext DEFAULT NULL,
  `zgoda_szpital` mediumtext DEFAULT NULL,
  `zgoda_elektronika` mediumtext DEFAULT NULL,
  `zgoda_rodo` mediumtext DEFAULT NULL,
  `zgoda_wizerunek` mediumtext DEFAULT NULL,
  `data_zgloszenia` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_general_ci;

--
-- Dumping data for table `2025_uczniowie`
--

INSERT INTO `2025_uczniowie` (`Id`, `typ_uczestnika`, `imie`, `nazwisko`, `pesel`, `data_urodzenia`, `email`, `email_prywatny`, `numer_telefonu`, `plec`, `wspolnota`, `ulica`, `numer_domu`, `numer_mieszkania`, `kod_pocztowy`, `poczta`, `miejscowosc`, `imie_kontaktu`, `nazwisko_kontaktu`, `telefon_kontaktowy`, `zdrowie`, `dieta`, `jaka_dieta`, `dieta_szczegoly`, `obrona`, `sesja`, `koniec_sesji`, `koszulka_rozmiar`, `chor`, `instrument`, `posluga`, `medycyna`, `uwagi`, `zgoda_regulamin`, `zgoda_szpital`, `zgoda_elektronika`, `zgoda_rodo`, `zgoda_wizerunek`, `data_zgloszenia`) VALUES
(1, 'uczen', 'Damian', 'Spencer2', '86041619773', '2001-12-15', 'marta.galecka@dzielo.pl', 'cacko@gmail.com', '784379592', 'mężczyzna', 'Olsztyn', 'Kwatery Głównej', '3', '', '04-294', 'Węgrów', 'Warszawa', 'Witold', 'Wójcik', '784379592', '', 'NIE', '', '', '', 'TAK', '', 'L', 'TAK', 'wiolonczela', 'TAK', 'NIE', '', 'tak', 'tak', 'tak', 'tak', 'tak', '2024-12-12 16:48:53'),
(2, 'uczen', 'Marta', 'Gałecka', NULL, NULL, 'marta.galecka@dzielo.pl', NULL, '784378592', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-26 12:08:20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `user_id` int(11) NOT NULL,
  `token` int(11) NOT NULL,
  `expiry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `diocese` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `activation_token` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `diocese`, `email`, `password`, `activation_token`, `created_at`) VALUES
(1, 'Marta', 'Gałecka', 'warszawska', 'marta.galecka@dzielo.pl', '$2y$10$GiLPXWM/xODVcUmshUaFP.Jnc6iQ3BY4xlH0MbyY9PkRaWFlYV2jq', '', '2025-02-26 11:39:43');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `widok_uczniowie`
-- (See below for the actual view)
--
CREATE TABLE `widok_uczniowie` (
`typ_uczestnika` text
,`imie` mediumtext
,`nazwisko` mediumtext
,`email` mediumtext
,`numer_telefonu` mediumtext
);

-- --------------------------------------------------------

--
-- Struktura widoku `widok_uczniowie`
--
DROP TABLE IF EXISTS `widok_uczniowie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `widok_uczniowie`  AS SELECT `2025_uczniowie`.`typ_uczestnika` AS `typ_uczestnika`, `2025_uczniowie`.`imie` AS `imie`, `2025_uczniowie`.`nazwisko` AS `nazwisko`, `2025_uczniowie`.`email` AS `email`, `2025_uczniowie`.`numer_telefonu` AS `numer_telefonu` FROM `2025_uczniowie` ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `2025_uczniowie`
--
ALTER TABLE `2025_uczniowie`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `2025_uczniowie`
--
ALTER TABLE `2025_uczniowie`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
