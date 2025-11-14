-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/11/2025 às 03:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lavic`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` enum('Pendente','Em progresso','A caminho','Entregue') DEFAULT 'Pendente',
  `forma_pagamento` enum('Dinheiro','Débito','Crédito') DEFAULT 'Dinheiro',
  `entrega` enum('Entrega','Retirada') DEFAULT 'Entrega',
  `data_pedido` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `status`, `forma_pagamento`, `entrega`, `data_pedido`, `total`) VALUES
(2, 2, 'Em progresso', 'Dinheiro', 'Entrega', '2025-11-13 17:49:55', 369.93),
(8, 3, 'Pendente', 'Dinheiro', 'Retirada', '2025-11-14 02:04:22', 99.98),
(9, 2, 'Pendente', 'Crédito', 'Entrega', '2025-11-14 02:15:36', 2039.66),
(10, 2, 'Pendente', 'Crédito', 'Retirada', '2025-11-14 02:29:33', 349.94);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido_itens`
--

INSERT INTO `pedido_itens` (`id`, `id_pedido`, `id_produto`, `quantidade`, `preco_unitario`, `subtotal`) VALUES
(3, 2, 1, 5, 49.99, 249.95),
(4, 2, 2, 2, 59.99, 119.98),
(11, 8, 1, 2, 49.99, 99.98),
(12, 9, 2, 34, 59.99, 2039.66),
(13, 10, 1, 1, 49.99, 49.99),
(14, 10, 2, 5, 59.99, 299.95);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Bolo de Chocolate', 'Bolos de Sabores Variáveis', 'Bolo de Chocolate com massa de chocolate, com recheio de chocolate e com cobertura de chocolate.', 49.99, 'uploads/2.jpg'),
(2, 'Bolo Red Velvet', 'Bolos de Sabores Variáveis', 'Popular bolo de cor vermelha com sabor suave de cacau.', 59.99, 'uploads/6.png'),
(3, 'Bolo de Aniversário de Frutas Vermelhas', 'Bolos de Aninversário', 'Recheio de frutas vermelhas.', 59.99, 'uploads/3.jpg'),
(4, 'Bombom Pão de Mel Grande Decorado', 'Decorados e lembrancinhas', 'Pães de Mel deliciosos e decorados.', 5.99, 'uploads/28.jpg'),
(5, 'Brigadeiro de Chocolate Belga ao Leite', 'Docinhos', 'Brigadeiro de Chocolate', 0.75, 'uploads/Brigadeiro chocolate belga ao leite.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('cliente','admin') DEFAULT 'cliente',
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `telefone`, `data_nascimento`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `senha`, `tipo`, `data_cadastro`) VALUES
(1, 'Admin Mestre', 'adminmestre@email.com', '(11) 91234-5678', '2000-12-01', '09876-543', 'Rua do Admin', '123', 'Apto 456', 'Bairro do Admin', 'São Paulo', 'SP', '65b8ecad75f146cffbe8b6d358730f35', 'admin', '2025-11-13 11:42:18'),
(2, 'Josefina', 'clientejosefina@email.com', '(11) 98765-4321', '1945-08-18', '12345-678', 'Rua do Cliente', '321', 'Apto 654', 'Bairro do Cliente', 'São Paulo', 'SP', '8c759280a000d82d47c1a511d0d9dc5c', 'cliente', '2025-11-13 11:46:02'),
(3, 'Vanderlei', 'clientevanderlei@email.com', '(11) 98765-4321', '1944-09-27', '12345-678', 'Rua do Cliente', '321', 'Apto 654', 'Bairro do Cliente', 'São Paulo', 'SP', '8c759280a000d82d47c1a511d0d9dc5c', 'cliente', '2025-11-13 22:03:55');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
