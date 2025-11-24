<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Brique</title>
    <link rel="stylesheet" href="./assets/css/cadastro-empresa.css">
</head>
<body>
    <?php
    include_once './include/head.php';
    ?>
    <form action="./act/empresa.php" method="post">
    <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id">
            <h2 id="form-title">Cadastro de Empresa</h2>
            
            <div class="div-form">
                <label for="cnpj-empresa" class="form-label">CNPJ da Empresa</label>
                <input id="cnpj-empresa" class="form-input" type="text" name="cnpj-empresa" placeholder="CNPJ da Empresa" required>
            </div>

            <div class="div-form">
                <label for="nome-empresa" class="form-label">Nome da Empresa</label>
                <input id="nome-empresa" class="form-input" type="text" name="nome-empresa" placeholder="Nome da Empresa" required>
            </div>

            <div class="div-form">
                <label for="email-empresa" class="form-label">Email da Empresa</label>
                <input id="email-empresa" class="form-input" type="email" name="email-empresa" placeholder="Email da Empresa" required>
            </div>

            <div class="div-form">
                <label for="endereco-empresa" class="form-label">Endereço Comercial</label>
                <input id="endereco-empresa" class="form-input" type="text" name="endereco-empresa" placeholder="Endereço Comercial" required>
            </div>

            <div class="div-form">
                <label for="cep-empresa" class="form-label">CEP</label>
                <input id="cep-empresa" class="form-input" type="text" name="cep-empresa" placeholder="CEP" required>
            </div>

            <div class="div-form">
                <label for="telefone-empresa" class="form-label">Telefone</label>
                <input id="telefone-empresa" class="form-input" type="text" name="telefone-empresa" placeholder="Telefone" required>
            </div>

            <div class="div-form">
                <label for="img-perfil-empresa" class="form-label">Imagem de Perfil</label>
                <input id="img-perfil-empresa" class="form-input" type="text" name="img-perfil-empresa" placeholder="URL da Imagem de Perfil" required>
            </div>

            <div class="div-form">
                <label for="img-local-empresa" class="form-label">Imagem do Local</label>
                <input id="img-local-empresa" class="form-input" type="text" name="img-local-empresa" placeholder="URL da Imagem do Local" required>
            </div>

            <div class="div-form">
                <label for="senha-empresa" class="form-label">Senha</label>
                <input id="senha-empresa" class="form-input" type="password" name="senha-empresa" placeholder="Senha" required>
            </div>

            <div class="div-form">
                <label for="confirmar-senha-empresa" class="form-label">Confirmar Senha</label>
                <input id="confirmar-senha-empresa" class="form-input" type="password" name="confirmar-senha-empresa" placeholder="Confirmar Senha" required>
            </div>
            
            <button id="submit-button" type="submit">Cadastrar Empresa</button>
    </form>
</body>
</html>