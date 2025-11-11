<?php 
include_once './include/conn.php';
include_once './include/head.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Disponíveis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style-crud.css?v=<?php echo date("YmdHis").rand(0,9999999);?>">
    <link rel="stylesheet" href="./assets/css/page-produtos.css?v=<?php echo date("YmdHis").rand(0,9999999);?>">
</head>
<body>
<aside class="scrollable-filters" role="navigation" aria-label="Filtros de produtos">
        <img src="#" alt="Imagem ilustrativa de filtros ambientais">
        <nav>
            <h2 class="nav-title">Filtros:</h2>
            <ul id="container-filtros" role="list">
                <li class="filtros" role="listitem">
                    <div class="filtro" tabindex="0">
                        <i class="fa-solid fa-arrow-trend-up" aria-hidden="true"></i>
                        <span>Todos</span>
                    </div>
                </li>
                <li class="filtros" role="listitem">
                    <div class="filtro" tabindex="0">
                        <i class="fa-solid fa-tshirt" aria-hidden="true"></i>
                        <span>Roupas</span>
                    </div>
                </li>
                <li class="filtros" role="listitem">
                    <div class="filtro" tabindex="0">
                        <i class="fa-solid fa-bowl-food" aria-hidden="true"></i>
                        <span>Utensílios</span>
                    </div>
                </li>
                <li class="filtros" role="listitem">
                    <div class="filtro" tabindex="0">
                        <i class="fa-solid fa-apple-whole" aria-hidden="true"></i>
                        <span>Alimentos</span>
                    </div>
                </li>
            </ul>
        </nav>
    </aside>

    <main>
        <div id="container-produtos">
        <?php
        $sql = "SELECT * FROM produtos";
        $retorno = mysqli_query($conn, $sql);

        if ($retorno && mysqli_num_rows($retorno) > 0) {
            while ($linha = mysqli_fetch_assoc($retorno)) {
                
                $produto_id = htmlspecialchars($linha['ProdutoID']);
                $img_url = htmlspecialchars($linha['Img']);
                $nome_produto = htmlspecialchars($linha['Nome']);
                $descricao_produto = htmlspecialchars($linha['Descricao']);
                $preco_formatado = number_format($linha['Preco'], 2, ',', '.');

                echo '
                <a id="'.$linha['ProdutoID'].'" href="./info-produto.php?id=' . $produto_id . '" class="container-produto">
                    <div class="container-image-produto">
                        <img src="' . $img_url . '" alt="' . $nome_produto . '" class="image-produto">
                    </div>
                    <div class="container-nome-produto">
                        <h2 class="nome-produto">' . $nome_produto . '</h2>
                    </div>
                    <div class="container-descricao-produto">
                        <h3 class="descricao-produto">' . $descricao_produto . '</h3>
                    </div>
                    <div class="container-preco-produto">
                        <h2 class="preco-produto">R$ ' . $preco_formatado . '</h2>
                    </div>
                </a>';
            }
        } else {
            echo "<p class='mensagem-aviso'>Nenhum produto encontrado. Verifique se a tabela 'produtos' está preenchida.</p>";
        }
        ?>  
        </div>
        <script src="./assets/js/page-produtos.js"></script>
    </main>
    <?php 
    include_once './include/footer.php'; 
    ?>
</body>
</html>