-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 17, 2025 at 11:23 PM
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
-- Database: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `id` int(11) NOT NULL,
  `panstwo` text NOT NULL,
  `miasto` text NOT NULL,
  `ulica` text NOT NULL,
  `numer_domu` text NOT NULL,
  `numer_mieszkania` text NOT NULL,
  `kod_pocztowy` varchar(6) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adres`
--

INSERT INTO `adres` (`id`, `panstwo`, `miasto`, `ulica`, `numer_domu`, `numer_mieszkania`, `kod_pocztowy`, `uzytkownik_id`) VALUES
(1, 'Polska', 'Warszawa', 'Jaśminowa', '68', '23', '05-247', 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `nazwa`) VALUES
(1, 'Narzędzia ogrodowe'),
(2, 'Rośliny'),
(3, 'Nasiona'),
(4, 'Doniczki i akcesoria'),
(5, 'Nawozy i środki ochrony'),
(6, 'Mała architektura ogrodowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `temat` varchar(255) NOT NULL,
  `wiadomosc` varchar(255) DEFAULT NULL,
  `data_czas_utworzenia` datetime NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `orderview`
-- (See below for the actual view)
--
CREATE TABLE `orderview` (
`zamowienie_id` int(11)
,`data_czas_zamowienia` datetime
,`data_czas_realizacji` datetime
,`status` enum('przyjęte','spakowane','dostarczone')
,`suma` decimal(10,2)
,`platnosc` enum('blik','przelew','gotówka')
,`uwagi` text
,`uzytkownik_id` int(11)
,`adres_id` int(11)
,`kurier_id` int(11)
,`uzytkownik_imie` text
,`uzytkownik_nazwisko` text
,`email` text
,`miasto` text
,`ulica` text
,`numer_domu` text
,`numer_mieszkania` text
,`kod_pocztowy` varchar(6)
,`kurier_imie` text
,`kurier_nazwisko` text
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `email` text NOT NULL,
  `telefon` text NOT NULL,
  `rola` enum('admin','kurier','pracownik_magazynu') NOT NULL,
  `data_zatrudnienia` date NOT NULL,
  `login` text NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `placa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pracownik`
--

INSERT INTO `pracownik` (`id`, `imie`, `nazwisko`, `email`, `telefon`, `rola`, `data_zatrudnienia`, `login`, `haslo`, `placa`) VALUES
(2, 'Andrzej', 'Nowak', 'a.nowak@gmail.com', '123456789', 'admin', '2022-04-05', 'anowak', '$2y$10$qo/81GzCvtSkIr0Iu..Gqeg7UxaZ.ZGCcZN6ElgO6DhTWtEHjHD3W', 8000.00),
(4, 'Maks', 'Wafel', 'makswafel@gmail.com', '', 'kurier', '0000-00-00', 'makswafel', '$2y$10$KmMk/nlY2z4Ez3V2sE5AP./PfU9tt5BoOIVJc1FZNHzuU.hvIXu1.', 10000.00),
(5, 'Adam', 'Kok', 'Adam.kok@gmail.com', '9439084312', 'kurier', '2025-04-01', 'adamkok', '', 6500.00),
(6, 'Jan', 'Postman', 'jan.postman@gmail.com', '83275089', 'kurier', '2025-02-04', 'janpost', '', 6500.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt`
--

