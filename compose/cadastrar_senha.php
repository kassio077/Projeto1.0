<?php
    if(isset($_POST['email'])){
        include('conexao_senha.php');

        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


        $mysqli->query("INSERT INTO senhas (email, senha) VALUES('$email', '$senha')");

        echo "Inserido!";
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Senha</title>
</head>
<body>

    Cadastrar Senha
    <form action="" method="post">
        <input type="text" name="email">
        <input type="text" name="senha">
        <button type="submit">Cadastrar senha</button>

    </form>
    
</body>
</html>