-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 13-Maio-2019 às 14:22
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
-- Estrutura da tabela `ordemservico`
--

DROP TABLE IF EXISTS `ordemservico`;
CREATE TABLE IF NOT EXISTS `ordemservico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_os` bigint(20) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `equipamento` longtext NOT NULL,
  `avaria` longtext NOT NULL,
  `observacao` longtext,
  `user_created` varchar(12) NOT NULL,
  `date_created` date NOT NULL,
  `hour_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordemservico`
--

INSERT INTO `ordemservico` (`id`, `numero_os`, `cliente`, `equipamento`, `avaria`, `observacao`, `user_created`, `date_created`, `hour_created`) VALUES
(1, 20190511134606, 'teste', 'a', 'a', 'a', 'teste', '2019-05-11', '13:46:06'),
(2, 20190511134716, 'teste', 'a', 'a', 'a', 'teste', '2019-05-11', '13:47:16'),
(3, 20190511140248, 'teste', 'a', 'a', 'a', 'teste', '2019-05-11', '14:02:48'),
(4, 20190511140627, 'teste', 'a', 'a', 'a', 'teste', '2019-05-11', '14:06:27'),
(5, 20190511154925, 'teste', 'aaaa', 'aaaa', 'aaaa', 'teste', '2019-05-11', '15:49:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `os_atual`
--

DROP TABLE IF EXISTS `os_atual`;
CREATE TABLE IF NOT EXISTS `os_atual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_os` bigint(14) NOT NULL,
  `status` int(1) NOT NULL,
  `user_atual` varchar(20) NOT NULL,
  `date_atual` date NOT NULL,
  `hour_atual` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `os_atual`
--

INSERT INTO `os_atual` (`id`, `n_os`, `status`, `user_atual`, `date_atual`, `hour_atual`) VALUES
(1, 20190511140248, 1, 'teste', '2019-05-11', '14:02:48'),
(2, 20190511140627, 1, 'teste', '2019-05-11', '14:06:27'),
(3, 20190511154925, 1, 'teste', '2019-05-11', '15:49:25'),
(4, 20190511140248, 2, 'teste', '2019-05-12', '17:16:20');

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
-- Estrutura da tabela `resposta_os`
--

DROP TABLE IF EXISTS `resposta_os`;
CREATE TABLE IF NOT EXISTS `resposta_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `os_id` bigint(14) NOT NULL,
  `msg_os` longtext NOT NULL,
  `data_prev` date NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `user_atual` varchar(15) NOT NULL,
  `data_atual` date NOT NULL,
  `hora_atual` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resposta_os`
--

INSERT INTO `resposta_os` (`id`, `os_id`, `msg_os`, `data_prev`, `valor`, `user_atual`, `data_atual`, `hora_atual`) VALUES
(2, 20190511140248, 'asdasdas', '2019-05-12', '0.00', 'teste', '2019-05-12', '17:16:20');

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
(2, 'teste', '1234', 'teste', '(00) 00000-0000', 3, 'teste_11052019081009.jpg', 1, '2018-10-22', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