CREATE TABLE `produkt` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `opis` text NOT NULL,
  `url_zdjecia` text DEFAULT NULL,
  `kategoria_id` int(11) DEFAULT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkt`
--

INSERT INTO `produkt` (`id`, `nazwa`, `cena`, `opis`, `url_zdjecia`, `kategoria_id`, `ilosc`) VALUES
(1, 'Szpadel ogrodowy', 89.99, 'Solidny szpadel do kopania i sadzenia', 'szpadel.jpg', 1, 15),
(2, 'Grabie metalowe', 45.50, 'Grabie do liści i trawy', 'grabie.jpg', 1, 20),
(3, 'Sekator ręczny', 59.90, 'Sekator do cięcia gałęzi', 'sekator.jpg', 1, 30),
(4, 'Róża czerwona (sadzonka)', 25.00, 'Sadzonka róży czerwonej', 'roza.jpg', 2, 50),
(5, 'Tuja szmaragd (sadzonka)', 18.00, 'Tuje do ogrodzenia żywopłotowego', 'tuja.jpg', 2, 40),
(6, 'Lawenda (sadzonka)', 12.50, 'Aromatyczna bylina do ogrodu', 'lawenda.jpg', 2, 60),
(7, 'Nasiona marchewki', 4.99, 'Odmiana wczesna', 'marchewka.jpg', 3, 100),
(8, 'Nasiona trawy uniwersalnej', 15.90, 'Mieszanka do ogrodów i działek', 'trawa.jpg', 3, 80),
(9, 'Nasiona pomidora malinowego', 6.50, 'Pomidor o dużych owocach', 'pomidory.jpg', 3, 90),
(10, 'Doniczka plastikowa 20cm', 7.99, 'Doniczka uniwersalna', 'doniczka.jpg', 4, 100),
(11, 'Osłonka ceramiczna', 29.90, 'Dekoracyjna osłonka', 'oslonka.jpg', 4, 40),
(12, 'Zraszacz ogrodowy', 35.00, 'Do podlewania trawnika', 'zraszacz.jpg', 4, 25),
(13, 'Nawóz uniwersalny 5kg', 39.90, 'Do roślin ozdobnych i warzyw', 'nawoz.jpg', 5, 50),
(14, 'Opryskiwacz ręczny 2L', 22.00, 'Do środków ochrony roślin', 'opryskiwacz.jpg', 5, 35),
(15, 'Preparat przeciw mszycom', 19.50, 'Gotowy do użycia', 'mszyce.jpg', 5, 40),
(16, 'Altanka ogrodowa (zestaw)', 1299.00, 'Drewniana altanka do ogrodu', 'altanka.jpg', 6, 5),
(17, 'Ławka drewniana', 599.00, 'Ławka do ogrodu lub na taras', 'lawka.jpg', 6, 8),
(18, 'Pergola metalowa', 349.00, 'Stelaż do pnączy', 'pergola.jpg', 6, 10),
(19, 'Konewka metalowa', 32.90, 'Tradycyjna konewka', 'konewka.jpg', 1, 30),
(20, 'Ziemia uniwersalna 20L', 14.90, 'Do większości roślin ogrodowych', 'ziemia.jpg', 5, 70);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szczegoly_zamowienia`
--

CREATE TABLE `szczegoly_zamowienia` (
  `id` int(11) NOT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `zamowienie_id` int(11) DEFAULT NULL,
  `ilosc_produktu` int(11) NOT NULL,
  `suma` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `szczegoly_zamowienia`
--

INSERT INTO `szczegoly_zamowienia` (`id`, `produkt_id`, `zamowienie_id`, `ilosc_produktu`, `suma`) VALUES
(11, 4, 7, 1, 25.00),
(12, 4, 8, 1, 25.00),
(13, 2, 9, 1, 45.50),
(14, 3, 9, 3, 179.70),
(15, 4, 9, 1, 25.00),
(16, 5, 10, 3, 54.00),
(17, 11, 11, 1, 29.90),
(18, 4, 12, 1, 25.00),
(19, 2, 13, 1, 45.50),
(20, 5, 13, 1, 18.00),
(21, 7, 13, 2, 9.98),
(22, 10, 13, 1, 7.99),
(23, 3, 14, 1, 59.90),
(24, 5, 15, 1, 18.00),
(25, 5, 16, 1, 18.00),
(28, 4, 18, 1, 25.00),
(29, 5, 19, 1, 18.00),
(30, 2, 22, 1, 45.50),
(31, 10, 22, 1, 7.99),
(32, 5, 24, 1, 18.00),
(33, 7, 25, 1, 4.99),
(34, 9, 26, 1, 6.50),
(35, 5, 27, 1, 18.00),
(36, 1, 28, 1, 89.99),
(37, 2, 28, 2, 91.00),
(38, 3, 28, 1, 59.90),
(39, 4, 28, 2, 50.00),
(40, 9, 28, 1, 6.50),
(41, 15, 28, 1, 19.50),
(42, 9, 29, 8, 52.00),
(43, 19, 29, 1, 32.90);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `email` text NOT NULL,
  `login` text NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `imie`, `nazwisko`, `email`, `login`, `haslo`) VALUES
