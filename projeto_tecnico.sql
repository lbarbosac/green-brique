-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2025 às 12:50
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
-- Banco de dados: `projeto_tecnico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comerciantes`'
--

CREATE TABLE `comerciantes` (
  `ComercianteID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Telefone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comerciantes`
--

INSERT INTO `comerciantes` (`ComercianteID`, `Nome`, `Senha`, `Email`, `Telefone`) VALUES
(1, 'avilazdudu', '$2y$10$KfD5ox9.XVjzac4Sq5hTgOy5wbsepFznqzVePo6EhIccptfFncudy', '', ''),
(2, 'miguelraba', '$2y$10$p3BpINJi.Drv57aaqSWCp.FsVIUmZhoFkMYy7xSz5d8LC3YZPjeA2', '', ''),
(3, 'cassiano_ramos', '$2y$10$9AfWA5EyIgyiOd56b.RBUe3INtFm9phXReNBxxlyO4OkMi4/9ry.C', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `ProdutoID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Descricao` text DEFAULT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `Quantidade` int(11) DEFAULT 0,
  `Img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`ProdutoID`, `Nome`, `Descricao`, `Preco`, `Quantidade`, `Img`) VALUES
(1, 'Smartphone XZ Pro', 'O mais novo smartphone com 128GB de armazenamento, câmera tripla de 48MP e tela OLED 6.7\". Resistente à água.', 3499.90, 50, 'https://www.havan.com.br/media/catalog/product/cache/73a52df140c4d19dbec2b6c485ea6a50/c/e/celular-smartphone-xiaomi-redmi-note13-4g-octacore-8gb-ram-256gb-ssd_1007650.webp'),
(2, 'Fone de Ouvido Bluetooth Wave', 'Fone de ouvido com cancelamento de ruído ativo, 30 horas de bateria e conexão Bluetooth 5.2. Inclui case de carregamento.', 799.00, 120, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUxQ-pp2SuBenjeJEKqVq1qBYFaIFiy0uOaw&s'),
(3, 'Cafeteira Expressa Grão Mestre', 'Cafeteira automática que mói grãos na hora. Prepara espresso, cappuccino e latte com o toque de um botão. 15 bar de pressão.', 1850.50, 30, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcU-UxtCZNxtD7f7KaNNL4WWs2Q_VjjVyK4Q&s'),
(4, 'Tênis de Corrida Flash 2.0', 'Tênis leve para corrida com solado de alta absorção de impacto e cabedal respirável. Ideal para treinos diários e maratonas.', 449.99, 200, 'https://mizunobr.vtexassets.com/arquivos/ids/252043-800-800?v=638572746155170000&width=800&height=800&aspect=true'),
(5, 'Mochila Executiva Impermeável', 'Mochila com compartimento para notebook de até 15.6\", porta USB para carregador e material impermeável. Múltiplos bolsos.', 289.90, 75, 'https://imaginarium.vtexassets.com/arquivos/ids/10117037/Mochila-Laptop-Basica-Preta-e-Caramelo.jpg?v=638948655654800000'),
(6, 'Jojo\'s Steel Ball Run', 'Um guia sobre as habilidades, conceitos e estratégias para construir uma carreira sólida e bem-sucedida em desenvolvimento de software.', 89.70, 150, 'https://www.americanas.com.br/_next/image?url=https%3A%2F%2Famericanas.vtexassets.com%2Farquivos%2Fids%2F11884394%2F7485631658_1_xlarge.jpg%3Fv%3D638754227714530000&w=768&q=90'),
(7, 'Primo do Japa', 'Japonês da 25 de março.', 999.99, 1, 'https://cinepop.com.br/wp-content/uploads/2017/04/sungkang_1.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_subcategoria`
--

CREATE TABLE `produto_subcategoria` (
  `ProdutoID` int(11) NOT NULL,
  `SubcategoriaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategorias`
--

CREATE TABLE `subcategorias` (
  `SubcategoriaID` int(11) NOT NULL,
  `CategoriaID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subcategorias`
--

INSERT INTO `subcategorias` (`SubcategoriaID`, `CategoriaID`, `Nome`) VALUES
(1, 1, 'Usadas'),
(2, 1, 'Novas'),
(3, 1, 'Em promoção'),
(4, 1, 'Mais Vendidas'),
(5, 2, 'Cozinha'),
(6, 2, 'Limpeza'),
(7, 2, 'Escritório'),
(8, 2, 'Promoção'),
(9, 3, 'Frescos'),
(10, 3, 'Congelados'),
(11, 3, 'Snacks'),
(12, 3, 'Orgânicos');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CategoriaID`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- Índices de tabela `comerciantes`
--
ALTER TABLE `comerciantes`
  ADD PRIMARY KEY (`ComercianteID`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ProdutoID`);

--
-- Índices de tabela `produto_subcategoria`
--
ALTER TABLE `produto_subcategoria`
  ADD PRIMARY KEY (`ProdutoID`,`SubcategoriaID`),
  ADD KEY `SubcategoriaID` (`SubcategoriaID`);

--
-- Índices de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`SubcategoriaID`),
  ADD KEY `CategoriaID` (`CategoriaID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `comerciantes`
--
ALTER TABLE `comerciantes`
  MODIFY `ComercianteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ProdutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8,
  MODIFY `Descricao` TEXT DEFAULT '',
  MODIFY `Img` TEXT DEFAULT NULL;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `SubcategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produto_subcategoria`
--
ALTER TABLE `produto_subcategoria`
  ADD CONSTRAINT `produto_subcategoria_ibfk_1` FOREIGN KEY (`ProdutoID`) REFERENCES `produtos` (`ProdutoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `produto_subcategoria_ibfk_2` FOREIGN KEY (`SubcategoriaID`) REFERENCES `subcategorias` (`SubcategoriaID`) ON DELETE CASCADE;

--
-- Restrições para tabelas `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `categorias` (`CategoriaID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
