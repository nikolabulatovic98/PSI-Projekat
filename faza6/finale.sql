-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 12, 2020 at 03:25 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `putovanja`
--
CREATE DATABASE IF NOT EXISTS `putovanja` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `putovanja`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `Username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Password` char(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`Username`, `Password`) VALUES
('danilodrobnjak98', '20071998'),
('nikolab98', '12345'),
('oliverar98', '12345'),
('jankon98', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `destinacija`
--

DROP TABLE IF EXISTS `destinacija`;
CREATE TABLE IF NOT EXISTS `destinacija` (
  `IdDestinacije` int(11) NOT NULL AUTO_INCREMENT,
  `ImeDrzave` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ImeDestinacije` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Tip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IdDestinacije`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `destinacija`
--

INSERT INTO `destinacija` (`IdDestinacije`, `ImeDrzave`, `ImeDestinacije`, `Tip`) VALUES
(1, 'Španija', 'Barselona', 'Gradovi Evrope'),
(2, 'Španija', 'Madrid', 'Gradovi Evrope'),
(6, 'Italija', 'Milano', 'Gradovi Evrope'),
(7, 'Holandija', 'Amsterdam', 'Gradovi Evrope'),
(8, 'Austrija', 'Beč', 'Gradovi Evrope'),
(9, 'Nemačka', 'Berlin', 'Gradovi Evrope'),
(10, 'Francuska', 'Pariz', 'Gradovi Evrope'),
(11, 'Italija', 'Rim', 'Gradovi Evrope'),
(12, 'Brazil', 'Rio de Ženeiro', 'Daleke'),
(13, 'Japan', 'Tokio', 'Daleke'),
(14, 'Tajland', 'Bangkok', 'Daleke'),
(15, 'Tanzanija', 'Zanzibar', 'Daleke'),
(16, 'Kina', 'Hong Kong', 'Daleke'),
(17, 'Australija', 'Melburn', 'Daleke'),
(18, 'Srbija', 'Đavolja varoš', 'Izleti'),
(19, 'Srbija', 'Golubac', 'Izleti'),
(20, 'Srbija', 'Dvorac Fantast', 'Izleti'),
(21, 'Srbija', 'Krupajsko vrelo', 'Izleti'),
(22, 'Srbija', 'Etno selo Tiganjica', 'Izleti'),
(23, 'Srbija', 'Izlezište Grza', 'Izleti'),
(24, 'Srbija', 'Izlet Rtanj', 'Izleti'),
(25, 'Srbija', 'Uvac', 'Izleti'),
(26, 'Srbija', 'Kablar', 'Izleti'),
(27, 'Grčka', 'Krit', 'Letovanje'),
(28, 'Grčka', 'Skijatos', 'Letovanje'),
(29, 'Španija', 'Majorka', 'Letovanje'),
(30, 'Turska', 'Antalija', 'Letovanje'),
(31, 'Grčka', 'Kefalonija', 'Letovanje'),
(32, 'Grčka', 'Rodos', 'Letovanje'),
(33, 'Egipat', 'Šarm el Šeik', 'Letovanje'),
(34, 'Tunis', 'Tunis', 'Letovanje'),
(35, 'Španija', 'Ljoret de Mar', 'Letovanje'),
(36, 'Crna Gora', 'Budva', 'Letovanje'),
(37, 'Bugarska', 'Bansko', 'Zimovanje'),
(38, 'Srbija ', 'Kopaonik', 'Zimovanje'),
(39, 'Italija', 'Alta Badia', 'Zimovanje'),
(40, 'Austrija', 'Zalbah', 'Zimovanje'),
(41, 'Austrija', 'Bad Klajnkirhajm', 'Zimovanje'),
(42, 'Italija', 'Tuij', 'Zimovanje'),
(43, 'Andora', 'Valnord', 'Zimovanje'),
(44, 'Srbija', 'Zlatibor', 'Zimovanje'),
(45, 'Austrija', 'Cel am Ze', 'Zimovanje'),
(46, 'Francuska', 'Kurševel', 'Zimovanje'),
(47, 'Slovenija', 'Vogel', 'Zimovanje'),
(48, 'Bugarska', 'Borovec', 'Zimovanje');

-- --------------------------------------------------------

--
-- Table structure for table `jeputovao`
--

DROP TABLE IF EXISTS `jeputovao`;
CREATE TABLE IF NOT EXISTS `jeputovao` (
  `Ocena` int(11) NOT NULL,
  `Trajanje` int(11) DEFAULT NULL,
  `Saputnik` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `IdDestinacije` int(11) NOT NULL,
  PRIMARY KEY (`Username`,`IdDestinacije`),
  KEY `R_18` (`IdDestinacije`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `IdKom` int(11) NOT NULL AUTO_INCREMENT,
  `Tekst` text COLLATE utf8_unicode_ci,
  `Username` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdKom`),
  KEY `R_21` (`Username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `Username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Pol` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`Username`, `Pol`, `Password`, `Ime`, `Prezime`) VALUES
('danilodrobnjak', 'M', '20071998', 'Danilo', 'Drobnjak'),
('markomarkovic', 'M', '12345', 'Marko', 'Markovic'),
('oliverar', 'Ž', '12345', 'Olivera', 'Radojković'),
('nikolab', 'M', '12345', 'Nikola', 'Bulatović'),
('jankon', 'M', '12345', 'Janko', 'Nikodinovic');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
CREATE TABLE IF NOT EXISTS `moderator` (
  `Username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`Username`) VALUES
('markomarkovic');

-- --------------------------------------------------------

--
-- Table structure for table `putovanje`
--

DROP TABLE IF EXISTS `putovanje`;
CREATE TABLE IF NOT EXISTS `putovanje` (
  `IdPutovanja` int(11) NOT NULL AUTO_INCREMENT,
  `Saputnik` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `Trajanje` int(11) NOT NULL,
  `Opis` text COLLATE utf8_unicode_ci,
  `IdDestinacije` int(11) DEFAULT NULL,
  `DonjiUzrast` int(11) NOT NULL,
  `GornjiUzrast` int(11) NOT NULL,
  PRIMARY KEY (`IdPutovanja`),
  KEY `R_10` (`IdDestinacije`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrovanikorisnik`
--

DROP TABLE IF EXISTS `registrovanikorisnik`;
CREATE TABLE IF NOT EXISTS `registrovanikorisnik` (
  `Username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Godiste` int(11) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registrovanikorisnik`
--

INSERT INTO `registrovanikorisnik` (`Username`, `Email`, `Godiste`) VALUES
('danilodrobnjak', 'drobnjak,danilo@gmail.com', 1998),
('jankon', 'jankon@gmail.com', 1998),
('nikolab', 'nikolab@yahoo.com', 1998),
('oliverar', 'oolivera@hotmail.com', 1998);

-- --------------------------------------------------------

--
-- Table structure for table `seodnosina`
--

DROP TABLE IF EXISTS `seodnosina`;
CREATE TABLE IF NOT EXISTS `seodnosina` (
  `IdKom` int(11) NOT NULL,
  `IdDestinacije` int(11) NOT NULL,
  PRIMARY KEY (`IdKom`,`IdDestinacije`),
  KEY `R_23` (`IdDestinacije`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
