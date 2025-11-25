<?php
    include_once './include/conn.php';
    session_start();

    if (!isset($_SESSION['CnpjID']) || !is_numeric($_SESSION['CnpjID'])) {
        die("Acesso não autorizado.");
    }
    $cnpj_id = (int) $_SESSION['CnpjID'];

    $sql = "SELECT Nome, Telefone, Email, Endereco, ImagemPerfil, ImagemLocal, CEP FROM cnpj WHERE CnpjID = " . $cnpj_id;
    $retorno = mysqli_query($conn, $sql);

    if($retorno && mysqli_num_rows($retorno) > 0) {        
        $produto = mysqli_fetch_assoc($retorno);
    
        $nome_cnpj = htmlspecialchars($produto['Nome']);
        $email_cnpj = htmlspecialchars($produto['Email']);
        $endereco_cnpj = htmlspecialchars($produto['Endereco']);
        $img_local_cnpj = htmlspecialchars($produto['ImagemLocal']);
        $img_perfil_cnpj = htmlspecialchars($produto['ImagemPerfil']);
        $telefone_cnpj = htmlspecialchars($produto['Telefone']);
        $cep_cnpj = htmlspecialchars($produto['CEP']);
    } else {
        $nome_cnpj = "Foto não Disponível";
        $email_cnpj = "Email não disponível";
        $endereco_cnpj = "Endereço não disponível";
        $img_perfil_cnpj = "Imagem Perfil não disponível";
        $img_local_cnpj = "Local não disponível";
        $telefone_cnpj = "Telefone não disponível";
        $cep_cnpj = "CEP não disponível";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/perfil-empresa-visualizacao.css">
</head>
<body>
    <main>
        <section class="perfil-comerciante">
            <div class="container-perfil-comerciante">

                <div class="foto-perfil-comerciante">
                    <img class="img-perfil" src="<?php echo ($img_perfil_cnpj ? './uploads/' . $img_perfil_cnpj : './assets/img/default-profile.png'); ?>" alt="Foto de Perfil do Comerciante">
                </div>

                <div class="informacoes-comerciante">

                    <p><strong>Nome da Empresa:</strong>
                        <?php
                            echo ($nome_cnpj);
                        ?>
                    </p>   
                    
                    <p><strong>CEP:</strong>
                        <?php
                            echo ($cep_cnpj);
                        ?>
                    </p>

                    <p><strong>Endereço:</strong>
                        <?php
                            echo ($endereco_cnpj);
                        ?>
                    </p>
                    <div class="container-maps">
                        <img class="img-maps" src="<?php echo ($img_local_cnpj ? './uploads/' . $img_local_cnpj : './assets/img/default-local.png'); ?>" alt="Local da empresa">
                    </div>
                    <p><strong>Telefone:</strong>
                        <?php
                            echo ("$telefone_cnpj");
                        ?>
                    </p>

                    <p><strong>Email:</strong>
                        <?php
                            echo ("$email_cnpj");
                        ?>
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script src="./assets/js/perfil-empresa-visualizacao.js"></script>
</body>
</html>