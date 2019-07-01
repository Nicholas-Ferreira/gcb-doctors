-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 01-Jul-2019 às 01:31
-- Versão do servidor: 5.7.25
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bddoctors`
--
CREATE DATABASE IF NOT EXISTS `bddoctors` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bddoctors`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `doctor_specialty`
--

CREATE TABLE `doctor_specialty` (
  `crm` int(11) NOT NULL,
  `id_specialty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `doctor_specialty`
--

INSERT INTO `doctor_specialty` (`crm`, `id_specialty`) VALUES
(2, 5),
(2, 6),
(11, 1),
(11, 4),
(11, 8),
(11, 11),
(11, 13),
(12, 1),
(12, 4),
(12, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdoctors`
--

CREATE TABLE `tbdoctors` (
  `crm` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `state` varchar(2) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbdoctors`
--

INSERT INTO `tbdoctors` (`crm`, `name`, `phone`, `state`, `city`) VALUES
(11, 'Nicholas Mota Ferreira', '(11) 9774-2152', 'AL', 'Água Branca'),
(12, 'Leonardo', '(00) 0000-0000', 'CE', 'Alto Santo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbspecialties`
--

CREATE TABLE `tbspecialties` (
  `id_specialty` int(11) NOT NULL,
  `specialty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbspecialties`
--

INSERT INTO `tbspecialties` (`id_specialty`, `specialty`) VALUES
(1, 'ALERGOLOGIA'),
(2, 'ANGIOLOGIA'),
(3, 'BUCO MAXILO'),
(4, 'CARDIOLOGIA CLINICA'),
(5, 'CARDIOLOGIA INFANTIL'),
(6, 'CIRURGIA CABEÇA E PESCOÇO'),
(7, 'CIRURGIA CARDÍACA'),
(8, 'CIRURGIA DE CABEÇA/PESCOÇO'),
(9, 'CIRURGIA DE TORAX'),
(10, 'CIRURGIA GERAL'),
(11, 'CIRURGIA PEDIÁTRICA'),
(12, 'CIRURGIA PLÁSTICA'),
(13, 'CIRURGIA TORÁCICA'),
(14, 'CIRURGIA VASCULAR'),
(15, 'CLINICA MEDICA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor_specialty`
--
ALTER TABLE `doctor_specialty`
  ADD PRIMARY KEY (`crm`,`id_specialty`);

--
-- Indexes for table `tbdoctors`
--
ALTER TABLE `tbdoctors`
  ADD PRIMARY KEY (`crm`);

--
-- Indexes for table `tbspecialties`
--
ALTER TABLE `tbspecialties`
  ADD PRIMARY KEY (`id_specialty`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbspecialties`
--
ALTER TABLE `tbspecialties`
  MODIFY `id_specialty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
