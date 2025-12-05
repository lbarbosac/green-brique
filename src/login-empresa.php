<?php
//INSERIR UM IMPUT, VERIFICANDO SE O USURIO E PJ OU PF, CASO SEJA PJ VOLTAR COMO RESPOSTA PRO BANCO 0, CASO CANTRARIO VOLTAR 0
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Login Comerciante</title>
    <link rel="stylesheet" href="./assets/css/login-empresa.css">
    <link rel="icon" href="../img/pagelines-brands-solid-full.svg">
</head>
<body>
    <?php
    include_once './include/head.php';
    ?>
    <main>
        <form action="./act/empresa-login.php" method="post">
            <h2 id="form-title"><strong>Login</strong></h2>
            <div class="div-label">
                <label for="nome_user">Nome do Usuario</label>
                <div class="input-box">
                    <input class="texto-input" type="text" placeholder="Ex: miguelnaiba" name="nome_user" required>
                </div>
            </div>
            <div class="div-label">
                <label for="senha">Senha</label>
                <div class="input-box">
                    <input class="texto-input" id="senha" type="password" placeholder="Ex: 2121" name="senha" required>
                    <i id="btnVerSenha" class="fa-solid fa-eye-slash" style="margin-right: 0.5rem;"></i>
                </div>
            </div>
            <button type="submit">Logar</button>
            <a href="./cadastro-empresa.php" id="link-cad">Não tem cadastro?</a>
        </form>
    </main>
    <script src="./assets/js/pagina-login-comerciante.js"></script>
    <script src="https://kit.fontawesome.com/a0cfbec9a7.js" crossorigin="anonymous"></script>
</body>
</html>