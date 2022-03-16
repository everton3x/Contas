-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Mar-2022 às 14:53
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
-- Banco de dados: `id18621418_contas`
--
CREATE DATABASE IF NOT EXISTS `id18621418_contas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `id18621418_contas`;

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
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`cod`, `periodo`, `descricao`, `valor`) VALUES
(1, 202203, 'Água', '99.99'),
(2, 202203, 'Barraca Missões', '552.03'),
(26, 202203, 'Botas Marlise (10/14)', '10.66'),
(27, 202204, 'Botas Marlise (11/14)', '10.66'),
(28, 202205, 'Botas Marlise (12/14)', '10.66'),
(29, 202206, 'Botas Marlise (13/14)', '10.66'),
(30, 202207, 'Botas Marlise (14/14)', '10.42'),
(52, 202203, 'Cabelo', '50.00'),
(53, 202204, 'Cabelo', '50.00'),
(54, 202205, 'Cabelo', '50.00'),
(55, 202206, 'Cabelo', '50.00'),
(56, 202207, 'Cabelo', '50.00'),
(57, 202208, 'Cabelo', '50.00'),
(58, 202209, 'Cabelo', '50.00'),
(59, 202210, 'Cabelo', '50.00'),
(60, 202211, 'Cabelo', '50.00'),
(61, 202212, 'Cabelo', '50.00'),
(62, 202203, 'Calças Pedro', '6.29'),
(63, 202203, 'Combustível Carro', '150.00'),
(64, 202204, 'Combustível Carro', '500.00'),
(65, 202205, 'Combustível Carro', '500.00'),
(66, 202206, 'Combustível Carro', '500.00'),
(67, 202207, 'Combustível Carro', '500.00'),
(68, 202208, 'Combustível Carro', '500.00'),
(69, 202209, 'Combustível Carro', '500.00'),
(70, 202210, 'Combustível Carro', '500.00'),
(71, 202211, 'Combustível Carro', '500.00'),
(72, 202212, 'Combustível Carro', '500.00'),
(73, 202203, 'Combustível Moto', '250.00'),
(74, 202204, 'Combustível Moto', '250.00'),
(75, 202205, 'Combustível Moto', '250.00'),
(76, 202206, 'Combustível Moto', '250.00'),
(77, 202207, 'Combustível Moto', '250.00'),
(78, 202208, 'Combustível Moto', '250.00'),
(79, 202209, 'Combustível Moto', '250.00'),
(80, 202210, 'Combustível Moto', '250.00'),
(81, 202211, 'Combustível Moto', '250.00'),
(82, 202212, 'Combustível Moto', '250.00'),
(83, 202203, 'Comida pro bicharedo', '400.00'),
(84, 202203, 'Doação', '30.00'),
(85, 202203, 'Farmácia', '36.73'),
(86, 202203, 'INSS', '242.40'),
(87, 202204, 'INSS', '242.40'),
(88, 202205, 'INSS', '242.40'),
(89, 202206, 'INSS', '242.40'),
(90, 202207, 'INSS', '242.40'),
(91, 202208, 'INSS', '242.40'),
(92, 202209, 'INSS', '242.40'),
(93, 202210, 'INSS', '242.40'),
(94, 202211, 'INSS', '242.40'),
(95, 202212, 'INSS', '242.40'),
(96, 202203, 'Internet', '89.00'),
(97, 202204, 'Internet', '89.00'),
(98, 202205, 'Internet', '89.00'),
(99, 202206, 'Internet', '89.00'),
(100, 202207, 'Internet', '89.00'),
(101, 202208, 'Internet', '89.00'),
(102, 202209, 'Internet', '89.00'),
(103, 202210, 'Internet', '89.00'),
(104, 202211, 'Internet', '89.00'),
(105, 202212, 'Internet', '89.00'),
(106, 202203, 'IPERGS', '485.26'),
(107, 202204, 'IPERGS', '485.26'),
(108, 202205, 'IPERGS', '485.26'),
(109, 202206, 'IPERGS', '485.26'),
(110, 202207, 'IPERGS', '485.26'),
(111, 202208, 'IPERGS', '485.26'),
(112, 202209, 'IPERGS', '485.26'),
(113, 202210, 'IPERGS', '485.26'),
(114, 202211, 'IPERGS', '485.26'),
(115, 202212, 'IPERGS', '485.26'),
(116, 202203, 'IPTU 2022', '581.63'),
(128, 202203, 'Jogo de pratos (12/15)', '6.33'),
(129, 202204, 'Jogo de pratos (13/15)', '6.33'),
(130, 202205, 'Jogo de pratos (14/15)', '6.33'),
(131, 202206, 'Jogo de pratos (15/15)', '6.38'),
(132, 202203, 'Lavagem carro', '40.00'),
(143, 202203, 'Lençol (11/12)', '16.67'),
(144, 202204, 'Lençol (12/12)', '16.63'),
(145, 202203, 'Limpeza fossa séptica', '150.00'),
(146, 202203, 'Lojão Econômico', '84.80'),
(147, 202203, 'Luz', '101.59'),
(148, 202203, 'Mangueira ar-condicionado', '25.60'),
(151, 202203, 'Máscaras (3/8)', '11.19'),
(152, 202204, 'Máscaras (4/8)', '11.19'),
(153, 202205, 'Máscaras (5/8)', '11.19'),
(154, 202206, 'Máscaras (6/8)', '11.19'),
(155, 202207, 'Máscaras (7/8)', '11.19'),
(156, 202208, 'Máscaras (8/8)', '11.67'),
(157, 202203, 'Materiais torneira Marina', '212.00'),
(158, 202203, 'Mensalidade DH Arthur', '724.59'),
(159, 202204, 'Mensalidade DH Arthur', '724.59'),
(160, 202205, 'Mensalidade DH Arthur', '724.59'),
(161, 202206, 'Mensalidade DH Arthur', '724.59'),
(162, 202207, 'Mensalidade DH Arthur', '724.59'),
(163, 202208, 'Mensalidade DH Arthur', '724.59'),
(164, 202209, 'Mensalidade DH Arthur', '724.59'),
(165, 202210, 'Mensalidade DH Arthur', '724.59'),
(166, 202211, 'Mensalidade DH Arthur', '724.59'),
(167, 202212, 'Mensalidade DH Arthur', '724.59'),
(168, 202203, 'Mensalidade DH Pedro', '548.25'),
(169, 202204, 'Mensalidade DH Pedro', '548.25'),
(170, 202205, 'Mensalidade DH Pedro', '548.25'),
(171, 202206, 'Mensalidade DH Pedro', '548.25'),
(172, 202207, 'Mensalidade DH Pedro', '548.25'),
(173, 202208, 'Mensalidade DH Pedro', '548.25'),
(174, 202209, 'Mensalidade DH Pedro', '548.25'),
(175, 202210, 'Mensalidade DH Pedro', '548.25'),
(176, 202211, 'Mensalidade DH Pedro', '548.25'),
(177, 202212, 'Mensalidade DH Pedro', '548.25'),
(178, 202203, 'Mercado', '1000.00'),
(179, 202204, 'Mercado', '1000.00'),
(180, 202205, 'Mercado', '1000.00'),
(181, 202206, 'Mercado', '1000.00'),
(182, 202207, 'Mercado', '1000.00'),
(183, 202208, 'Mercado', '1000.00'),
(184, 202209, 'Mercado', '1000.00'),
(185, 202210, 'Mercado', '1000.00'),
(186, 202211, 'Mercado', '1000.00'),
(187, 202212, 'Mercado', '1000.00'),
(188, 202203, 'Netflix', '55.90'),
(189, 202204, 'Netflix', '55.90'),
(190, 202205, 'Netflix', '55.90'),
(191, 202206, 'Netflix', '55.90'),
(192, 202207, 'Netflix', '55.90'),
(193, 202208, 'Netflix', '55.90'),
(194, 202209, 'Netflix', '55.90'),
(195, 202210, 'Netflix', '55.90'),
(196, 202211, 'Netflix', '55.90'),
(197, 202212, 'Netflix', '55.90'),
(198, 202203, 'Pacote de Iniciante (Stumble Guys: Multiplayer Royale)', '12.49'),
(199, 202203, 'Parafusos Casinha', '19.00'),
(200, 202203, 'Peça liquidificador marina', '10.00'),
(201, 202203, 'Pizza', '85.00'),
(209, 202203, 'Politriz (8/12)', '22.80'),
(210, 202204, 'Politriz (9/12)', '22.80'),
(211, 202205, 'Politriz (10/12)', '22.80'),
(212, 202206, 'Politriz (11/12)', '22.80'),
(213, 202207, 'Politriz (12/12)', '23.20'),
(214, 202203, 'Presente colega Pedro', '5.00'),
(229, 202203, 'Presente de casamento Maurício/Anelise (15/15)', '12.62'),
(230, 202203, 'Prestação da casa', '733.95'),
(239, 202203, 'Rádio Evaldi (9/13)', '12.13'),
(240, 202204, 'Rádio Evaldi (10/13)', '12.13'),
(241, 202205, 'Rádio Evaldi (11/13)', '12.13'),
(242, 202206, 'Rádio Evaldi (12/13)', '12.13'),
(243, 202207, 'Rádio Evaldi (13/13)', '12.44'),
(244, 202203, 'Rifa Rubens', '20.00'),
(253, 202203, 'Sapatênis Everton (9/12)', '8.38'),
(254, 202204, 'Sapatênis Everton (10/12)', '8.38'),
(255, 202205, 'Sapatênis Everton (11/12)', '8.38'),
(256, 202206, 'Sapatênis Everton (12/12)', '8.82'),
(265, 202203, 'Sapatênis Everton (9/12)', '11.75'),
(266, 202204, 'Sapatênis Everton (10/12)', '11.75'),
(267, 202205, 'Sapatênis Everton (11/12)', '11.75'),
(268, 202206, 'Sapatênis Everton (12/12)', '11.75'),
(269, 202203, 'Supercell Arthur', '54.90'),
(270, 202203, 'Tarifas bancárias', '30.00'),
(271, 202204, 'Tarifas bancárias', '30.00'),
(272, 202205, 'Tarifas bancárias', '30.00'),
(273, 202206, 'Tarifas bancárias', '30.00'),
(274, 202207, 'Tarifas bancárias', '30.00'),
(275, 202208, 'Tarifas bancárias', '30.00'),
(276, 202209, 'Tarifas bancárias', '30.00'),
(277, 202210, 'Tarifas bancárias', '30.00'),
(278, 202211, 'Tarifas bancárias', '30.00'),
(279, 202212, 'Tarifas bancárias', '30.00'),
(280, 202203, 'Teclado Arthur (1/8)', '45.36'),
(281, 202204, 'Teclado Arthur (2/8)', '45.36'),
(282, 202205, 'Teclado Arthur (3/8)', '45.36'),
(283, 202206, 'Teclado Arthur (4/8)', '45.36'),
(284, 202207, 'Teclado Arthur (5/8)', '45.36'),
(285, 202208, 'Teclado Arthur (6/8)', '45.36'),
(286, 202209, 'Teclado Arthur (7/8)', '45.36'),
(287, 202210, 'Teclado Arthur (8/8)', '45.48'),
(288, 202203, 'Telefone', '45.00'),
(289, 202204, 'Telefone', '45.00'),
(290, 202205, 'Telefone', '45.00'),
(291, 202206, 'Telefone', '45.00'),
(292, 202207, 'Telefone', '45.00'),
(293, 202208, 'Telefone', '45.00'),
(294, 202209, 'Telefone', '45.00'),
(295, 202210, 'Telefone', '45.00'),
(296, 202211, 'Telefone', '45.00'),
(297, 202212, 'Telefone', '45.00'),
(304, 202203, 'TênisMarlise (7/8)', '19.90'),
(305, 202204, 'TênisMarlise (8/8)', '19.70'),
(306, 202203, 'Tênis Roaldo', '150.03'),
(309, 202203, 'Travesseiros (3/12)', '21.31'),
(310, 202204, 'Travesseiros (4/12)', '21.31'),
(311, 202205, 'Travesseiros (5/12)', '21.31'),
(312, 202206, 'Travesseiros (6/12)', '21.31'),
(313, 202207, 'Travesseiros (7/12)', '21.31'),
(314, 202208, 'Travesseiros (8/12)', '21.31'),
(315, 202209, 'Travesseiros (9/12)', '21.31'),
(316, 202210, 'Travesseiros (10/12)', '21.31'),
(317, 202211, 'Travesseiros (11/12)', '21.31'),
(318, 202212, 'Travesseiros (12/12)', '21.59'),
(319, 202203, 'Trinco e braçadeiras', '20.00'),
(320, 202203, 'Troca da relação da moto', '170.00'),
(321, 202203, 'Troca das calçadas', '353.00'),
(322, 202203, 'Unhas marlise', '20.00'),
(325, 202203, 'Você Mais Saudável (3/12)', '29.90'),
(326, 202204, 'Você Mais Saudável (4/12)', '29.90'),
(327, 202205, 'Você Mais Saudável (5/12)', '29.90'),
(328, 202206, 'Você Mais Saudável (6/12)', '29.90'),
(329, 202207, 'Você Mais Saudável (7/12)', '29.90'),
(330, 202208, 'Você Mais Saudável (8/12)', '29.90'),
(331, 202209, 'Você Mais Saudável (9/12)', '29.90'),
(332, 202210, 'Você Mais Saudável (10/12)', '29.90'),
(333, 202211, 'Você Mais Saudável (11/12)', '29.90'),
(334, 202212, 'Você Mais Saudável (12/12)', '30.10'),
(335, 202203, 'Mercado Marina', '303.73'),
(336, 202204, 'Água', '130.00'),
(337, 202205, 'Água', '130.00'),
(338, 202206, 'Água', '130.00'),
(339, 202207, 'Água', '130.00'),
(340, 202208, 'Água', '130.00'),
(341, 202209, 'Água', '130.00'),
(342, 202210, 'Água', '130.00'),
(343, 202211, 'Água', '130.00'),
(344, 202212, 'Água', '130.00'),
(345, 202204, 'Luz', '120.00'),
(346, 202205, 'Luz', '120.00'),
(347, 202206, 'Luz', '120.00'),
(348, 202207, 'Luz', '120.00'),
(349, 202208, 'Luz', '120.00'),
(350, 202209, 'Luz', '120.00'),
(351, 202210, 'Luz', '120.00'),
(352, 202211, 'Luz', '120.00'),
(353, 202212, 'Luz', '120.00'),
(367, 202203, 'Baú da moto (14/15)', '8.39'),
(368, 202204, 'Baú da moto (15/15)', '8.54'),
(369, 202204, 'Mercado Marina', '316.13'),
(370, 202204, 'Mercado Marina', '192.26'),
(371, 202204, 'Poupança', '1700.00'),
(372, 202205, 'Poupança', '1700.00'),
(373, 202206, 'Poupança', '1500.00'),
(374, 202207, 'Poupança', '1500.00'),
(375, 202208, 'Poupança', '1500.00'),
(376, 202209, 'Poupança', '1500.00'),
(377, 202210, 'Poupança', '1500.00'),
(378, 202211, 'Poupança', '1500.00'),
(379, 202212, 'Poupança', '1500.00'),
(380, 202204, 'Prestação da casa', '760.00'),
(381, 202205, 'Prestação da casa', '760.00'),
(382, 202206, 'Prestação da casa', '760.00'),
(383, 202207, 'Prestação da casa', '760.00'),
(384, 202208, 'Prestação da casa', '760.00'),
(385, 202209, 'Prestação da casa', '760.00'),
(386, 202210, 'Prestação da casa', '760.00'),
(387, 202211, 'Prestação da casa', '760.00'),
(388, 202212, 'Prestação da casa', '760.00'),
(389, 202202, 'Implantação de resultado', '1551.34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fechado`
--

