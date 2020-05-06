-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 11-Maio-2019 às 11:08
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameteczone`
--
CREATE DATABASE IF NOT EXISTS `gameteczone` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gameteczone`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

DROP TABLE IF EXISTS `despesas`;
CREATE TABLE IF NOT EXISTS `despesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `descricao` varchar(25) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `d_vencimento` date NOT NULL,
  `obs` longtext NOT NULL,
  `f_pagamento` varchar(25) NOT NULL,
  `pago` int(2) NOT NULL,
  `data_creater` date NOT NULL,
  `hora_creator` time NOT NULL,
  `user_creater` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `d_modifica` date NOT NULL,
  `h_modifica` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `date`, `descricao`, `valor`, `d_vencimento`, `obs`, `f_pagamento`, `pago`, `data_creater`, `hora_creator`, `user_creater`, `status`, `d_modifica`, `h_modifica`) VALUES
(1, '2018-10-21', 'Pagamento SalÃ¡rios', '19000.00', '2018-11-05', 'Todos os FuncionÃ¡rios.', 'Dinheiro', 1, '2018-10-21', '19:20:58', 'admin', 1, '2019-05-06', '09:54:28'),
(2, '2018-10-21', 'asdsadas', '300.00', '2018-10-21', 'asdsa', 'Dinheiro', 1, '2018-10-21', '19:21:45', 'admin', 1, '2019-05-06', '09:41:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

DROP TABLE IF EXISTS `receitas`;
CREATE TABLE IF NOT EXISTS `receitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `descricao` varchar(25) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `obs` varchar(56) NOT NULL,
  `data_creater` date NOT NULL,
  `hora_creator` time NOT NULL,
  `user_creater` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `d_modificacao` date NOT NULL,
  `h_modificacao` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `nivel` int(11) NOT NULL,
  `userImg` varchar(35) NOT NULL,
  `status` int(11) NOT NULL,
  `date_creator` date NOT NULL,
  `user_creator` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `telefone`, `nivel`, `userImg`, `status`, `date_creator`, `user_creator`) VALUES
(1, 'admin', '@lf1n@nce1r01@3$', 'Admin', '00000-0000', 3, 'admin_22102018192215.jpg', 1, '2018-10-21', 'admin'),
(2, 'teste', '1234', 'teste', '(00) 00000-0000', 3, 'teste_22102018164417.jpg', 1, '2018-10-22', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
