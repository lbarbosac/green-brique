<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ./pagina-login-comerciante.php");
    exit();
}
else{
    
}
