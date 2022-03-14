-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Mar-2022 às 17:53
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `contas`
--
CREATE DATABASE IF NOT EXISTS `contas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `contas`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE IF NOT EXISTS `despesas` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fechado`
--

CREATE TABLE IF NOT EXISTS `fechado` (
  `periodo` int(11) NOT NULL,
  PRIMARY KEY (`periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `despesa` int(11) NOT NULL,
  `gastoem` date NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `credor` varchar(255) NOT NULL,
  `mp` varchar(255) NOT NULL,
  `vencimento` date DEFAULT NULL,
  `agrupador` varchar(255) DEFAULT NULL,
  `localizador` varchar(255) DEFAULT NULL,
  `pagoem` date DEFAULT NULL,
  `observacao_pgto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recebimentos`
--

CREATE TABLE IF NOT EXISTS `recebimentos` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `receita` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE IF NOT EXISTS `receitas` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `devedor` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `vencimento` date DEFAULT NULL,
  `agrupador` varchar(255) DEFAULT NULL,
  `localizador` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
