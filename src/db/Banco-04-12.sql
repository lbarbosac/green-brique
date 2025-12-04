-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2025 às 13:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
  `Senha` varchar(255) NOT NULL,
  `Telefone` text NOT NULL,
  `Cidade` varchar(255) NOT NULL,
  `Estado` varchar(255) NOT NULL,
  `Cnpj` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comerciantes`
--

INSERT INTO `comerciantes` (`ComercianteID`, `Nome`, `Senha`, `Telefone`, `Cidade`, `Estado`, `Cnpj`) VALUES
(1, 'avilazdudu', '$2y$10$KfD5ox9.XVjzac4Sq5hTgOy5wbsepFznqzVePo6EhIccptfFncudy', '51992774490', 'Porto Alegre', 'Rio Grande do Sul', 1),
(2, 'miguelraba', '$2y$10$p3BpINJi.Drv57aaqSWCp.FsVIUmZhoFkMYy7xSz5d8LC3YZPjeA2', '51989274040', 'Canoas', 'Rio Grande do Sul', 0),
(3, 'cassiano_ramos', '$2y$10$9AfWA5EyIgyiOd56b.RBUe3INtFm9phXReNBxxlyO4OkMi4/9ry.C', '54909274390', 'Porto Alegre', 'Rio Grande do Sul', 0);

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
  `Img` varchar(500) DEFAULT NULL,
  `ComercianteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`ProdutoID`, `Nome`, `Descricao`, `Preco`, `Quantidade`, `Img`, `ComercianteID`) VALUES