(4, 'arek', 'bomba', 'arek.bomba@gmail.com', 'arekbomba', '$2y$10$eYkDGuSWQ/zoLKX3KA0FHOwCRnlik1jznFNtevD.lN/NxJ/Cv/YjO'),
(5, 'Jan', 'Bolonka', 'jan.b@gmail.com', 'janb', '$2y$10$X5tKAiVEF0yHHKFH4YxeKuhzANEqeJI0BdvfQ5RTJyARfe.6lDtqi'),
(7, 'Jan', 'Skor', 'jans@gmail.com', '', ''),
(8, 'Jan', 'Olcha', 'Jan@gmail.com', '', ''),
(9, 'Marian', 'Dzwonek', 'marian.dzwonek@gmail.com', 'mdzwonek', '$2y$10$oUEyUR3/PcwK8u8Yz1ECe.xQdW.kzIhnodGVHUNX566c2uK.Y6FQm');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL,
  `adres_id` int(11) DEFAULT NULL,
  `platnosc` enum('blik','przelew','gotówka') NOT NULL,
  `status` enum('przyjęte','spakowane','dostarczone') NOT NULL,
  `kurier_id` int(11) DEFAULT NULL,
  `data_czas_zamowienia` datetime NOT NULL,
  `data_czas_realizacji` datetime DEFAULT NULL,
  `suma` decimal(10,2) NOT NULL,
  `uwagi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienie`
--

