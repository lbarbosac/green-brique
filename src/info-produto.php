<?php
// Arquivo: info-produto.php
 
require_once './include/conn.php';
require_once './include/head.php';
 
$produto_id = 0;
$produto = false;
$comerciante_id = 0;
$nomeVendedor = 'Vendedor não informado';
$titulo_pagina = "Acesso Inválido";
$img_url = "./assets/img/erro.png";
$nome_produto = "Acesso Inválido";
$descricao_produto = "O ID do produto está faltando na URL, é inválido ou igual a zero.";
$preco_formatado = "0,00";
$quantidade_estoque = 0;
 
 
// 1. Captura e Validação do ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produto_id = (int)$_GET['id'];
}
 
// 2. Condição para Execução da Consulta e Atribuição de Dados
if ($produto_id > 0) {
    // SQL: Seleciona todos os dados do produto, INCLUINDO o ComercianteID.
    $sql = "SELECT ProdutoID, Nome, Descricao, Preco, Quantidade, Img, ComercianteID
            FROM produtos
            WHERE ProdutoID = " . $produto_id;
    $retorno = mysqli_query($conn, $sql);
 
    if ($retorno && mysqli_num_rows($retorno) > 0) {
        $produto = mysqli_fetch_assoc($retorno);
       
        // Obtendo o ComercianteID para o link
        $comerciante_id = (int)$produto['ComercianteID'];
       
        // Busca o nome do vendedor para exibição no produto (Melhoria UX)
        $sql_vendedor = "SELECT Nome FROM comerciantes WHERE ComercianteID = " . $comerciante_id;
        $retorno_vendedor = mysqli_query($conn, $sql_vendedor);
        if ($retorno_vendedor && mysqli_num_rows($retorno_vendedor) > 0) {
            $nomeVendedor = htmlspecialchars(mysqli_fetch_assoc($retorno_vendedor)['Nome']);
        }
 
        // Atribuição de variáveis do produto
        $titulo_pagina = htmlspecialchars($produto['Nome']);
        $img_url = htmlspecialchars($produto['Img']);
        $nome_produto = htmlspecialchars($produto['Nome']);
        $descricao_produto = htmlspecialchars($produto['Descricao']);
        $preco_formatado = number_format((float)$produto['Preco'], 2, ',', '.');
        $quantidade_estoque = (int)$produto['Quantidade'];
 
    } else {
        // Produto Não Encontrado
        $titulo_pagina = "Produto Não Encontrado";
        $img_url = "./assets/img/produto_padrao.png";
        $nome_produto = "Produto Não Encontrado";
        $descricao_produto = "O produto com ID **#{$produto_id}** não existe ou foi removido.";
        $preco_formatado = "0,00";
        $quantidade_estoque = 0;
    }
}
// Se $produto_id for inválido (<= 0), os valores padrão de "Acesso Inválido" são usados.
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="stylesheet" href="./assets/css/info-produto.css?v=<?php echo date("YmdHis"); ?>"/>
</head>
<body>
    <?php
    // Assumindo que você tem um header.php com a navegação.
    // require_once './include/header.php';
    ?>
   
    <main class="container">
        <aside id="infos-produto">
            <figure class="imagem-produto-container">
                <img src="<?php echo $img_url; ?>" alt="<?php echo $nome_produto; ?>" class="imagem-produto">
            </figure>
            <section class="info-produto">
                <h2 class="nome-produto"><?php echo $nome_produto; ?></h2>
                <p class="descricao-produto"><?php echo $descricao_produto; ?></p>
           
                <p><strong>Estoque:</strong> <?php echo $quantidade_estoque > 0 ? $quantidade_estoque . ' unidades' : 'Esgotado'; ?></p>
           
                <a href="info-vendedor.php?id=<?php echo $comerciante_id; ?>"
                id="info-vendedor"
                class="link-acao">
                Informações do vendedor
                </a>
 
            </section>
        </aside>
       
        <aside class="controles">
            <div class="preco-e-btn-salvar">
                <div class="preco">R$ <?php echo $preco_formatado; ?></div>
                <button id="btn-salvar-produto" class="btn-salvar"
                title="Salvar produto" aria-label="Salvar este produto">
                    <i class="fa-regular fa-bookmark" id="icone-salvo"></i>
                </button>
            </div>
            <div id="chats">  
                <p class="vendedor-por">Vendido por: **<?php echo $nomeVendedor; ?>**</p>
            </div>
            <button id="botao-chat" class="btn-chamar-vendedor"
                    data-produto-id="<?php echo $produto_id; ?>">
                Este produto está disponível?
            </button>
        </aside>
    </main>
    <script src="./assets/js/info-produto.js?v=<?php echo date("YmdHis"); ?>"></script>
</body>
</html>
 