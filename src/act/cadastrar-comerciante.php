<?php
include_once '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome_user']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $confirmar_senha = mysqli_real_escape_string($conn, $_POST['confirmar_senha']);

    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem.";
        exit();
    }

    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    $sql = "INSERT INTO comerciantes (Nome, Senha) VALUES ('$nome', '$senha_hash')";


    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../pagina-login-comerciante.php?cadastro=sucesso");
        exit();
    } else {
        echo "Erro ao cadastrar comerciante: " . mysqli_error($conn);
    }
}
?>
