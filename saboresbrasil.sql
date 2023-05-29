-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24-Maio-2023 às 23:15
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `saboresbrasil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Clientes`
--

CREATE TABLE `Clientes` (
  `IDcliente` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Morada` text NOT NULL,
  `Tel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Produtos`
--

CREATE TABLE `Produtos` (
  `IDproduto` int(11) NOT NULL,
  `NomeProduto` varchar(255) NOT NULL,
  `Preco` decimal(5,2) DEFAULT NULL,
  `PrecoForm` varchar(255) NOT NULL,
  `PrecoPromo` decimal(5,2) DEFAULT NULL,
  `QtEstoque` int(11) NOT NULL,
  `FotoProduto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `Produtos`
--

INSERT INTO `Produtos` (`IDproduto`, `NomeProduto`, `Preco`, `PrecoForm`, `PrecoPromo`, `QtEstoque`, `FotoProduto`) VALUES
(1, 'Café 3 Corações', '4.20', '', '1.99', 30, ''),
(2, 'Nescau 2.0', '8.00', '', '6.00', 30, '');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `produtosview`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `produtosview` (
`IDproduto` int(11)
,`NomeProduto` varchar(255)
,`Preco` decimal(5,2)
,`PrecoPromo` decimal(5,2)
,`QtEstoque` int(11)
,`FotoProduto` text
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Usuarios`
--

CREATE TABLE `Usuarios` (
  `IDuser` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Senha` int(11) NOT NULL,
  `NivelAcesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para vista `produtosview`
--
DROP TABLE IF EXISTS `produtosview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `produtosview`  AS SELECT `produtos`.`IDproduto` AS `IDproduto`, `produtos`.`NomeProduto` AS `NomeProduto`, `produtos`.`Preco` AS `Preco`, `produtos`.`PrecoPromo` AS `PrecoPromo`, `produtos`.`QtEstoque` AS `QtEstoque`, `produtos`.`FotoProduto` AS `FotoProduto` FROM `produtos``produtos`  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`IDcliente`);

--
-- Índices para tabela `Produtos`
--
ALTER TABLE `Produtos`
  ADD PRIMARY KEY (`IDproduto`);

--
-- Índices para tabela `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`IDuser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `IDcliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Produtos`
--
ALTER TABLE `Produtos`
  MODIFY `IDproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `IDuser` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
