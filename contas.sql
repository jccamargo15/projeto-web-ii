-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Dez-2018 às 00:56
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `centro_custos`
--

CREATE TABLE `centro_custos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `centro_custos`
--

INSERT INTO `centro_custos` (`id`, `nome`) VALUES
(2, 'Moradia'),
(4, 'SalÃ¡rio'),
(6, 'Transporte'),
(7, 'FamÃ­lia'),
(8, 'Super Mercado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`id`, `nome`) VALUES
(2, 'Banrisul'),
(3, 'Caixa Federal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `descricao`) VALUES
(1, 'Carro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_centro_custos` int(10) UNSIGNED NOT NULL,
  `id_conta` int(10) UNSIGNED NOT NULL,
  `tipo_mov` varchar(10) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `movimentacao`
--

INSERT INTO `movimentacao` (`id`, `id_centro_custos`, `id_conta`, `tipo_mov`, `data`, `descricao`, `valor`) VALUES
(14, 4, 2, 'credito', '2018-09-05', 'SalÃ¡rio da empresa', '2500.00'),
(15, 4, 2, 'credito', '2018-10-05', 'SalÃ¡rio da empresa', '2500.00'),
(16, 4, 2, 'credito', '2018-11-05', 'SalÃ¡rio da empresa', '2500.00'),
(17, 4, 2, 'credito', '2018-12-05', 'SalÃ¡rio da empresa', '2500.00'),
(18, 4, 2, 'credito', '2019-01-05', 'SalÃ¡rio da empresa', '2500.00'),
(19, 4, 2, 'credito', '2018-12-20', '2Âº Parcela DÃ©cimo', '1250.00'),
(20, 4, 2, 'credito', '2018-11-30', '1Âº Parcela DÃ©cimo', '1250.00'),
(21, 4, 3, 'credito', '2018-12-12', 'BonificaÃ§Ã£o de Natal', '500.00'),
(22, 4, 3, 'credito', '2019-01-10', 'FÃ©rias', '2000.00'),
(23, 4, 3, 'credito', '2018-11-16', 'Vendas do brechÃ³', '235.00'),
(24, 4, 3, 'credito', '2018-10-15', '2Âª Parcela do Site', '1375.00'),
(25, 4, 3, 'credito', '2018-09-14', '1Âª Parcela do Site', '1375.00'),
(26, 2, 2, 'debito', '2018-09-10', 'Aluguel', '850.00'),
(27, 2, 2, 'debito', '2018-10-10', 'Aluguel', '850.00'),
(28, 2, 2, 'debito', '2018-11-10', 'Aluguel', '850.00'),
(29, 4, 2, 'debito', '2018-12-10', 'Aluguel', '850.00'),
(30, 2, 2, 'debito', '2019-01-10', 'Aluguel', '850.00'),
(31, 7, 2, 'debito', '2018-12-03', 'Uber', '14.65'),
(32, 6, 2, 'debito', '2018-09-20', 'Gasolina', '155.00'),
(33, 6, 2, 'debito', '2018-10-20', 'Gasolina', '178.00'),
(34, 6, 2, 'debito', '2018-11-20', 'Gasolina', '190.00'),
(35, 6, 2, 'debito', '2018-12-20', 'Gasolina', '225.00'),
(36, 6, 2, 'debito', '2019-01-20', 'Gasolina', '285.00'),
(37, 7, 3, 'debito', '2018-09-25', 'Motel', '150.00'),
(38, 7, 3, 'debito', '2018-10-18', 'Viagem SÃ£o Paulo', '750.00'),
(39, 7, 3, 'debito', '2018-11-12', 'Vacina Cachorro', '65.00'),
(40, 7, 3, 'debito', '2018-12-20', 'Presentes Natal', '1550.00'),
(41, 7, 3, 'debito', '2019-01-07', 'Viagem Praia', '990.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcelas`
--

CREATE TABLE `parcelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_centro_custos` int(10) UNSIGNED NOT NULL,
  `id_conta` int(10) UNSIGNED NOT NULL,
  `id_item` int(11) NOT NULL,
  `tipo_mov` varchar(10) NOT NULL,
  `parcela` varchar(10) NOT NULL,
  `vencimento` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status_pagamento` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recorrentes`
--

CREATE TABLE `recorrentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_centro_custos` int(10) UNSIGNED NOT NULL,
  `id_conta` int(10) UNSIGNED NOT NULL,
  `tipo_mov` varchar(10) DEFAULT NULL,
  `dia` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recorrentes_movimentacao`
--

CREATE TABLE `recorrentes_movimentacao` (
  `id_recorrentes` int(10) UNSIGNED NOT NULL,
  `id_movimentacao` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centro_custos`
--
ALTER TABLE `centro_custos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recorrentes`
--
ALTER TABLE `recorrentes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centro_custos`
--
ALTER TABLE `centro_custos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recorrentes`
--
ALTER TABLE `recorrentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
