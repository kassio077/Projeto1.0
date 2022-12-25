
<?php

    // if(!isset($_SESSION))
    //     session_start();

    // if(!isset($_SESSION['usuario']))
    //     die('Você não está logado. <a href="login.php">Clique aqui</a> para logar');

    function limpar_texto($str){
        return preg_replace("/[^0-9]/", "", $str);
    }

    
    if(count($_POST) > 0){
        

        include('../lib/conexao.php');
        include('../lib/upload.php');
        include('../lib/mail.php');

        $erro = false;

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        $senha_descriptografada = $_POST['senha'];

        if(strlen($senha_descriptografada) < 6 && strlen($senha_descriptografada) > 16){
            $erro = "A senha deve ter entre 6 e 16 caracteres.";

        }
       
        if(empty($nome)){
            $erro = "Preencha o nome";
        }
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro = "Preencha o e-mail";
        }

        // obs: Tratar data de nascimento quando usuario digitar dia/mes inexistente. 

        if(!empty($nascimento)){
            $pedacos = explode('/', $nascimento);
           
            if(count($pedacos)==3){
               $nascimento = implode('-', array_reverse($pedacos));
            }else{
                $erro = "A data de nascimento deve seguir o padrao dia/mes/ano.";
            }
            

        }

        if(!empty($telefone)){
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) != 11){
                $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
            }
        }


        $path = "";

        $temp = $_FILES['foto']['tmp_name'];
        echo $temp;
       
        if(isset($_FILES['foto'])){
           
            $arq = $_FILES['foto'];
            var_dump($arq);
            $path = enviarArquivo($arq['error'], $arq['size'], $arq['name'], $arq['tmp_name']);
            
            if($path == false){
                $erro = "Falha ao enviar arquivo. Tente novamente";
            }

        } 

        if($erro){
            echo "<p><b>Erro: $erro </b></p>";
        }else{
            
            $senha = password_hash($senha_descriptografada, PASSWORD_DEFAULT);

            $sql_code = " INSERT INTO clientes (nome, email, senha, telefone, nascimento, data, foto)
            VALUES ('$nome', '$email', '$senha', '$telefone', '$nascimento', NOW(), '$path')";
           
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
            
            if($deu_certo) {
                enviar_email($email, "Sua conta no meu site foi criada!", "
                    <h1>Parabéns<h1>
                    <p>Sua conta no sistema foi criada Donald<p>
                    <p>
                        <b>Login:</b> $email <br>
                        <b>Senha:<b/> $senha_descriptografada
                    </p>
                    <p>Para fazer login acesse <a href=\"http://localhost:4500/login.php\">este link.</a></p>  
                
                " );
                echo "<p><b>Cliente cadastrado com sucesso!!!</b></p>";
                unset($_POST);
            }
           
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>
    <form enctype="multipart/form-data" method="POST" action="">
        <p>
            <label>Nome:</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text">

        </p>

        <p>
            <label>E-mail:</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="text">
        </p>

        <p>
            <label>Telefone:</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>" placeholder="(11) 98888-8888" name="telefone" type="text">
        </p>

        <p>
            <label> Data de Nascimento:</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>" name="nascimento" type="text">
        </p>

        <p>
            <label> Senha:</label>
            <input value="<?php if(isset($_POST['senha'])) echo $_POST['senha']; ?>" name="senha" type="password">
        </p>

        <p>
            <label>Foto do Usuário:</label>
            <input name="foto" type="file">        
        
        </p>

        <p>
            <button type="submit">Salvar cliente</button>
        </p>
    </form>

    <p><a href="logout.php">Sair</a></p>
   
    
</body>
</html>



