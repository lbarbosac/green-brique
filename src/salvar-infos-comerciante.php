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
        <div class="user-card">
            <form action="./act/salvar-infos.php" method="post" class="user-form">
                <input type="hidden" name="ComercianteID" value="<?php echo htmlspecialchars($comerciante_id); ?>">
                <div class="form-group">
                    <label for="nome_user" class="form-label">Nome</label>
                    <div class="input-wrapper">
                        <input type="text" name="nome_user" id="nome_user" class="form-input" value="<?php echo htmlspecialchars($nome); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-wrapper">
                        <input placeholder="Ex: seuemail@gmail.com" type="email" name="email" id="email" class="form-input" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefone" class="form-label">Telefone</label>
                    <div class="input-wrapper">
                        <input placeholder="Ex: (XX) XXXXX-XXXX" type="tel" name="telefone" id="telefone" class="form-input" value="<?php echo htmlspecialchars($telefone); ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Salvar Informações</button>
            </form>
        </div>
    </main>
    <script src="./assets/js/salvar-infos-comerciante.js"></script>
    <script src="https://kit.fontawesome.com/a0cfbec9a7.js" crossorigin="anonymous"></script>
</body>
</html>