<?php

    function enviarArquivo($error, $size, $name, $tmp_name){

        

        if($error){
            die("Falha ao enviar arquivo!!!!");
        }

        if($size > 20979152){
            die("Arquivo muito grande!! Max:2MB");
        }

        $pasta = "/home/kassio/Projetos-PHP/Projeto1.0/arquivos/";
        $nomeDoArquivo = $name;
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if($extensao != "jpg" && $extensao != 'png'){
            die("Tipo de arquivo não aceito");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $cam = '/home/kassio/Projetos-PHP/Projeto1.0'. $tmp_name;
        echo $cam;
        $deu_certo = move_uploaded_file($tmp_name, $pasta);
        
        
        if($deu_certo){
            
            return $path;

        }else{
            return false;
        }

        
    }






?>