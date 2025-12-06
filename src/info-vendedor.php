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

    $sql = "SELECT ComercianteID, Nome, Telefone, Cidade, Estado, Cnpj, ImagemPerfil, Email, IframeLocal
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
        $cnpj_comerciante = htmlspecialchars($comerciante['Cnpj']);
        $imagemPerfil_comerciante = htmlspecialchars($comerciante['ImagemPerfil']);
        $email_comerciante = htmlspecialchars($comerciante['Email']);
        $iframeLocal_comerciante = htmlspecialchars($comerciante['IframeLocal']);


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
        include_once './include/conn.php';
        include_once './include/head.php';
    ?>
    <main class="container-vendedor">
        <section class="card-vendedor">
            <h1 class="nome-vendedor"><strong> Informações do vendedor</strong></h1>
            <h2 class="nome-vendedor"><?php echo $nome_comerciante; ?></h2>
            <?php 
            if($cnpj_comerciante == 1){
                echo '
                <p class="linha-info">
                    <span class="label">Telefone:</span>
                    <a href="tel:'.$tel_comerciante.'" class="valor-link">
                         '. $tel_comerciante.'
                    </a>
                </p>

                <p class="linha-info">
                    <span class="label">Email:</span>
                    <a href="tel:'.$email_comerciante.'" class="valor-link">
                        '.$email_comerciante.'
                    </a>
                </p>

                <p class="linha-info">
                    <iframe src="'.$iframeLocal_comerciante.'" frameborder="0"></iframe>
                </p>

                <p class="texto-ajuda">
                    Entre em contato com o vendedor para combinar retirada, entrega ou tirar dúvidas sobre o produto.
                </p>
                
                <a href="javascript:history.back()" class="btn-voltar">
                    Voltar para o produto
                </a>';
            }
            
            else{
                echo '<div>
                    <img src="'.$imagemPerfil_comerciante.'" alt="Foto de perfil do vendedor" class="foto-perfil-vendedor">
                </div>
                <p class="linha-info">
                    <span class="label">Telefone:</span>
                    <a href="tel:'.$tel_comerciante.'" class="valor-link">
                         '. $tel_comerciante.'
                    </a>
                </p>

                <p class="linha-info">
                    <span class="label">Email:</span>
                    <a href="tel:'.$email_comerciante.'" class="valor-link">
                        '.$email_comerciante.'
                    </a>
                </p>

                <p class="linha-info">
                    <span class="label">Localização:</span>
                    <a href="">'.$estado_comerciante.'/ '. $cidade_comerciante.'</a>
                </p>

                <p class="texto-ajuda">
                    Entre em contato com o vendedor para combinar retirada, entrega ou tirar dúvidas sobre o produto.
                </p>
                
                <a href="javascript:history.back()" class="btn-voltar">
                    Voltar para o produto
                </a>';
            }?>
        </section>
    </main>

    <script src="./assets/js/info-vendedor.js?v=<?php echo date('YmdHis'); ?>"></script>
</body>
</html>
