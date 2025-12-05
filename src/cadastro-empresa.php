<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Brique</title>
    
    <link rel="stylesheet" href="./assets/css/login-empresa.css">
    
</head>
<body>
    <?php
    include_once './include/head.php';
    ?>
    <form action="./act/empresa.php" method="post">
    <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id">
            <h2 id="form-title">Cadastro</h2>


            <div class="div-label">
                <label for="nome_empresa">Nome do Usuario</label>
                <div class="input-box">
                    <input id="nome-empresa" class="form-input" type="text" placeholder="Ex: miguelnaiba" name="nome_user" required>
                </div>
            </div>

            <div class="div-label">
                <label for="email-empresa">Email</label>
                <div class ="input-box">
                    <input id="email-empresa" class="form-input" type="email" name="email-empresa" placeholder="Email da Empresa" required>
                </div>
            </div>

            <div class="div-label">
                <label for="telefone-empresa">Telefone</label>
                <div class ="input-box">
                    <input id="telefone-empresa" class="form-input" type="text" name="telefone-empresa" placeholder="Telefone" required>
                </div>
            </div>

            <div class="div-label">
                <label for="img-perfil-empresa" class="form-label">Imagem de Perfil</label>
                <div class ="input-box">
                    <input id="img-perfil-empresa" class="form-input" type="file" name="img-perfil-empresa" placeholder="URL da Imagem de Perfil" required>
                </div>
            </div>

            <div class="div-label">
                <label for="tem-cnpj">CNPJ?</label>
                    <div class="input-box">
                        <input id="tem-cnpj" type="text" placeholder="Sua opção aqui" list="opcoes-do-usuario">
                        <datalist id="opcoes-do-usuario">
                            <option value="Nao"></option>
                            <option value="Sim"></option>
                        </datalist>
                    </div>
            </div>

            <!-- CAMPOS DE CNPJ (ficam escondidos no início) -->
            <div id="campos-cnpj" style="display: none;">
                <div class="div-label">
                    <label for="endereco-empresa">Endereço Comercial</label>
                    <div class="input-box">
                        <input id="endereco-empresa" class="form-input" type="text" name="endereco-empresa" placeholder="Endereço Comercial">
                    </div>
                </div>

                <div class="div-label">
                    <label for="cep-empresa">Iframe Maps</label>
                    <div class="input-box">
                        <input id="cep-empresa" class="form-input" type="text" name="cep-empresa" placeholder="Iframe Maps">
                    </div>
                </div>
            </div>

            <div class="div-label">
                <label for="senha-empresa" class="form-label">Senha</label>
                <div class ="input-box">
                <input id="senha-empresa" class="form-input" type="password" name="senha-empresa" placeholder="Senha" required></div>
            </div> 

        <div class="div-label">
            <label for="confirmar-senha-empresa" class="form-label">Confirmar Senha</label>
            <div class ="input-box">
                <input id="confirmar-senha-empresa" class="form-input" type="password" name="confirmar-senha-empresa" placeholder="Confirmar Senha" required>
            </div>
        </div>

<script>
    const cnpjInput = document.getElementById("tem-cnpj");
    const camposCnpj = document.getElementById("campos-cnpj");

    cnpjInput.addEventListener("input", () => {
        if (cnpjInput.value === "Sim") {
            camposCnpj.style.display = "block"; // mostra
        } else {
            camposCnpj.style.display = "none";  // esconde
        }
    });
</script>
            
            <button id="submit-button" type="submit">Cadastrar Empresa</button>
    </form>
</body>
</html>