(1, 'Kit de Talheres de Bambu Reutilizável com Estojo', 'Conjunto portátil de talheres 100% bambu, material biodegradável e renovável. Ideal para reduzir o uso de plástico descartável em refeições fora de casa.', 45.90, 150, 'https://cdn.leroymerlin.com.br/products/kit_de_talheres_reutilizaveis_de_fibra_de_bambu_com_estojo_1567413877_479c_600x600.jpg', 1),
(2, 'Kit Limpeza Ecológico Concentrado (Refil)', 'Contém 3 refis de cápsulas concentradas de limpeza multiuso e desinfetante. Reduz o consumo de plástico e as emissões de transporte de água. Certificado Vegan.', 89.90, 90, 'https://www.atlantikos.com.br/wp-content/uploads/2022/06/KIT-LIMPEZA-GERAL.jpg', 1),
(3, 'Copo Retrátil de Silicone 500ml (Zero Desperdício)', 'Feito de silicone de grau alimentício, livre de BPA. Perfeito para café e bebidas frias, substituindo copos descartáveis. Dobrável e fácil de transportar.', 55.00, 220, 'https://www.regalobrindes.com.br/content/interfaces/cms/userfiles/produtos/copo-retratil-500ml-5839.jpg', 1),
(4, 'Escova de Dentes de Bambu (Kit 4 unidades)', 'Cabo 100% biodegradável e cerdas macias. Embalagem zero plástico.', 32.50, 300, 'https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/plr/plr65317/y/20.jpg', 1),
(5, 'Shampoo Sólido de Alecrim (50g)', 'Produto concentrado, natural, vegano, sem sulfatos e sem embalagem plástica.', 45.90, 150, 'https://cdn.awsli.com.br/2/2987/produto/174762031/683d09ef3f.jpg', 1),
(6, 'Condicionador Sólido de Manteiga de Cacau', 'Hidratação profunda com ingredientes orgânicos, zero waste.', 49.90, 120, 'https://cdn.awsli.com.br/2500x2500/1380/1380727/produto/85567994/1629bd2cd5.jpg', 1),
(7, 'Desodorante Natural em Pasta (Livre de Alumínio)', 'Fórmula com óleos essenciais, controla o odor sem agredir a pele. Em pote de vidro.', 38.00, 180, 'https://tfddmr.vtexassets.com/arquivos/ids/158647/1.jpg?v=638695386644600000', 1),
(8, 'Fio Dental Biodegradável (Embalagem Refil)', 'Feito de seda de milho, embalado em pote de vidro com refil.', 25.00, 250, 'https://images.tcdn.com.br/img/img_prod/588991/fio_dental_ecologico_de_milho_ou_carvao_ativado_30m_com_embalagem_reutilizavel_de_vidro_3925_1_43647b6eed16313dcb14f1688b5a742b_20220311090535.jpg', 1),
(9, 'Sabonete Artesanal de Argila Verde', 'Feito à mão com ingredientes naturais, ideal para peles oleosas, embalado em papel reciclado.', 18.90, 400, 'https://cdn.sistemawbuy.com.br/arquivos/2be324da38526ac2f0c91d3dfb8211f5/produtos/TAE2MUA7/20220727033406-62e0dc5e99898.jpg', 1),
(10, 'Absorvente Ecológico Reutilizável (Kit 3 un.)', 'Feito de tecido de algodão orgânico, lavável e durável.', 65.00, 100, 'https://www.drogaraia.com.br/_next/image?url=https%3A%2F%2Fproduct-data.raiadrogasil.io%2Fimages%2F3511852.webp&w=3840&q=40', 1),
(11, 'Pente de Madeira Natural (Antiestático)', 'Feito de madeira certificada (reflorestamento), sem plástico, reduz o frizz.', 22.90, 200, 'https://images.tcdn.com.br/img/img_prod/1076196/pentes_de_madeira_com_cabo_redondo_57_2_db6a6427e3dff4d4b99fd8969326b071.jpg', 2),
(12, 'Escalda Pés de Sal Marinho e Ervas', 'Produto 100% natural, embalagem de papel kraft compostável.', 35.00, 160, 'https://cdn.vnda.com.br/1000x/flaviaaranha2022/2022/10/27/11_10_2_241_FLAVIAARANHA_FLORA_11593.jpg?v=1666881520', 2),
(13, 'Óleo Essencial de Lavanda (Orgânico)', 'Produto puro, extraído de fazenda orgânica, embalagem de vidro âmbar.', 59.90, 130, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8ZgbzVojf7q9GoD60_2SVU3Odz5U9sLQV7g&s', 2),
(14, 'Esponja Vegetal de Bucha (Kit 3 un.)', 'Alternativa 100% natural e compostável para esponjas sintéticas de louça.', 19.90, 500, 'https://http2.mlstatic.com/D_NQ_NP_738718-MLB84051229725_042025-O-3-unidades-bucha-vegetal-oval-para-banho-dupla-face-esponja.webp', 2),
(15, 'Pano de Prato de Algodão Cru (Sustentável)', 'Tecido absorvente e durável, tingimento natural, sem químicos.', 15.00, 600, 'https://cdn.awsli.com.br/800x800/1274/1274074/produto/78721775/pano-de-prato-itatex-a-com-bainha-estampado-100-algodao-45x75cm-affe56d9.jpg', 2),
(16, 'Filtro de Café Reutilizável de Pano', 'Alternativa sustentável e durável aos filtros de papel descartáveis.', 28.00, 250, 'https://img.elo7.com.br/product/main/29A06B1/filtro-cafe-reutilizavel-filtro-tecido.jpg', 2),
(17, 'Recipiente de Armazenamento de Vidro (Hermético)', 'Pote de vidro com tampa de bambu, ideal para organização e redução de plástico.', 40.50, 210, 'https://spicy.vtexassets.com/arquivos/ids/237842-800-auto?v=638652917807470000&width=800&height=auto&aspect=true', 2),
(18, 'Canudo de Aço Inoxidável (Kit 4 un. + escova)', 'Durável, reutilizável, perfeito para substituir canudos de plástico.', 34.90, 350, 'https://cdn.awsli.com.br/600x700/1553/1553512/produto/145721187290f327f7c.jpg', 2),
(19, 'Vela Aromática em Cera de Soja (Natural)', 'Feita com cera de soja (vegetal), pavio de algodão e pote reutilizável.', 60.00, 140, 'https://img.elo7.com.br/product/zoom/35E8740/vela-aromatica-em-cera-de-soja-com-base-em-cimento-azul-cera-vegetal.jpg', 2),
(20, 'Sacola Reutilizável de Algodão Orgânico', 'Grande capacidade, forte e lavável, ideal para compras de mercado.', 24.90, 700, 'https://images.tcdn.com.br/img/img_prod/604546/ecobag_sacola_100_algodao_cru_agora_sou_eco_media_1281_1_9e9b6bf5e238586371f9cf21a10ffcc5.jpg', 2),
(21, 'Kit Garrafa + Copo Retrátil (Zero Plástico)', 'Garrafa de vidro com capa de silicone e copo dobrável para viagens.', 95.00, 80, 'https://lojabagaggio.vtexassets.com/arquivos/ids/2368765/0160821458001---KIT-MODERNO-COPO----GARRAFA--PRETO-U--1-.jpg?v=638866321942800000', 3),
(22, 'Composteira Doméstica Pequena', 'Recipiente para reciclagem de lixo orgânico em casa.', 180.00, 50, 'https://images.tcdn.com.br/img/img_prod/1136698/composteira_humi_90l_kit_compostagem_kit_rodizios_841_variacao_629_1_c99f503aef9b9f653d0e2882144ade6b.jpg', 3),
(23, 'Detergente para Louças em Barra (Bio)', 'Produto concentrado, biodegradável, rende muito e não polui a água.', 29.90, 280, 'https://images.tcdn.com.br/img/img_prod/1165139/180_shampoo_hidratante_em_barra_80g_25_1_c121874f36606cdc69c936985400f0d5.png', 3),
(24, 'Camiseta Básica de Algodão Orgânico (Unissex)', 'Algodão 100% orgânico, cultivado sem pesticidas, certificado GOTS.', 79.90, 300, 'https://cdn.awsli.com.br/600x700/751/751979/produto/29909429/camiseta-basica-masculina-preta-algodao-homem-1-nt1r05773k.jpg', 3),
(25, 'Meias de Fibra de Bambu (Respirável)', 'Material natural, macio, antibacteriano e de crescimento rápido (sustentável).', 39.90, 450, 'https://images.tcdn.com.br/img/img_prod/554415/meia_unissex_com_cano_baixo_fibras_de_bambu_centope_69040_2_ed60d54b8b8c7fd1e60ce2573d1f55d7.jpg', 3),
(26, 'Ecobag Grande com Alça Reforçada', 'Feita de lona reciclada, estampa minimalista, perfeita para o dia a dia.', 27.50, 550, 'https://images.tcdn.com.br/img/img_prod/651701/sacola_ecobag_de_lona_crua_alca_reforcada_2820_2_f6786fd6ce892469ebcffae687f82919.jpg', 3),
(27, 'Carteira de Cortiça Vegana (Slim)', 'Material sustentável, leve, durável e 100% livre de crueldade animal.', 85.00, 120, 'https://http2.mlstatic.com/D_NQ_NP_655293-CBT80177620357_102024-O-carteira-de-cortica-feminina-vegan-slim-para-cartoes-notas.webp', 3),
(28, 'Tênis Sustentável de PET Reciclado', 'Cabedal feito a partir de garrafas PET recicladas e sola de borracha natural.', 289.00, 90, 'https://ciclovivo.com.br/wp-content/uploads/2021/08/picadilly-tenis-garrafa-pet-rosa.jpg', 3),
(29, 'Óculos de Sol com Armação de Madeira', 'Armação feita de bambu, leve e flutuante, lentes polarizadas com proteção UV.', 149.00, 70, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5JPZjjAUBiyFYKnSqV4pFlQyZ7hGS9ifmLQ&s', 3),
(30, 'Embalagem de Cera de Abelha (Substitui Plástico Filme)', 'Pano encerado e reutilizável para embalar alimentos, lavável.', 36.00, 150, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbtt3YB4gCYtAOsOSDWWFF-gV6-m7l1kk88A&s', 3),
(31, 'Camiseta Orgânica', 'Camiseta 100% algodão orgânico, produzida de forma sustentável', 89.90, 40, 'https://images.tcdn.com.br/img/img_prod/497460/camiseta_organic_1215_1_f81db6b5c00e05dcd542ca2e825ce24b_20251104171916.jpg', 3),
(32, 'Calça Jeans Reciclada', 'Calça jeans feita a partir de tecido reciclado, estilo moderno e sustentável', 159.90, 25, 'https://i.etsystatic.com/50193901/r/il/6e9205/7126535081/il_570xN.7126535081_jchs.jpg', 3);

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
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ProdutoID`),
  ADD KEY `fk_comerciante` (`ComercianteID`);

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
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ProdutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `SubcategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_comerciante` FOREIGN KEY (`ComercianteID`) REFERENCES `comerciantes` (`ComercianteID`);

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
