<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Login Comerciante</title>
    <link rel="stylesheet" href="./assets/css/pagina-cadastro-comerciante.css">
    <link rel="icon" href="../img/pagelines-brands-solid-full.svg">
</head>
<body>
    <main>
        <div class="box-logo">
            <img src="../img/logo-png.png" alt="" style="height: 8rem;">
            <span class="texto-logo" style="font-size: 2rem ;">Low Carbo</span>
            <span class="texto-logo" style="font-size: 1.2rem;">Marketplace</span>
        </div>
        <div class="div-label">
            <label for="nome_user">Nome de Usuário</label>
            <div class="input-box">
                <input type="text" placeholder="Ex: miguelnaiba"name="nome_user">
            </div>
        </div>
        <div class="div-label">
            <label for="senha">Senha</label>
            <div class="input-box">
                <input id="senha" type="password" placeholder="Ex: 1109" name="senha">
                <i id="btnVerSenha" class="btn fa-solid fa-eye-slash" style="margin-right: 0.5rem;"></i>
            </div>
        </div>
         <div class="div-label">
            <label for="confirmar_senha">Confirmar Senha</label>
            <div class="input-box">
                <input id="confirmar_senha" type="password" placeholder="Ex: 1109" name="senha">
                <i id="btnVerConfirmarSenha" class="btn fa-solid fa-eye-slash" style="margin-right: 0.5rem;"></i>
            </div>
        </div>
        <button>Cadastrar</button>
    </main>
    <script src="./assets/js/pagina-cadastro-comerciante.js"></script>
    <script src="https://kit.fontawesome.com/a0cfbec9a7.js" crossorigin="anonymous"></script>
</body>
</html>