-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 mrt 2022 om 11:14
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fietsenwinkel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fietsen`
--

CREATE TABLE `fietsen` (
  `Id` smallint(6) NOT NULL,
  `Merk` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Prijs` decimal(6,2) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `fietsen`
--

INSERT INTO `fietsen` (`Id`, `Merk`, `Type`, `Prijs`, `info`) VALUES
(2, 'Gazelle ', 'Eclipse', '2000.00', ' '),
(3, 'Gazelle', 'Giro ', '875.50', ''),
(4, 'Giant ', 'Competition', '999.00', ''),
(5, 'Giant', 'Expedition AT', '1300.95', ''),
(6, 'Gazelle', 'Chamonix ', '1049.00', ''),
(7, 'Giant  ', ' City', '449.99', ''),
(8, 'Batavus ', 'Flying Doctor', '67.00', 'Deze fiets is het beste van 2022'),
(9, 'trek', 'Revenue', '56.00', 'Trek Bicycle Corporation is de grootste fietsenproducent van de Verenigde Staten. Het hoofdkantoor is gevestigd in Waterloo waar Trek in 1976 is gestart. In Nederland is het kantoor voor de Benelux gevestigd in Harderwijk en het Europees distributiecentrum in Wijchen'),
(10, 'trek', 'Revenue', '56.00', 'Trek Bicycle Corporation is de grootste fietsenproducent van de Verenigde Staten. Het hoofdkantoor is gevestigd in Waterloo waar Trek in 1976 is gestart. In Nederland is het kantoor voor de Benelux gevestigd in Harderwijk en het Europees distributiecentrum in Wijchen.');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `fietsen`
--
ALTER TABLE `fietsen`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `fietsen`
--
ALTER TABLE `fietsen`
  MODIFY `Id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
