<?php
    include_once './include/conn.php';
    include_once './include/head.php';


    $sql = "SELECT ProdutoID, Nome, Descricao, Preco, Quantidade, Img FROM produtos WHERE ProdutoID = " . $produto_id;
    $retorno = mysqli_query($conn, $sql);

    $nome_comerciante = "Comerciante Exemplo";
    $endereco_comerciante = "Rua Exemplo, 123, Cidade, Estado";
    $img_maps = "https://t2.tudocdn.net/744441?w=824&h=494";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/perfil-comerciante-visualizacao.css">
</head>
<body>
    <main>
        <section class="perfil-comerciante">
            <div class="container-perfil-comerciante">
                <div class="foto-perfil-comerciante">
                    <img src="#" alt="Foto de Perfil do Comerciante">
                </div>
                <div class="informacoes-comerciante">
                    <p><strong>Nome do Comerciante:</strong>
                        <?php
                            echo ($nome_comerciante);
                        ?>
                    </p>
                    <p><strong>Endereço:</strong> Rua Exemplo, 123, Cidade, Estado</p>
                    <div class="container-maps">
                        <img src="https://t2.tudocdn.net/744441?w=824&h=494" alt="">
                    </div>
                    <p><strong>Contato:</strong> (11) 1234-5678</p>
                    <p><strong>Descrição:</strong> Breve descrição sobre o comerciante e seus serviços.</p>
                </div>
            </div>
        </section>
    </main>

    <script src="./assets/js/perfil-comerciante-visualizacao.js"></script>
</body>
</html>