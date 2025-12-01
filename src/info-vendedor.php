<?php
// Arquivo: info-vendedor.php

require_once './include/conn.php';
// ATENÇÃO: Se seu head.php contém APENAS funções PHP/variáveis, mantenha este require.
// Se seu head.php contém as tags HTML <head> e <body>, remova-o daqui e use as tags HTML abaixo.

$comerciante_id = 0; // Inicializamos com 0 para o caso de erro
$comerciante = false;
$titulo_pagina = "Acesso inválido";
$nome_comerciante = "Acesso inválido";
$tel_comerciante = "-";
$cidade_comerciante = "-";
$estado_comerciante = "-";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $comerciante_id = (int)$_GET['id'];
}

// Verifica se o ID é válido e tenta buscar
if ($comerciante_id > 0) {

    $sql = "SELECT ComercianteID, Nome, Telefone, Cidade, Estado 
            FROM comerciantes 
            WHERE ComercianteID = " . $comerciante_id;

    $retorno = mysqli_query($conn, $sql);

    if ($retorno && mysqli_num_rows($retorno) > 0) {
        $comerciante = mysqli_fetch_assoc($retorno);

        $titulo_pagina = htmlspecialchars($comerciante['Nome']);
        $nome_comerciante = htmlspecialchars($comerciante['Nome']);
        $tel_comerciante = htmlspecialchars($comerciante['Telefone']);
        $cidade_comerciante = htmlspecialchars($comerciante['Cidade']);
        $estado_comerciante = htmlspecialchars($comerciante['Estado']);
    } else {
        // Vendedor não encontrado no banco de dados
        $titulo_pagina = "Vendedor não encontrado";
        $nome_comerciante = "Vendedor não encontrado";
        // Mantém os valores de telefone/localização como "-"
    }
}
// Se $comerciante_id for inválido, os valores padrão de "Acesso inválido" são usados.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="stylesheet" href="./assets/css/info-vendedor.css?v=<?php echo date('YmdHis'); ?>">
</head>
<body>
    <?php 
    // 🚨 INCLUSÃO DO HEADER: Use o caminho correto para o seu menu (header.php)
    // Se seu header.php estiver em include, use:
    // require_once './include/header.php'; 
    ?> 

    <main class="container-vendedor">
        <section class="card-vendedor">
            <h1 class="nome-vendedor"><?php echo $nome_comerciante; ?></h1>

            <?php 
            // Só exibe os detalhes se o vendedor foi encontrado
            if ($comerciante_id > 0 && $nome_comerciante != "Acesso inválido" && $nome_comerciante != "Vendedor não encontrado"): 
            ?>
                <p class="linha-info">
                    <span class="label">Telefone:</span>
                    <a href="tel:<?php echo $tel_comerciante; ?>" class="valor-link">
                        <?php echo $tel_comerciante; ?>
                    </a>
                </p>

                <p class="linha-info">
                    <span class="label">Localização:</span>
                    <span class="valor">
                        <?php echo $cidade_comerciante . " - " . $estado_comerciante; ?>
                    </span>
                </p>

                <p class="texto-ajuda">
                    Entre em contato com o vendedor para combinar retirada, entrega ou tirar dúvidas sobre o produto.
                </p>
            <?php endif; ?>

            <a href="javascript:history.back()" class="btn-voltar">
                Voltar para o produto
            </a>
        </section>
    </main>

    <script src="./assets/js/info-vendedor.js?v=<?php echo date('YmdHis'); ?>"></script>
</body>
</html>