INSERT INTO `zamowienie` (`id`, `uzytkownik_id`, `adres_id`, `platnosc`, `status`, `kurier_id`, `data_czas_zamowienia`, `data_czas_realizacji`, `suma`, `uwagi`) VALUES
(7, 4, 11, 'gotówka', 'przyjęte', 4, '2025-06-09 16:53:00', '0000-00-00 00:00:00', 25.00, 'Brak uwag'),
(8, 4, 4, '', 'dostarczone', 4, '2025-06-09 16:55:00', '2025-06-10 19:26:00', 25.00, 'Brak uwag'),
(9, 4, 1, 'gotówka', 'przyjęte', 4, '2025-06-09 17:06:13', NULL, 250.20, 'Brak uwag'),
(10, 4, 12, 'gotówka', 'przyjęte', 4, '2025-06-09 19:18:22', NULL, 54.00, 'Brak uwag'),
(11, 4, 4, '', 'przyjęte', 6, '2025-06-15 16:42:00', '0000-00-00 00:00:00', 29.90, 'Brak uwag'),
(12, 4, 1, 'gotówka', 'przyjęte', 4, '2025-06-15 16:58:45', NULL, 25.00, 'Brak uwag'),
(13, 4, 1, 'gotówka', 'przyjęte', 4, '2025-06-15 17:35:31', NULL, 81.47, 'Brak uwag'),
(14, 4, 4, 'gotówka', 'przyjęte', 4, '2025-06-15 17:41:33', NULL, 59.90, 'Brak uwag'),
(15, 4, 4, 'gotówka', 'przyjęte', 4, '2025-06-15 17:48:01', NULL, 18.00, 'Brak uwag'),
(16, 4, 4, 'gotówka', 'przyjęte', NULL, '2025-06-15 17:56:07', NULL, 18.00, 'Brak uwag'),
(18, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:27:29', NULL, 25.00, ''),
(19, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:29:21', NULL, 18.00, ''),
(20, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:32:57', NULL, 0.00, ''),
(21, 5, 11, 'gotówka', 'przyjęte', 6, '2025-06-15 18:33:04', NULL, 0.00, ''),
(22, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:33:39', NULL, 53.49, ''),
(23, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:34:07', NULL, 0.00, ''),
(24, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:34:36', NULL, 18.00, ''),
(25, 7, 12, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:37:07', NULL, 4.99, ''),
(26, 5, 11, 'gotówka', 'przyjęte', NULL, '2025-06-15 18:58:49', NULL, 6.50, ''),
(27, 8, 13, 'gotówka', 'przyjęte', NULL, '2025-06-15 19:00:19', NULL, 18.00, ''),
(28, 9, 1, 'gotówka', 'przyjęte', NULL, '2025-06-17 19:53:05', NULL, 316.89, ''),
(29, 9, 1, 'gotówka', 'przyjęte', NULL, '2025-06-17 20:16:25', NULL, 84.90, '');

-- --------------------------------------------------------

--
-- Struktura widoku `orderview`
--
DROP TABLE IF EXISTS `orderview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orderview`  AS SELECT `z`.`id` AS `zamowienie_id`, `z`.`data_czas_zamowienia` AS `data_czas_zamowienia`, `z`.`data_czas_realizacji` AS `data_czas_realizacji`, `z`.`status` AS `status`, `z`.`suma` AS `suma`, `z`.`platnosc` AS `platnosc`, `z`.`uwagi` AS `uwagi`, `z`.`uzytkownik_id` AS `uzytkownik_id`, `z`.`adres_id` AS `adres_id`, `z`.`kurier_id` AS `kurier_id`, `u`.`imie` AS `uzytkownik_imie`, `u`.`nazwisko` AS `uzytkownik_nazwisko`, `u`.`email` AS `email`, `a`.`miasto` AS `miasto`, `a`.`ulica` AS `ulica`, `a`.`numer_domu` AS `numer_domu`, `a`.`numer_mieszkania` AS `numer_mieszkania`, `a`.`kod_pocztowy` AS `kod_pocztowy`, `p`.`imie` AS `kurier_imie`, `p`.`nazwisko` AS `kurier_nazwisko` FROM (((`zamowienie` `z` left join `uzytkownik` `u` on(`z`.`uzytkownik_id` = `u`.`id`)) left join `adres` `a` on(`z`.`adres_id` = `a`.`id`)) left join `pracownik` `p` on(`z`.`kurier_id` = `p`.`id`)) ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uzytkownik` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rola` (`rola`);

--
-- Indeksy dla tabeli `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produkt_kategoria` (`kategoria_id`);

--
-- Indeksy dla tabeli `szczegoly_zamowienia`
--
ALTER TABLE `szczegoly_zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_szczegoly_zamowienia_zamowienie` (`zamowienie_id`),
  ADD KEY `fk_szczegoly_zamowienia_produkt` (`produkt_id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zamowienie_uzytkownik` (`uzytkownik_id`),
  ADD KEY `fk_zamowienie_admin` (`kurier_id`),
  ADD KEY `fk_zamowienie_adres` (`adres_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres`
--
ALTER TABLE `adres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `szczegoly_zamowienia`
--
ALTER TABLE `szczegoly_zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adres`
--
ALTER TABLE `adres`
  ADD CONSTRAINT `fk_adres_uzytkownik` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `produkt`
--
ALTER TABLE `produkt`
  ADD CONSTRAINT `fk_produkt_kategoria` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `szczegoly_zamowienia`
--
ALTER TABLE `szczegoly_zamowienia`
  ADD CONSTRAINT `fk_szczegoly_zamowienia_produkt` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_szczegoly_zamowienia_zamowienie` FOREIGN KEY (`zamowienie_id`) REFERENCES `zamowienie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `fk_zamowienie_admin` FOREIGN KEY (`kurier_id`) REFERENCES `pracownik` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_zamowienie_adres` FOREIGN KEY (`adres_id`) REFERENCES `adres` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_zamowienie_uzytkownik` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
