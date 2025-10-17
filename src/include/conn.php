<?php
//Constantes para conexão com o banco
define('DBHOST' ,'localhost');
define('DBUSER' ,'root');
define('DBPASS', '' );
define('DBBASE' ,'projeto_tecnico');

//Conectar no banco
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBBASE);
?>