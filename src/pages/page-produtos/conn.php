<?php
//Constantes para conexão com o banco
define('HOST' ,'localhost');
define('USER' ,'root');
define('PASS', '' );
define('BASE' ,'projeto_tecnico');

//Conectar no banco
$conn = mysqli_connect(HOST, USER, PASS, BASE);
?>