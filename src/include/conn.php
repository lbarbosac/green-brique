<?php
//Constantes para conexão com o banco
define('DBHOST' ,'localhost');
define('DBUSER' ,'root');
define('DBPASS', '' );
define('DBBASE' ,'empresa');

//Conectar no banco
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBBASE);
?>