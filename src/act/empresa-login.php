<?php
include_once '../include/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome_user']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $sql = "SELECT * FROM cnpj WHERE Nome = '$nome'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $comerciante = mysqli_fetch_assoc($resultado);

        if (password_verify($senha, $comerciante['Senha'])) {
            $_SESSION['logado'] = true;
            $_SESSION['CnpjID'] = $comerciante['CnpjID']; // Store CnpjID in the session
            header("Location: ../perfil.php");
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
