-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 apr 2017 om 10:40
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ma-twente`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afgehandelde_incidenten`
--

CREATE TABLE `afgehandelde_incidenten` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `afhandeltijd` float NOT NULL,
  `verantwoordelijke` varchar(255) NOT NULL,
  `oorzaak` varchar(255) NOT NULL,
  `oplossing` varchar(255) NOT NULL,
  `terugkoppeling` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `configuratie`
--

CREATE TABLE `configuratie` (
  `pc_nummer` int(11) NOT NULL,
  `gebruiker` varchar(255) NOT NULL,
  `aanschaf_datum` date NOT NULL,
  `computer_soort` int(11) NOT NULL,
  `cpu` int(11) NOT NULL,
  `memory` int(11) NOT NULL,
  `hdd` int(11) NOT NULL,
  `os` int(11) NOT NULL,
  `video_kaart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `geslacht` int(11) NOT NULL,
  `voorletter` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `gebruikersnaam` varchar(255) NOT NULL,
  `afdeling` varchar(255) NOT NULL,
  `intern_telefoon_nummer` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `geslacht`, `voorletter`, `achternaam`, `gebruikersnaam`, `afdeling`, `intern_telefoon_nummer`, `wachtwoord`, `privilege`) VALUES
(1, 2, 'v', 'campbell', 'v.campbell', 'cad', '254', '858e7104f2c493098c562ef79e0c1fce954b8453', 2),
(2, 2, 's', 'geerman', 's.geerman', 'cad', '253', 'bb8aae9d39af4bf8f7332492912fe1293efd3040', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `open_incidenten`
--

CREATE TABLE `open_incidenten` (
  `id` int(11) NOT NULL,
  `join_date` date NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `gebruiker` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `betrekking_aantal_gebruikers` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `afgehandelde_incidenten`
--
ALTER TABLE `afgehandelde_incidenten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `configuratie`
--
ALTER TABLE `configuratie`
  ADD PRIMARY KEY (`pc_nummer`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `open_incidenten`
--
ALTER TABLE `open_incidenten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `afgehandelde_incidenten`
--
ALTER TABLE `afgehandelde_incidenten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `configuratie`
--
ALTER TABLE `configuratie`
  MODIFY `pc_nummer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `open_incidenten`
--
ALTER TABLE `open_incidenten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
