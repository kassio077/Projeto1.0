
<?php
    if(isset($_POST['email'])){
        include("conexao_senha.php");
        
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM senhas WHERE email = '$email' LIMIT 1";
        $sql_exec = $mysqli->query($sql_code) or die ($mysql->error);

        $usuario = $sql_exec->fetch_assoc();
        if(password_verify($senha, $usuario['senha'])){
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['usuario'] = $usuario['id'];
            header("Location: cadastrar_cliente.php");
        }else{
            echo "Falha! Senha ou e-mail incorretos";
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h2>=====Login=====</h2>
    
    <form action="" method="POST">
        <label>E-mail</label>
        <input type="text" name="email"><br>
        <label>Senha</label>
        <input type="password" name="senha"><br>
        <button type="submit">Logar</button>

    
    </form>

    
</body>
</html>