CREATE TABLE IF NOT EXISTS `fechado` (
  `periodo` int(11) NOT NULL,
  PRIMARY KEY (`periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fechado`
--

INSERT INTO `fechado` (`periodo`) VALUES
(202202);

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
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `gastos`
--

INSERT INTO `gastos` (`cod`, `despesa`, `gastoem`, `observacao`, `valor`, `credor`, `mp`, `vencimento`, `agrupador`, `localizador`, `pagoem`, `observacao_pgto`) VALUES
(1, 1, '2022-02-23', '', '99.99', 'CORSAN', 'Débito em conta', '2022-03-10', '', '', '2022-03-10', ''),
(2, 2, '2022-02-28', '', '552.03', 'Barraca Missões', 'TED', '0000-00-00', '', '', '2022-02-28', '255,63+296,40'),
(26, 26, '2021-07-28', 'Botas Marlise (10/14)', '10.66', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-840042217', '', '0000-00-00', ''),
(27, 27, '2021-07-28', 'Botas Marlise (11/14)', '10.66', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-840042217', '', '0000-00-00', ''),
(28, 28, '2021-07-28', 'Botas Marlise (12/14)', '10.66', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-840042217', '', '0000-00-00', ''),
(29, 29, '2021-07-28', 'Botas Marlise (13/14)', '10.66', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-840042217', '', '0000-00-00', ''),
(30, 30, '2021-07-28', 'Botas Marlise (14/14)', '10.42', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-840042217', '', '0000-00-00', ''),
(32, 62, '2022-03-05', 'pago 100 de vale-sorriso', '6.29', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930071888', '', '0000-00-00', ''),
(33, 63, '2022-03-09', '', '150.00', 'Posto Santa Terezinha', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(34, 73, '2022-03-07', '', '81.69', 'Posto Santa Terezinha', 'Inter/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(35, 83, '2022-02-26', '', '400.00', 'Marina', 'Dinheiro', '0000-00-00', '', '', '2022-02-26', ''),
(36, 84, '2022-03-10', '', '30.00', 'Outros', 'PIX', '0000-00-00', '', '', '2022-03-10', ''),
(37, 85, '2022-03-07', 'Tâmisa e levoid', '36.73', 'Farmácia São João', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(38, 106, '2022-03-03', '', '485.26', 'IPERGS', 'Boleto', '2022-03-10', '', '', '2022-03-03', ''),
(39, 116, '2022-03-03', '', '581.63', 'PM Três de Maio', 'Boleto', '2022-03-11', '', '', '2022-03-03', ''),
(51, 128, '2021-07-28', 'Jogo de pratos (12/15)', '6.33', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-824427767', '', '0000-00-00', ''),
(52, 129, '2021-07-28', 'Jogo de pratos (13/15)', '6.33', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-824427767', '', '0000-00-00', ''),
(53, 130, '2021-07-28', 'Jogo de pratos (14/15)', '6.33', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-824427767', '', '0000-00-00', ''),
(54, 131, '2021-07-28', 'Jogo de pratos (15/15)', '6.38', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-824427767', '', '0000-00-00', ''),
(55, 132, '2022-03-02', '', '40.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-02', ''),
(66, 143, '2021-07-28', 'Lençol (11/12)', '16.67', 'Grazziotin', 'Americanas/Cartão de Crédito', '0000-00-00', '100958', '', '0000-00-00', ''),
(67, 144, '2021-07-28', 'Lençol (12/12)', '16.63', 'Grazziotin', 'Americanas/Cartão de Crédito', '0000-00-00', '100958', '', '0000-00-00', ''),
(68, 145, '2022-03-04', '', '150.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-04', ''),
(69, 146, '2022-03-04', '', '84.80', 'Lojão Econômico', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(70, 147, '2022-03-14', '', '101.59', 'RGE', 'Débito em conta', '2022-03-14', '', '', '2022-03-14', ''),
(71, 148, '2022-03-12', '', '25.60', 'Serviluz', 'Inter/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(74, 151, '2022-01-13', 'Máscaras (3/8)', '11.19', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-919292344', '', '0000-00-00', ''),
(75, 152, '2022-01-13', 'Máscaras (4/8)', '11.19', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-919292344', '', '0000-00-00', ''),
(76, 153, '2022-01-13', 'Máscaras (5/8)', '11.19', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-919292344', '', '0000-00-00', ''),
(77, 154, '2022-01-13', 'Máscaras (6/8)', '11.19', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-919292344', '', '0000-00-00', ''),
(78, 155, '2022-01-13', 'Máscaras (7/8)', '11.19', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-919292344', '', '0000-00-00', ''),
(79, 156, '2022-01-13', 'Máscaras (8/8)', '11.67', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-919292344', '', '0000-00-00', ''),
(80, 157, '2022-02-25', '', '212.00', 'Serviluz', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(81, 178, '2022-03-01', 'Picolés', '20.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-01', ''),
(82, 178, '2022-03-02', 'Devolver latinha', '10.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-02', ''),
(83, 178, '2022-03-02', '', '72.41', 'Supermercado Benedetti', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(84, 178, '2022-03-04', 'Rapadura', '10.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-04', ''),
(85, 178, '2022-03-04', '', '78.11', 'Supermercado Benedetti', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(86, 178, '2022-03-08', 'Mandioca', '20.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-08', ''),
(87, 178, '2022-03-09', '', '377.23', 'Supermercado Benedetti', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(88, 198, '2022-03-13', '', '12.49', 'Google', 'Inter/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(89, 199, '2022-03-09', '', '19.00', 'Serviluz', 'Inter/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(90, 200, '2022-03-15', '', '10.00', 'Refrigeração Beckert', 'Dinheiro', '0000-00-00', '', '', '2022-03-15', ''),
(91, 201, '2022-03-05', '', '85.00', 'Pizzaria Mordomia', 'Dinheiro', '0000-00-00', '', '', '2022-03-05', ''),
(99, 209, '2021-08-10', 'Politriz (8/12)', '22.80', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-851589317', '', '0000-00-00', ''),
(100, 210, '2021-08-10', 'Politriz (9/12)', '22.80', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-851589317', '', '0000-00-00', ''),
(101, 211, '2021-08-10', 'Politriz (10/12)', '22.80', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-851589317', '', '0000-00-00', ''),
(102, 212, '2021-08-10', 'Politriz (11/12)', '22.80', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-851589317', '', '0000-00-00', ''),
(103, 213, '2021-08-10', 'Politriz (12/12)', '23.20', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-851589317', '', '0000-00-00', ''),
(104, 214, '2022-03-04', 'Luiza', '5.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-04', ''),
(119, 229, '2021-07-28', 'Presente de casamento Maurício/Anelise (15/15)', '12.62', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-812476434', '', '0000-00-00', ''),
(120, 230, '2022-03-02', '', '733.95', 'CEF', 'Débito em conta', '2022-03-15', '', '', '2022-03-15', ''),
(129, 239, '2021-07-28', 'Rádio Evaldi (9/13)', '12.13', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-841534364', '', '0000-00-00', ''),
(130, 240, '2021-07-28', 'Rádio Evaldi (10/13)', '12.13', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-841534364', '', '0000-00-00', ''),
(131, 241, '2021-07-28', 'Rádio Evaldi (11/13)', '12.13', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-841534364', '', '0000-00-00', ''),
(132, 242, '2021-07-28', 'Rádio Evaldi (12/13)', '12.13', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-841534364', '', '0000-00-00', ''),
(133, 243, '2021-07-28', 'Rádio Evaldi (13/13)', '12.44', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-841534364', '', '0000-00-00', ''),
(134, 244, '2022-03-14', '', '20.00', 'Rubens', 'PIX', '0000-00-00', '', '', '2022-03-14', ''),
(143, 253, '2021-07-28', 'Sapatênis Everton (9/12)', '8.38', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(144, 254, '2021-07-28', 'Sapatênis Everton (10/12)', '8.38', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(145, 255, '2021-07-28', 'Sapatênis Everton (11/12)', '8.38', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(146, 256, '2021-07-28', 'Sapatênis Everton (12/12)', '8.82', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(155, 265, '2021-07-28', 'Sapatênis Everton (9/12)', '11.75', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(156, 266, '2021-07-28', 'Sapatênis Everton (10/12)', '11.75', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(157, 267, '2021-07-28', 'Sapatênis Everton (11/12)', '11.75', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(158, 268, '2021-07-28', 'Sapatênis Everton (12/12)', '11.75', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-842716372', '', '0000-00-00', ''),
(159, 269, '2022-02-26', '', '54.90', 'Google', 'Inter/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(160, 270, '2022-03-03', 'Manutenção de conta', '15.50', 'Banrisul', 'Débito em conta', '2022-03-03', '', '', '2022-03-03', ''),
(161, 270, '2022-03-10', 'Manutenção de conta', '12.40', 'CEF', 'Débito em conta', '2022-03-10', '', '', '2022-03-10', ''),
(162, 280, '2022-03-08', 'Teclado Arthur (1/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(163, 281, '2022-03-08', 'Teclado Arthur (2/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(164, 282, '2022-03-08', 'Teclado Arthur (3/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(165, 283, '2022-03-08', 'Teclado Arthur (4/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(166, 284, '2022-03-08', 'Teclado Arthur (5/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(167, 285, '2022-03-08', 'Teclado Arthur (6/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(168, 286, '2022-03-08', 'Teclado Arthur (7/8)', '45.36', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(169, 287, '2022-03-08', 'Teclado Arthur (8/8)', '45.48', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-930867457', '', '0000-00-00', ''),
(176, 304, '2021-09-12', 'TênisMarlise (7/8)', '19.90', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-858257262', '', '0000-00-00', ''),
(177, 305, '2021-09-12', 'TênisMarlise (8/8)', '19.70', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-858257262', '', '0000-00-00', ''),
(178, 306, '2022-02-25', '', '150.03', 'Outros', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(181, 309, '2021-12-31', 'Travesseiros (3/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(182, 310, '2021-12-31', 'Travesseiros (4/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(183, 311, '2021-12-31', 'Travesseiros (5/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(184, 312, '2021-12-31', 'Travesseiros (6/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(185, 313, '2021-12-31', 'Travesseiros (7/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(186, 314, '2021-12-31', 'Travesseiros (8/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(187, 315, '2021-12-31', 'Travesseiros (9/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(188, 316, '2021-12-31', 'Travesseiros (10/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(189, 317, '2021-12-31', 'Travesseiros (11/12)', '21.31', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(190, 318, '2021-12-31', 'Travesseiros (12/12)', '21.59', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', '02-916151482', '', '0000-00-00', ''),
(191, 319, '2022-03-14', '', '20.00', 'Ferragens Reuter', 'CEF/Cartão de débito', '0000-00-00', '', '', '2022-03-14', ''),
(192, 320, '2022-03-06', '', '170.00', 'Motosport', 'Dinheiro', '0000-00-00', '', '', '2022-03-06', ''),
(193, 321, '2022-03-09', 'espaçadores', '4.00', 'Lojas Becker', 'Dinheiro', '0000-00-00', '', 'Troca das calçadas externas', '2022-03-09', ''),
(194, 321, '2022-03-08', '2 sc de simento e 0,5m areia', '172.00', 'Sabiá Materiais de Construção', 'Dinheiro', '0000-00-00', '', 'Troca das calçadas externas', '2022-03-08', ''),
(195, 321, '2022-03-08', 'espaçadores', '5.00', 'Lojas Becker', 'Dinheiro', '0000-00-00', '', 'Troca das calçadas externas', '2022-03-08', ''),
(196, 321, '2022-03-08', '2 sc cimento e 0,5m areia', '172.00', 'Sabiá Materiais de Construção', 'Dinheiro', '0000-00-00', '', 'Troca das calçadas externas', '2022-03-08', ''),
(197, 322, '2022-03-12', '', '20.00', 'Outros', 'Dinheiro', '0000-00-00', '', '', '2022-03-12', ''),
(200, 325, '2022-01-16', 'Você Mais Saudável (3/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(201, 326, '2022-01-16', 'Você Mais Saudável (4/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(202, 327, '2022-01-16', 'Você Mais Saudável (5/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(203, 328, '2022-01-16', 'Você Mais Saudável (6/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(204, 329, '2022-01-16', 'Você Mais Saudável (7/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(205, 330, '2022-01-16', 'Você Mais Saudável (8/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(206, 331, '2022-01-16', 'Você Mais Saudável (9/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(207, 332, '2022-01-16', 'Você Mais Saudável (10/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(208, 333, '2022-01-16', 'Você Mais Saudável (11/12)', '29.90', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(209, 334, '2022-01-16', 'Você Mais Saudável (12/12)', '30.10', 'Dani Faria Lima', 'Americanas/Cartão de Crédito', '0000-00-00', 'PG*DANI FARIA', '', '0000-00-00', ''),
(210, 335, '2022-02-12', '', '303.73', 'Supermercado Benedetti', 'Banricompras', '2022-03-30', '80305', '', '0000-00-00', ''),
(224, 367, '2021-07-28', 'Baú da moto (14/15)', '8.39', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', 'Baú da moto', '', '0000-00-00', ''),
(225, 368, '2021-07-28', 'Baú da moto (15/15)', '8.54', 'Americanas', 'Americanas/Cartão de Crédito', '0000-00-00', 'Baú da moto', '', '0000-00-00', ''),
(226, 369, '2022-02-23', '', '316.13', 'Supermercado Benedetti', 'Banricompras', '2022-04-08', '266017', '', '0000-00-00', ''),
(227, 370, '2022-02-25', '', '192.26', 'Supermercado Benedetti', 'Banricompras', '2022-04-13', '289643', '', '0000-00-00', ''),
(228, 389, '2022-03-16', '', '1551.34', 'Ajustes', 'Ajustes', '0000-00-00', 'Ajustes', 'Implantação', '2022-03-16', ''),
(229, 178, '2022-03-10', '', '20.24', 'Supermercado Benedetti', 'Americanas/Cartão de Crédito', '0000-00-00', '', '', '0000-00-00', ''),
(230, 86, '2022-03-15', '', '242.40', 'INSS', 'Débito em conta', '0000-00-00', '', '', '2022-03-15', ''),
(231, 168, '2022-03-10', '', '548.25', 'Dom Hermeto', 'Débito em conta', '2022-03-10', '', '', '2022-03-10', ''),
(232, 158, '2022-03-10', '', '724.59', 'Dom Hermeto', 'Débito em conta', '2022-03-10', '', '', '2022-03-10', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recebimentos`
--

INSERT INTO `recebimentos` (`cod`, `receita`, `data`, `valor`, `observacao`) VALUES
(1, 36, '2022-03-03', '44.01', 'Recebimento integrado à previsão da receita'),
(2, 38, '2022-03-03', '192.26', 'Recebimento integrado à previsão da receita'),
(3, 39, '2022-03-03', '552.00', 'Recebimento integrado à previsão da receita'),
(4, 40, '2022-02-28', '150.00', 'Recebimento integrado à previsão da receita'),
(5, 41, '2022-03-02', '55.00', 'Recebimento integrado à previsão da receita'),
(6, 42, '2022-03-03', '303.73', ''),
(7, 43, '2022-03-02', '28.00', 'Recebimento integrado à previsão da receita'),
(8, 44, '2022-02-25', '8400.03', 'Recebimento integrado à previsão da receita');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`cod`, `periodo`, `descricao`, `devedor`, `valor`, `vencimento`, `agrupador`, `localizador`) VALUES
(9, 202204, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(10, 202205, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(11, 202206, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(12, 202207, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(13, 202208, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(14, 202209, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(15, 202210, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(16, 202211, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(17, 202212, 'Salário', 'PM Independência', '7538.00', '0000-00-00', '', ''),
(18, 202204, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(19, 202205, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(20, 202206, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(21, 202207, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(22, 202208, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(23, 202209, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(24, 202210, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(25, 202211, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(26, 202212, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(27, 202204, 'Mercado Marina', 'Marina', '272.12', '0000-00-00', '266017', ''),
(34, 202203, 'Tênis Marlise (7/8)', 'Marlise', '0.00', '0000-00-00', '02-858257262', ''),
(35, 202204, 'Tênis Marlise (8/8)', 'Marlise', '0.00', '0000-00-00', '02-858257262', ''),
(36, 202203, 'Mercado Marina', 'Marina', '44.01', '0000-00-00', '266017', ''),
(37, 202203, 'Materiais para torneira', 'Marina', '212.00', '0000-00-00', '', ''),
(38, 202203, 'Mercado Marina', 'Marina', '192.26', '0000-00-00', '289643', ''),
(39, 202203, 'Barraca Missões', 'Evaldi', '552.00', '0000-00-00', '', ''),
(40, 202203, 'Tênis Roaldo', 'Roaldo', '150.00', '0000-00-00', '', ''),
(41, 202203, 'Supercell Arthur', 'Arthur', '55.00', '0000-00-00', '', ''),
(42, 202203, 'Mercado Marina', 'Marina', '303.73', '0000-00-00', '80305', ''),
(43, 202203, 'Netflix', 'Marcos Neuhaus', '28.00', '0000-00-00', '', ''),
(44, 202203, 'Salário', 'PM Independência', '8400.03', '0000-00-00', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
