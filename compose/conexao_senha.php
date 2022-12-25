<?php

$hostdoc = "172.31.0.3";
$host = "localhost";
$db ="senhas_bd";
$user = "root";
$port = 3306;
$pass = "projeto123";
$soc = "null";

$mysqli = new mysqli($hostdoc, $user, $pass ,$db);
if($mysqli->connect_errno) {
    die("Falha na conexão com banco de dados teste3");
}


?>