
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Login Comerciante</title>
    <link rel="icon" href="../img/pagelines-brands-solid-full.svg">
    <link rel="stylesheet" href="./assets/css/salvar-infos.css">
<?php
include_once './include/logado.php';
include_once './include/conn.php';

// Receba os dados do comerciante via URL
$comerciante_id = isset($_GET['ComercianteID']) ? intval($_GET['ComercianteID']) : 0;
$nome = isset($_GET['Nome']) ? urldecode($_GET['Nome']) : '';
$email = isset($_GET['Email']) ? urldecode($_GET['Email']) : '';
$telefone = isset($_GET['Telefone']) ? urldecode($_GET['Telefone']) : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/pagelines-brands-solid-full.svg">
    <link rel="stylesheet" href="./assets/css/salvar-infos.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include_once './include/head.php';
    ?>
    <main>
        <div class="container">
        <form action="./act/salvar-infos.php" method="post">
            <div class="div-label">
                <label for="nome_user">Nome de Usuário</label>
                <div class="input-box">
                    <input class="input-info" type="text" name="nome_user" required>
                </div>
            </div>

             <!-- Input de Email Adicionado -->
             <div class="div-label">
                <label for="email">Email</label>
                <div class="input-box">
                    <input class="input-info" type="email" id="email" name="email" placeholder="Ex: seuemail@dominio.com" required>
                </div>
            </div>

            <!-- Input de Telefone Adicionado -->
            <div class="div-label">
                <label for="telefone">Telefone</label>
                <div class="input-box">
                    <input class="input-info" type="tel" id="telefone" name="telefone" placeholder="Ex: (11) 98765-4321" required>
                </div>
            </div>
                <button type="submit">Salvar Informações</button>
        </form>
        </div>
    </main>
    <script src="./assets/js/salvar-infos-comerciante.js"></script>
    <script src="https://kit.fontawesome.com/a0cfbec9a7.js" crossorigin="anonymous"></script>
</body>
</html>