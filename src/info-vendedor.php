<?php
include_once './include/conn.php';
include_once './include/head.php';

$comerciante_id = null;
$comerciante    = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $comerciante_id = (int)$_GET['id'];
}

if ($comerciante_id !== null && $comerciante_id > 0) {

    $sql = "SELECT ComercianteID, Nome, Telefone, Cidade, Estado 
            FROM comerciantes 
            WHERE ComercianteID = " . $comerciante_id;

    $retorno = mysqli_query($conn, $sql);

    if ($retorno && mysqli_num_rows($retorno) > 0) {
        $comerciante = mysqli_fetch_assoc($retorno);

        $titulo_pagina     = htmlspecialchars($comerciante['Nome']);
        $nome_comerciante  = htmlspecialchars($comerciante['Nome']);
        $tel_comerciante   = htmlspecialchars($comerciante['Telefone']);
        $cidade_comerciante= htmlspecialchars($comerciante['Cidade']);
        $estado_comerciante= htmlspecialchars($comerciante['Estado']);
    } else {
        $titulo_pagina      = "Vendedor não encontrado";
        $nome_comerciante   = "Vendedor não encontrado";
        $tel_comerciante    = "-";
        $cidade_comerciante = "-";
        $estado_comerciante = "-";
    }
} else {
    $titulo_pagina      = "Acesso inválido";
    $nome_comerciante   = "Acesso inválido";
    $tel_comerciante    = "-";
    $cidade_comerciante = "-";
    $estado_comerciante = "-";
}
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
    <?php include './header.php'; ?> 

    <main class="container-vendedor">
        <section class="card-vendedor">
            <h1 class="nome-vendedor"><?php echo $nome_comerciante; ?></h1>

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

            <a href="javascript:history.back()" class="btn-voltar">
                Voltar para o produto
            </a>
        </section>
    </main>

    <script src="./assets/js/info-vendedor.js?v=<?php echo date('YmdHis'); ?>"></script>
</body>
</html>
