<?php
include_once '../include/conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome_user']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $sql = "SELECT * FROM comerciantes WHERE Nome = '$nome'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $comerciante = mysqli_fetch_assoc($resultado);

        if (password_verify($senha, $comerciante['Senha'])) {
            $comerciante_id = $comerciante['ComercianteID'];
            $comerciante_nome = urlencode($comerciante['Nome']);
            $comerciante_email = urlencode($comerciante['Email']);
            $comerciante_telefone = urlencode($comerciante['Telefone']);

            // Check if it is the first login
            if (empty($comerciante['Email']) || empty($comerciante['Telefone'])) {
                header("Location: ../salvar-infos-comerciante.php?ComercianteID=$comerciante_id&Nome=$comerciante_nome");
                exit();
            }

            header("Location: ../perfil.php?ComercianteID=$comerciante_id&Nome=$comerciante_nome&Email=$comerciante_email&Telefone=$comerciante_telefone");
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
