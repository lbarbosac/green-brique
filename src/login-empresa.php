<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Login Comerciante</title>
    <link rel="stylesheet" href="./assets/css/pagina-login-comerciante.css">
    <link rel="icon" href="../img/pagelines-brands-solid-full.svg">
</head>
<body>
    <main>
        <form action="./act/empresa-login.php" method="post">
            <div class="box-logo">
                <img src="./img/logo-png.png" alt="" style="height: 8rem;">
                <span class="texto-logo" style="font-size: 2rem;">Green Brique</span>
            </div>
            <div class="div-label">
                <label for="nome_user">Nome da Empresa</label>
                <div class="input-box">
                    <input type="text" placeholder="Ex: miguelnaiba" name="nome_user" required>
                </div>
            </div>
            <div class="div-label">
                <label for="senha">Senha</label>
                <div class="input-box">
                    <input id="senha" type="password" placeholder="Ex: 2121" name="senha" required>
                    <i id="btnVerSenha" class="fa-solid fa-eye-slash" style="margin-right: 0.5rem;"></i>
                </div>
            </div>
            <button type="submit">Logar</button>
        </form>
    </main>
    <script src="./assets/js/pagina-login-comerciante.js"></script>
    <script src="https://kit.fontawesome.com/a0cfbec9a7.js" crossorigin="anonymous"></script>
</body>
</html>