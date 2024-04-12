-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 apr 2024 om 19:08
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evke_books`
--
CREATE DATABASE IF NOT EXISTS `evke_books` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `evke_books`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `account`
--

CREATE TABLE `account` (
  `idAccount` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `surname` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_idrole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `account`
--

INSERT INTO `account` (`idAccount`, `name`, `surname`, `email`, `password`, `role_idrole`) VALUES
(2, 'Jane', 'Smith', 'jane@example.com', 'password', 2),
(3, 'Admin', 'Admin', 'admin@example.com', 'adminpassword', 3),
(5, 'Peren', 'SAPP', 'peren.sapp@tcrmbo.nl', '$2y$11$bn1BGCr5/pAHC5J2cveRgO.3j800krpppg1Ypag9oqa4CK3wseT7.', 2),
(7, 'test1', 'test1', 'test1@tcrmbo.nl', '$2y$11$WsqIrVZ5C/njOHKMuVdc6O5ftIgIbZLZc2fyUILe0hgOC4FdMaZoG', 2),
(8, 'Peren ', 'Sapp', 'peren.sapp@student.zadkine.nl', '$2y$11$egGajFu.EjmwkHule829XuxyJl3L9xMwD9R9wCRIBDIbu/wODQxeW', 2),
(9, 'kevin', 'troost', 'kevin@student.zadkine.nl', '$2y$11$jAlPH8cwxpZM/3WmdPH.g.FqXBhpK/VzGwRNTdCmHeEBf6dZEGuwW', 2),
(10, 'E', 'Cheung', 'cheung@student.zadkine.nl', '$2y$11$9pg5518.LS46jvXCArXSu.nJ5uZJFn6CLFd2Lk3EC5VngJt2rnwPW', 2),
(11, 'Yi', 'Fan', 'Yifan.e.c@tcrmbo.nl', '$2y$11$xVmccpyw.FFKWjD.x0RCuO2IQSx5ZYT4f5GRmEv9cm2JuaGvmzf.q', 3),
(13, 'Vasco', 'V.Gils', 'vas123@student.zadkine.nl', '$2y$11$4kHD.djxUQWRihQEOS36HeebnYUG.e4dvk4L/QSl5AhyG1WKzyete', 2),
(14, 'test150', 'test150', 'test150@student.zadkine.nl', '$2y$11$TEvGk4A.asRJWqIctd/oYeJGi5Qu4rAVmxd50MwhUNW11vJ9pQIIy', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `books`
--

CREATE TABLE `books` (
  `idbooks` int(11) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `nameAuthor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `books`
--

INSERT INTO `books` (`idbooks`, `bookName`, `ISBN`, `stock`, `nameAuthor`) VALUES
(2, 'The Slide Edge ', '37518', 56, 'Jeff Olson'),
(3, 'T.v.d.m', '12533246', 123127, 'N.v.d.m'),
(4, 'The Slide Edge ', '192048', 1231234, 'Jeff Olson'),
(5, 'The Slide Edge ', '192048', 123, 'Jeff Olson'),
(7, 'testboek', '213153', 0, 'Bigtes');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveer`
--

CREATE TABLE `reserveer` (
  `id` int(11) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `name` varchar(80) NOT NULL,
  `surname` varchar(80) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `role`
--

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `role`
--

INSERT INTO `role` (`idrole`, `name`) VALUES
(1, 'docent'),
(2, 'student'),
(3, 'admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`idAccount`),
  ADD KEY `fk_account_role1_idx` (`role_idrole`);

--
-- Indexen voor tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`idbooks`);

--
-- Indexen voor tabel `reserveer`
--
ALTER TABLE `reserveer`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `account`
--
ALTER TABLE `account`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `books`
--
ALTER TABLE `books`
  MODIFY `idbooks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `reserveer`
--
ALTER TABLE `reserveer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT voor een tabel `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_role1` FOREIGN KEY (`role_idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
