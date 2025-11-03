<?php
include_once './include/conn.php';

$produto_id = null;
$produto = false;

// 1. Captura e Validação do ID
// Usando $_GET diretamente, pois confirmamos que ele deve ser a fonte correta.
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produto_id = (int)$_GET['id']; 
}

// 2. Condição para Execução da Consulta e Tratamento de Erro
if ($produto_id !== null && $produto_id > 0) { 
    $sql = "SELECT ProdutoID, Nome, Descricao, Preco, Quantidade, Img FROM produtos WHERE ProdutoID = " . $produto_id;
    $retorno = mysqli_query($conn, $sql);

    if ($retorno && mysqli_num_rows($retorno) > 0) {
        $produto = mysqli_fetch_assoc($retorno);
        
        $titulo_pagina = htmlspecialchars($produto['Nome']);
        $img_url = htmlspecialchars($produto['Img']);
        $nome_produto = htmlspecialchars($produto['Nome']);
        $descricao_produto = htmlspecialchars($produto['Descricao']);
        $preco_formatado = number_format($produto['Preco'], 2, ',', '.');
        $quantidade_estoque = htmlspecialchars($produto['Quantidade']);

    } else {
        // Produto não encontrado no DB
        $titulo_pagina = "Produto Não Encontrado";
        $img_url = "./assets/img/produto_padrao.png";
        $nome_produto = "Produto Não Encontrado";
        $descricao_produto = "O produto com ID **#{$produto_id}** não existe ou foi removido.";
        $preco_formatado = "0,00";
        $quantidade_estoque = "0";
    }
} else {
    // ID ausente, inválido ou zero
    $titulo_pagina = "Acesso Inválido";
    $img_url = "./assets/img/erro.png";
    $nome_produto = "Acesso Inválido";
    $descricao_produto = "O ID do produto está faltando na URL, é inválido ou igual a zero. Por favor, volte e clique em um item da lista.";
    $preco_formatado = "0,00";
    $quantidade_estoque = "0";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="stylesheet" href="./assets/css/info-produto.css"/>
</head>
<body>
    <main class="container">
        <figure class="imagem-produto-container">
            <img src="<?php echo $img_url; ?>" alt="<?php echo $nome_produto; ?>" class="imagem-produto">
        </figure>
        <section class="info-produto">
            <h2 class="nome-produto"><?php echo $nome_produto; ?></h2>
            <p class="descricao-produto"><?php echo $descricao_produto; ?></p>
            
            <p><strong>Estoque:</strong> <?php echo $quantidade_estoque > 0 ? $quantidade_estoque . ' unidades' : 'Esgotado'; ?></p>
            
            <a href="#" id="info-vendedor" class="link-acao">Informações do vendedor</a>
        </section>
        <aside class="controles">
            <div class="preco">R$ <?php echo $preco_formatado; ?></div>
            <h3>Fale com o vendedor via chat</h3>
            <button id="botao-chat" class="btn-primario" 
                    data-produto-id="<?php echo $produto_id ?? ''; ?>">
                Este produto está disponível?
            </button>
            <div class="seletor-quantidade" role="group" aria-label="Selecionar quantidade">
                <button id="diminuir-qtd" aria-label="Diminuir quantidade">−</button>
                <span id="quantidade-valor">1 unidade</span>
                <button id="aumentar-qtd" aria-label="Aumentar quantidade">+</button>
            </div>
        </aside>
    </main>
    <script src="./assets/js/info-produto.js"></script>
</body>
</html>