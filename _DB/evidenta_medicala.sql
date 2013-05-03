-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2013 at 06:44 PM
-- Server version: 5.1.49-3
-- PHP Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evidenta_medicala`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctori`
--

CREATE TABLE IF NOT EXISTS `doctori` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `prenume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `cod_parafa` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `doctori`
--

INSERT INTO `doctori` (`id`, `nume`, `prenume`, `cod_parafa`) VALUES
(1, 'DoctorTest1', 'DoctorTest1', 1),
(2, 'DoctorTest2', 'DoctorTest2', 2),
(3, 'DoctorTest3', 'DoctorTest3', 3),
(4, 'Drăghici', 'Lidia', 70662),
(5, 'Rednic', 'Vasile', 70515),
(6, 'Constantinescu', 'Alin', 70315),
(7, 'Trăilă', 'Liviu', 70583),
(8, 'Rednic', 'Rodica', 70582),
(9, 'Bolboașe', 'Dorel', 70311),
(10, 'Dima', 'Zoica', 70310),
(11, 'Diaconu', 'Ion', 2346);

-- --------------------------------------------------------

--
-- Table structure for table `dosare`
--

CREATE TABLE IF NOT EXISTS `dosare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `farmacii`
--

CREATE TABLE IF NOT EXISTS `farmacii` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `farmacii`
--

INSERT INTO `farmacii` (`id`, `nume`) VALUES
(1, 'FarmacieTest1'),
(2, 'FarmacieTest2'),
(3, 'S.C Ralservice S.R.L Pharmaline'),
(4, 'S.C Iris Farm COM S.R.L'),
(5, 'S.C Avicenna Farm S.R.L'),
(6, 'Remedia Farm S.R.L');

-- --------------------------------------------------------

--
-- Table structure for table `medicamente_nomenclatoare`
--

CREATE TABLE IF NOT EXISTS `medicamente_nomenclatoare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume_medicament` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `data` date NOT NULL,
  `tip` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medicamente_retete`
--

CREATE TABLE IF NOT EXISTS `medicamente_retete` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_reteta` int(20) NOT NULL,
  `id_medicament` int(20) NOT NULL,
  `valoare_amanunt` float NOT NULL,
  `valoare_compensata` float NOT NULL,
  `valoare_decont` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `motive`
--

CREATE TABLE IF NOT EXISTS `motive` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_romanian_ci NOT NULL,
  `id_medicament` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pacienti`
--

CREATE TABLE IF NOT EXISTS `pacienti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip` int(1) NOT NULL,
  `nume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `prenume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `cnp` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `retete`
--

CREATE TABLE IF NOT EXISTS `retete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_doctor` int(2) NOT NULL,
  `id_utilizator` int(2) NOT NULL,
  `tip` int(1) NOT NULL,
  `id_pacient` int(11) NOT NULL,
  `data_reteta` date NOT NULL,
  `nr_fisa_inregistrare` int(20) NOT NULL,
  `nr_registru_consultatii` int(20) NOT NULL,
  `id_farmacie` int(2) NOT NULL,
  `serie_reteta_compensata` varchar(20) COLLATE utf8_romanian_ci NOT NULL,
  `nr_reteta_compensata` int(20) NOT NULL,
  `validitate` int(1) NOT NULL,
  `id_motive` int(2) NOT NULL,
  `nr_din_dosar` int(3) NOT NULL,
  `id_dosar` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE IF NOT EXISTS `utilizatori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `prenume` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
  `parola` varchar(255) COLLATE utf8_romanian_ci NOT NULL,
  `rol` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `nume`, `prenume`, `username`, `parola`, `rol`) VALUES
(1, 'Test', 'Test', 'test.test', '098f6bcd4621d373cade4e832627b4f6', 0),
(2, 'Test2', 'Test2', 'test2.test2', 'ad0234829205b9033196ba818f7a872b', 2),
(3, 'test1', 'test1', 'test1.test1', '5a105e8b9d40e1329780d62ea2265d8a', 1),
(4, 'Boteanu', 'Gabriela', 'gabriela.boteanu', 'gabriela.boteanu', 0),
(5, 'Bădescu', 'Dragoș', 'dragos.badescu', 'dragos.badescu', 0),
(6, 'Ulianov', 'Carmen', 'carmen.ulianov', 'carmen.ulianov', 0),
(7, 'Anastasiu', 'Sanda', 'sanda.anastasiu', 'sanda.anastasiu', 0),
(8, 'Ene', 'Consuela', 'consuela.ene', 'consuela.ene', 0),
(9, 'Lamer', 'Rodica', 'rodica.lamer', 'rodica.lamer', 0),
(10, 'Turcu', 'Dan', 'dan.turcu', 'dan.turcu', 0),
(11, 'Marinică', 'Cristian', 'cristian.marinica', 'cristian.marinica', 0),
(12, 'Trache', 'Roxana', 'roxana.trache', 'roxana.trache', 0),
(13, 'Oprei', 'Liviu', 'liviu.oprei', 'liviu.oprei', 0),
(14, 'Spătaru', 'Mariana', 'mariana.spataru', 'mariana.spataru', 0),
(15, 'Maxim', 'Lidia', 'lidia.maxim', 'lidia.maxim', 0),
(16, 'Ion', 'Mircea-Florian', 'mircea.ion', 'mircea.ion', 0),
(17, 'Buzică', 'Anda-Maria', 'anda.buzica', 'anda.buzica', 0),
(18, 'Mușat', 'Adriana', 'adriana.musat', 'adriana.musat', 0),
(19, 'Lepădat', 'Eugenia', 'eugenia.lapadat', 'eugenia.lapadat', 0),
(20, 'Mămularu', 'George', 'george.mamularu', 'george.mamularu', 0),
(21, 'Popescu', 'Daniela', 'daniela.popescu', 'daniela.popescu', 0),
(22, 'Mihăilescu', 'Constantin', 'constantin.mihailescu', 'constantin.mihailescu', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
