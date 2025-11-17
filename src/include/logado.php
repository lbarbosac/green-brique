<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ./pagina-login-comerciante.php&log=false");
    exit();
} else {
    // Ensure the user's name is stored in the session
    if (!isset($_SESSION['Nome']) && isset($dados_do_usuario['Nome'])) {
        $_SESSION['Nome'] = $dados_do_usuario['Nome'];
    }
}
