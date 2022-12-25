<?php

$hostdoc = "172.19.0.4";
$host = "localhost";
$db ="crud_clientes";
$user = "root";
$port = 3306;
$pass = "projeto123";
$soc = "null";

$mysqli = new mysqli($hostdoc, $user, $pass ,$db);
if($mysqli->connect_errno) {
    die("Falha na conexão com banco de dados teste3");
}

function formatar_data($data){
    return implode('/', array_reverse(explode('-', $data)));
}

function formatar_telefone($telefone){
    
        $add = substr ($telefone, 0, 2);
        $parte1 = substr ($telefone, 2, 5);
        $parte2 = substr ($telefone, 7);
        return"($add) $parte1-$parte2";
    
}


?>