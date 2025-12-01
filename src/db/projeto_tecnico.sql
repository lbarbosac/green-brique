-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/12/2025 às 13:00
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
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `CategoriaID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`CategoriaID`, `Nome`) VALUES
(3, 'Alimentos'),
(1, 'Roupas'),
(2, 'Utensílios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cnpj`
--

CREATE TABLE `cnpj` (
  `CnpjID` int(11) NOT NULL,
  `Telefone` varchar(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Nome` varchar(225) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `Endereco` varchar(300) NOT NULL,
  `ImagemPerfil` binary(11) NOT NULL,
  `ImagemLocal` varchar(11) NOT NULL,
  `CEP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cnpj`
--

INSERT INTO `cnpj` (`CnpjID`, `Telefone`, `Email`, `Nome`, `Senha`, `Endereco`, `ImagemPerfil`, `ImagemLocal`, `CEP`) VALUES
(1, '21212', '1221@w.com', '221', '$2y$10$MIfFXN2UT2hO5tWGjFCVKu772gwjAaygeGMJKjf57/i3Iep0OG49K', 'saas21', 0x3231323132310000000000, '2121', '2321');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comerciantes`
--

CREATE TABLE `comerciantes` (
  `ComercianteID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comerciantes`
--

INSERT INTO `comerciantes` (`ComercianteID`, `Nome`, `Senha`) VALUES
(1, 'avilazdudu', '$2y$10$KfD5ox9.XVjzac4Sq5hTgOy5wbsepFznqzVePo6EhIccptfFncudy'),
(2, 'miguelraba', '$2y$10$p3BpINJi.Drv57aaqSWCp.FsVIUmZhoFkMYy7xSz5d8LC3YZPjeA2'),
(3, 'cassiano_ramos', '$2y$10$9AfWA5EyIgyiOd56b.RBUe3INtFm9phXReNBxxlyO4OkMi4/9ry.C');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cpf`
--

CREATE TABLE `cpf` (
  `CpfID` int(5) NOT NULL,
  `Nome` int(225) NOT NULL,
  `Telefone` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `ImagemPerfil` binary(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `ProdutoID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Descricao` text DEFAULT NULL,
  `Preco` decimal(10,2) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Img` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`ProdutoID`, `Nome`, `Descricao`, `Preco`, `Quantidade`, `Img`) VALUES
(1, 'Kit de Talheres de Bambu Reutilizável com Estojo', 'Conjunto portátil de talheres 100% bambu, material biodegradável e renovável. Ideal para reduzir o uso de plástico descartável em refeições fora de casa.', 45.90, 150, 'https://images.unsplash.com/photo-1594917631750-618497645f7c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(2, 'Kit Limpeza Ecológico Concentrado (Refil)', 'Contém 3 refis de cápsulas concentradas de limpeza multiuso e desinfetante. Reduz o consumo de plástico e as emissões de transporte de água. Certificado Vegan.', 89.90, 90, 'https://images.unsplash.com/photo-1616480536417-6425150e7b7e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(3, 'Copo Retrátil de Silicone 500ml (Zero Desperdício)', 'Feito de silicone de grau alimentício, livre de BPA. Perfeito para café e bebidas frias, substituindo copos descartáveis. Dobrável e fácil de transportar.', 55.00, 220, 'https://images.unsplash.com/photo-1596701979401-447a2453c07e?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(4, 'Escova de Dentes de Bambu (Kit 4 unidades)', 'Cabo 100% biodegradável e cerdas macias. Embalagem zero plástico.', 32.50, 300, 'https://images.unsplash.com/photo-1542840428-c1729b7ef9fa'),
(5, 'Shampoo Sólido de Alecrim (50g)', 'Produto concentrado, natural, vegano, sem sulfatos e sem embalagem plástica.', 45.90, 150, 'https://images.unsplash.com/photo-1610444156637-233631f4e3c9'),
(6, 'Condicionador Sólido de Manteiga de Cacau', 'Hidratação profunda com ingredientes orgânicos, zero waste.', 49.90, 120, 'https://images.unsplash.com/photo-1610444157111-e12503d52848'),
(7, 'Desodorante Natural em Pasta (Livre de Alumínio)', 'Fórmula com óleos essenciais, controla o odor sem agredir a pele. Em pote de vidro.', 38.00, 180, 'https://images.unsplash.com/photo-1594922119339-38a49c95d909'),
(8, 'Fio Dental Biodegradável (Embalagem Refil)', 'Feito de seda de milho, embalado em pote de vidro com refil.', 25.00, 250, 'https://images.unsplash.com/photo-1591823907718-d7b42a926317'),
(9, 'Sabonete Artesanal de Argila Verde', 'Feito à mão com ingredientes naturais, ideal para peles oleosas, embalado em papel reciclado.', 18.90, 400, 'https://images.unsplash.com/photo-1627915573750-f8f20b33c042'),
(10, 'Absorvente Ecológico Reutilizável (Kit 3 un.)', 'Feito de tecido de algodão orgânico, lavável e durável.', 65.00, 100, 'https://images.unsplash.com/photo-1593952777083-d020e6f21223'),
(11, 'Pente de Madeira Natural (Antiestático)', 'Feito de madeira certificada (reflorestamento), sem plástico, reduz o frizz.', 22.90, 200, 'https://images.unsplash.com/photo-1596701979401-447a2453c07e'),
(12, 'Escalda Pés de Sal Marinho e Ervas', 'Produto 100% natural, embalagem de papel kraft compostável.', 35.00, 160, 'https://images.unsplash.com/photo-1592383845019-3226a275466c'),
(13, 'Óleo Essencial de Lavanda (Orgânico)', 'Produto puro, extraído de fazenda orgânica, embalagem de vidro âmbar.', 59.90, 130, 'https://images.unsplash.com/photo-1587370830704-58a436578a1f'),
(14, 'Esponja Vegetal de Bucha (Kit 3 un.)', 'Alternativa 100% natural e compostável para esponjas sintéticas de louça.', 19.90, 500, 'https://images.unsplash.com/photo-1617478330752-b8833894b9f6'),
(15, 'Pano de Prato de Algodão Cru (Sustentável)', 'Tecido absorvente e durável, tingimento natural, sem químicos.', 15.00, 600, 'https://images.unsplash.com/photo-1594917631750-618497645f7c'),
(16, 'Filtro de Café Reutilizável de Pano', 'Alternativa sustentável e durável aos filtros de papel descartáveis.', 28.00, 250, 'https://images.unsplash.com/photo-1550993072-c23f993d0f41'),
(17, 'Recipiente de Armazenamento de Vidro (Hermético)', 'Pote de vidro com tampa de bambu, ideal para organização e redução de plástico.', 40.50, 210, 'https://images.unsplash.com/photo-1614798579998-380d6f46d328'),
(18, 'Canudo de Aço Inoxidável (Kit 4 un. + escova)', 'Durável, reutilizável, perfeito para substituir canudos de plástico.', 34.90, 350, 'https://images.unsplash.com/photo-1590374169970-877473775f0f'),
(19, 'Vela Aromática em Cera de Soja (Natural)', 'Feita com cera de soja (vegetal), pavio de algodão e pote reutilizável.', 60.00, 140, 'https://images.unsplash.com/photo-1621376044719-798836528d22'),
(20, 'Sacola Reutilizável de Algodão Orgânico', 'Grande capacidade, forte e lavável, ideal para compras de mercado.', 24.90, 700, 'https://images.unsplash.com/photo-1611082163980-87c6a9956426'),
(21, 'Kit Garrafa + Copo Retrátil (Zero Plástico)', 'Garrafa de vidro com capa de silicone e copo dobrável para viagens.', 95.00, 80, 'https://images.unsplash.com/photo-1616480536417-6425150e7b7e'),
(22, 'Composteira Doméstica Pequena', 'Recipiente para reciclagem de lixo orgânico em casa.', 180.00, 50, 'https://images.unsplash.com/photo-1593179069516-e415b3c8f8b8'),
(23, 'Detergente para Louças em Barra (Bio)', 'Produto concentrado, biodegradável, rende muito e não polui a água.', 29.90, 280, 'https://images.unsplash.com/photo-1597022064789-70f2098d5c4b'),
(24, 'Camiseta Básica de Algodão Orgânico (Unissex)', 'Algodão 100% orgânico, cultivado sem pesticidas, certificado GOTS.', 79.90, 300, 'https://images.unsplash.com/photo-1618384218737-293674684534'),
(25, 'Meias de Fibra de Bambu (Respirável)', 'Material natural, macio, antibacteriano e de crescimento rápido (sustentável).', 39.90, 450, 'https://images.unsplash.com/photo-1602495393098-ff231a499a09'),
(26, 'Ecobag Grande com Alça Reforçada', 'Feita de lona reciclada, estampa minimalista, perfeita para o dia a dia.', 27.50, 550, 'https://images.unsplash.com/photo-1549419137-97d54972e3a8'),
(27, 'Carteira de Cortiça Vegana (Slim)', 'Material sustentável, leve, durável e 100% livre de crueldade animal.', 85.00, 120, 'https://images.unsplash.com/photo-1597370830704-58a436578a1f'),
(28, 'Tênis Sustentável de PET Reciclado', 'Cabedal feito a partir de garrafas PET recicladas e sola de borracha natural.', 289.00, 90, 'https://images.unsplash.com/photo-1577747809633-8a3d537d8e6a'),
(29, 'Óculos de Sol com Armação de Madeira', 'Armação feita de bambu, leve e flutuante, lentes polarizadas com proteção UV.', 149.00, 70, 'https://images.unsplash.com/photo-1547432065-1d01f8f3c7d6'),
(30, 'Embalagem de Cera de Abelha (Substitui Plástico Filme)', 'Pano encerado e reutilizável para embalar alimentos, lavável.', 36.00, 150, 'https://images.unsplash.com/photo-1578331326265-d41a8e1b65e2');

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
-- Índices de tabela `cnpj`
--
ALTER TABLE `cnpj`
  ADD PRIMARY KEY (`CnpjID`);

--
-- Índices de tabela `comerciantes`
--
ALTER TABLE `comerciantes`
  ADD PRIMARY KEY (`ComercianteID`);

--
-- Índices de tabela `cpf`
--
ALTER TABLE `cpf`
  ADD PRIMARY KEY (`CpfID`);

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
-- AUTO_INCREMENT de tabela `cnpj`
--
ALTER TABLE `cnpj`
  MODIFY `CnpjID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `comerciantes`
--
ALTER TABLE `comerciantes`
  MODIFY `ComercianteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cpf`
--
ALTER TABLE `cpf`
  MODIFY `CpfID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ProdutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
