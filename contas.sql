-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14/09/2018 às 21:50
-- Versão do servidor: 10.1.31-MariaDB
-- Versão do PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `contas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `centro_custos`
--

CREATE TABLE `centro_custos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas`
--

CREATE TABLE `contas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao`
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `parcelas`
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
-- Estrutura para tabela `recorrentes`
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
-- Estrutura para tabela `recorrentes_movimentacao`
--

CREATE TABLE `recorrentes_movimentacao` (
  `id_recorrentes` int(10) UNSIGNED NOT NULL,
  `id_movimentacao` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `centro_custos`
--
ALTER TABLE `centro_custos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movimentacao_centro_custos_idx` (`id_centro_custos`),
  ADD KEY `fk_movimentacao_contas1_idx` (`id_conta`);

--
-- Índices de tabela `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parcelas_contas1_idx` (`id_conta`),
  ADD KEY `fk_parcelas_centro_custos1_idx` (`id_centro_custos`),
  ADD KEY `fk_parcelas_item1_idx` (`id_item`);

--
-- Índices de tabela `recorrentes`
--
ALTER TABLE `recorrentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recorrentes_centro_custos1_idx` (`id_centro_custos`),
  ADD KEY `fk_recorrentes_contas1_idx` (`id_conta`);

--
-- Índices de tabela `recorrentes_movimentacao`
--
ALTER TABLE `recorrentes_movimentacao`
  ADD PRIMARY KEY (`id_recorrentes`,`id_movimentacao`),
  ADD KEY `fk_recorrentes_has_movimentacao_movimentacao1_idx` (`id_movimentacao`),
  ADD KEY `fk_recorrentes_has_movimentacao_recorrentes1_idx` (`id_recorrentes`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `centro_custos`
--
ALTER TABLE `centro_custos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `recorrentes`
--
ALTER TABLE `recorrentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `fk_movimentacao_centro_custos` FOREIGN KEY (`id_centro_custos`) REFERENCES `centro_custos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimentacao_contas1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `parcelas`
--
ALTER TABLE `parcelas`
  ADD CONSTRAINT `fk_parcelas_centro_custos1` FOREIGN KEY (`id_centro_custos`) REFERENCES `centro_custos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parcelas_contas1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parcelas_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `recorrentes`
--
ALTER TABLE `recorrentes`
  ADD CONSTRAINT `fk_recorrentes_centro_custos1` FOREIGN KEY (`id_centro_custos`) REFERENCES `centro_custos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recorrentes_contas1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `recorrentes_movimentacao`
--
ALTER TABLE `recorrentes_movimentacao`
  ADD CONSTRAINT `fk_recorrentes_has_movimentacao_movimentacao1` FOREIGN KEY (`id_movimentacao`) REFERENCES `movimentacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recorrentes_has_movimentacao_recorrentes1` FOREIGN KEY (`id_recorrentes`) REFERENCES `recorrentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
