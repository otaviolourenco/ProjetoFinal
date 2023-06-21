-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18-Jun-2023 às 20:55
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
-- Estrutura da tabela `Encomendas`
--

CREATE TABLE `Encomendas` (
  `IDencomenda` int(11) NOT NULL,
  `IDuser` int(11) NOT NULL,
  `Morada` text DEFAULT NULL,
  `Total` decimal(10,2) NOT NULL,
  `DataEncomenda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Produtos`
--

CREATE TABLE `Produtos` (
  `IDproduto` int(11) NOT NULL,
  `NomeProduto` varchar(255) NOT NULL,
  `Preco` decimal(5,2) DEFAULT NULL,
  `PrecoPromo` decimal(5,2) DEFAULT NULL,
  `QtEstoque` int(11) NOT NULL,
  `FotoProduto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `Produtos`
--

INSERT INTO `Produtos` (`IDproduto`, `NomeProduto`, `Preco`, `PrecoPromo`, `QtEstoque`, `FotoProduto`) VALUES
(1, 'Café 3 Corações', '4.20', '2.99', 10, 'uploads/cafe3-cor.png'),
(2, 'Nescau 2.0', '7.98', '5.45', 0, 'uploads/nescau.png'),
(3, 'Açaí Native', '3.19', '2.49', 0, 'uploads/acai-pq.png'),
(4, 'Farinha de Milho Flocão', '2.99', '1.99', 15, 'uploads/cuscuz-sinha.png'),
(5, 'Cachaça 51', '18.00', '16.90', 30, 'uploads/51-gd.png'),
(6, 'Açaí 250ml', '4.39', '5.99', 30, 'uploads/acai-gd.png'),
(7, 'Cappuccino Classic', '8.89', '9.99', 0, 'uploads/cappu3-cor.png'),
(8, 'Catuaba Selvagem', '14.49', '12.90', 30, 'uploads/catuaba.png'),
(9, 'Cuscuz Vitamilho', '3.99', '2.49', 30, 'uploads/cuscuz.png'),
(10, 'Guaraná Antartica', '2.49', '1.99', 30, 'uploads/guarana-gd.png'),
(11, 'Guaraná Antartica Lata', '0.99', '0.75', 0, 'uploads/guarana-pq.png'),
(12, 'Paçoca de Amendoim', '6.59', '4.49', 30, 'uploads/pacoca.png'),
(13, 'Pão de Queijo ', '2.99', '2.39', 30, 'uploads/pao-queijo.png'),
(14, 'Tapioca Hidratada', '3.99', '2.49', 30, 'uploads/tapioca.png'),
(15, 'Cachaça Velho Barreiro', '11.49', '9.19', 0, 'uploads/velho-bar.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Usuarios`
--

CREATE TABLE `Usuarios` (
  `IDuser` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `dataNasc` date DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Morada` text DEFAULT NULL,
  `CP` text DEFAULT '0000-000',
  `Tel` int(11) DEFAULT NULL,
  `NivelAcesso` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `Usuarios`
--

INSERT INTO `Usuarios` (`IDuser`, `Nome`, `dataNasc`, `Email`, `Senha`, `Morada`, `CP`, `Tel`, `NivelAcesso`) VALUES
(2, 'Cliente Teste', NULL, 'cliente@teste.com', '$2y$10$uSRciLafUSm8ruivtJr7huWMhmiImKpG8fm9leenoMSVRjlbaJHYu', NULL, '0000-000', NULL, 0),
(3, 'User Admin', '1994-11-03', 'admin@email.com', '$2y$10$L6TSRFmLsrZjOQVfdqPtJ.ROk8vs.Tjutf6HUKE5wUS3YrqBZyEwq', 'Rua Jardim n4', '2650-230', 912345678, 1),
(4, 'Cliente Comum', NULL, 'cliente@email.com', '$2y$10$SOG5WP.Mos1P3KwVvZN3fOOYDfdda6ogNhKJcsjgdA3HZFA/V0hwa', NULL, '0000-000', NULL, 0),
(5, 'Maria Silva', NULL, 'maria@gmail.com', '$2y$10$ZPRPe4AG3Mm61QUUPRITU.X3wZTXblVrnwfcVB/K4LHXlONyloX0O', NULL, '0000-000', NULL, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Encomendas`
--
ALTER TABLE `Encomendas`
  ADD PRIMARY KEY (`IDencomenda`),
  ADD KEY `IDuser` (`IDuser`);

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
-- AUTO_INCREMENT de tabela `Encomendas`
--
ALTER TABLE `Encomendas`
  MODIFY `IDencomenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `Produtos`
--
ALTER TABLE `Produtos`
  MODIFY `IDproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `IDuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `Encomendas`
--
ALTER TABLE `Encomendas`
  ADD CONSTRAINT `encomendas_ibfk_1` FOREIGN KEY (`IDuser`) REFERENCES `Usuarios` (`IDuser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
