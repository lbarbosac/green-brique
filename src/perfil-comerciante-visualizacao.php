<?php
    include_once './include/conn.php';
    include_once './include/head.php';


    $sql = "SELECT Nome, Telefone, Endereco,Foto, Maps,Telefone FROM comerciantes WHERE ComercianteID = " . $comerciante_id;
    $retorno = mysqli_query($conn, $sql);

    if($retorno && mysqli_num_rows($retorno) > 0) {
        $produto = mysqli_fetch_assoc($retorno);
        
        $foto_comerciante = htmlspecialchars($produto['Foto']);
        $nome_comerciante = htmlspecialchars($produto['Nome']);
        $endereco_comerciante = htmlspecialchars($produto['Endereco']);
        $img_maps_comerciante = htmlspecialchars($produto['Maps']);
        $telefone_comerciante = htmlspecialchars($produto['Telefone']);
    } else {
        $foto_comerciante = "Foto não Disponível";
        $nome_comerciante = "Comerciante não Encontrado";
        $endereco_comerciante = "Endereço não Disponível";
        $img_maps_comerciante = "Localização não Disponível";
        $telefone_comerciante = "Contato não Disponível";
    }
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
                    <img class="img-perfil" src="<?php echo ($foto_comerciante)?>" alt="Foto de Perfil do Comerciante">
                </div>

                <div class="informacoes-comerciante">
                    <p><strong>Nome do Comerciante:</strong>
                        <?php
                            echo ($nome_comerciante);
                        ?>
                    </p>

                    <p><strong>Endereço:</strong>
                        <?php
                            echo ($endereco_comerciante);
                        ?>
                    </p>
                    <div class="container-maps">
                        <img class="img-maps" src="<?php echo ($img_maps_comerciante); ?>" alt="Mapa do comerciante">
                    </div>
                    <p><strong>Contato:</strong>
                        <?php
                            echo ("$telefone_comerciante");
                        ?>
                    </p>
                </div>
            </div>
        </section>
    </main>

    <script src="./assets/js/perfil-comerciante-visualizacao.js"></script>
</body>
</html>