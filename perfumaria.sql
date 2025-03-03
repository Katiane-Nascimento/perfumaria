-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/12/2023 às 01:49
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `perfumaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `CNPJ` varchar(255) NOT NULL,
  `razaoSocial` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `CNPJ`, `razaoSocial`, `endereco`) VALUES
(54, '12.345.678/9123.42', 'Eudora', 'Vitória'),
(56, '12.345.678/9123.46', 'Bim distribuidora', 'Rio de Janeiro'),
(57, '12.345.678/9123.47', 'Paris Distribuidora', 'São Paulo'),
(59, '12.345.678/9123.48', 'Sephora', 'Rio de Janeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfumes`
--

CREATE TABLE `perfumes` (
  `id` int(11) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `produtoFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perfumes`
--

INSERT INTO `perfumes` (`id`, `genero`, `volume`, `produtoFK`) VALUES
(1, 'Feminino', '100ml', 17),
(2, 'Masculino', '150ml', 18),
(3, 'Masculino', '120ml', 19),
(4, 'Feminino', '120ml', 20),
(5, 'Masculino', '100ml', 21),
(6, 'Feminino', '150ml', 22),
(7, 'Masculino', '150ml', 23);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `estoque` int(11) NOT NULL,
  `preco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `marca`, `estoque`, `preco`) VALUES
(17, 'Rose Naturelle', 'Chloé', 25, '580,00'),
(18, 'Romeo Red', 'Alfa', 50, '180,00'),
(19, 'Infinite', 'Hugo Boss', 33, '529,00'),
(20, 'Bloom', 'Gucci', 54, '320,00'),
(21, 'Paradoxe', 'Prada', 80, '540,00'),
(22, 'Idole now', 'Lancôme', 21, '300,00'),
(23, 'Intense', 'Kenzo', 45, '230,00'),
(24, 'Naturals', 'Natura', 30, '5,00'),
(25, 'Lírio Azul', 'Giorno Bagno', 120, '6,00'),
(26, 'Encanto', 'Avon', 80, '5,00'),
(27, 'Toque Suave', 'Nivea', 84, '6,00'),
(28, 'Flor de cerejeira', 'Nivea', 90, '4,00'),
(29, 'Flor de Lótus', 'Lux', 90, '3,00'),
(30, 'Botanicals', 'Lux', 56, '3,00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relfornecedorproduto`
--

CREATE TABLE `relfornecedorproduto` (
  `idFornecedor` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `relfornecedorproduto`
--

INSERT INTO `relfornecedorproduto` (`idFornecedor`, `idProduto`) VALUES
(54, 17),
(54, 21),
(54, 24),
(54, 18),
(56, 26),
(57, 29),
(56, 20),
(56, 22),
(57, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sabonetes`
--

CREATE TABLE `sabonetes` (
  `id` int(11) NOT NULL,
  `aroma` varchar(255) NOT NULL,
  `peso` varchar(255) NOT NULL,
  `produtoFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sabonetes`
--

INSERT INTO `sabonetes` (`id`, `aroma`, `peso`, `produtoFK`) VALUES
(1, 'Jasmin e Figo', '30g', 24),
(2, 'Lírios', '35g', 25),
(3, 'Hibisco', '40g', 26),
(4, 'Baunilha', '35g', 27),
(5, 'Cerejas', '40g', 28),
(6, 'Lótus', '40g', 29),
(7, 'Lavanda', '35g', 30);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtoFK` (`produtoFK`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `relfornecedorproduto`
--
ALTER TABLE `relfornecedorproduto`
  ADD KEY `idFornecedor` (`idFornecedor`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices de tabela `sabonetes`
--
ALTER TABLE `sabonetes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtoFK` (`produtoFK`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `sabonetes`
--
ALTER TABLE `sabonetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `perfumes`
--
ALTER TABLE `perfumes`
  ADD CONSTRAINT `perfumes_ibfk_1` FOREIGN KEY (`produtoFK`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `relfornecedorproduto`
--
ALTER TABLE `relfornecedorproduto`
  ADD CONSTRAINT `relfornecedorproduto_ibfk_1` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedores` (`id`),
  ADD CONSTRAINT `relfornecedorproduto_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `sabonetes`
--
ALTER TABLE `sabonetes`
  ADD CONSTRAINT `sabonetes_ibfk_1` FOREIGN KEY (`produtoFK`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
