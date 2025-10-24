<?php 
include_once './include/conn.php';
include_once './include/head.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/page-produtos.css?v=<?php echo date("YmdHis").rand(0,9999999);?>">
</head>
<body>
    <header>
        
    </header>

    <aside>
        <img src="#" alt="">
        <nav>
            <h2 class="nav-title">Filtros:</h2>
            <ul id="container-filtros">
                <li class="filtros">
                    <div class="filtro">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span>Todos</span>
                    </div>
                </li>
                <li class="filtros">
                    <div class="filtro">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span>Roupas</span>
                    </div>
                </li>
                <li class="filtros">
                    <div class="filtro">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span>Utensílios</span>
                    </div>
                </li>
                <li class="filtros">
                    <div class="filtro">
                        <i class="fa-solid fa-arrow-trend-up"></i>
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
                echo '
                <a href="./info-produto.php" class="container-produto">
                    <div class="container-image-produto">
                        <img src="'.$linha['Img'].'" alt="Produto" class="image-produto">
                    </div>
                    <div class="container-nome-produto">
                        <h2 class="nome-produto">'.$linha['Nome'].'</h2>
                    </div>
                    <div class="container-descricao-produto">
                        <h3 class="descricao-produto">'.$linha['Descricao'].'</h3>
                    </div>
                    <div class="container-preco-produto">
                        <h2 class="preco-produto">R$ '.$linha['Preco'].'</h2>
                    </div>
                   
                </a>';
            }
        } else {
            echo "<p>Nenhum produto encontrado.</p>";
        }
        ?>   
            
        <script src="./assets/js/page-produtos.js"></script>
    </main>
</body>
</html>