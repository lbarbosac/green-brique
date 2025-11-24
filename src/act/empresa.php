<?php
include_once '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome-empresa']);
    $email = mysqli_real_escape_string($conn, $_POST['email-empresa']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco-empresa']);
    $cep = mysqli_real_escape_string($conn, $_POST['cep-empresa']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone-empresa']);
    $img_perfil = mysqli_real_escape_string($conn, $_POST['img-perfil-empresa']);
    $img_local = mysqli_real_escape_string($conn, $_POST['img-local-empresa']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha-empresa']);
    $confirmar_senha = mysqli_real_escape_string($conn, $_POST['confirmar-senha-empresa']);

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem.";
        exit();
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO cnpj (Nome, Email, Endereco, CEP, Telefone, ImagemPerfil, ImagemLocal, Senha) 
            VALUES ('$nome', '$email', '$endereco', '$cep', '$telefone', '$img_perfil', '$img_local', '$senha_hash')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../pagina-login-comerciante.php?cadastro=sucesso");
        exit();
    } else {
        echo "Erro ao cadastrar comerciante: " . mysqli_error($conn);
    }
}
?>
