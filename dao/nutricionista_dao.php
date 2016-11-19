<?php

include_once(__DIR__ . '/../models/conexao.php');

//Função que seleciona usuário se ele existir no banco de dados
function sel_login_nutricionista($login, $senha) {
    $link = conectar();

    $query = "SELECT * FROM `tb_nutricionista` WHERE `login`='$login' AND `senha`=MD5('$senha')";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    return mysqli_fetch_assoc($result);
}

function cadastra_nutricionista($nome, $data_nascimento, $logradouro, $numero_casa, $complemento, $cidade, $uf, $sexo)
    {
        $link = conectar();

        $query =  "INSERT INTO `tb_paciente` "
                . "(`nome`, `data_nascimento`, `logradouro`, `numero_casa`, "
                . "`complemento`, `cidade`, `uf`, `sexo`) "
                . "VALUES ('$nome','$data_nascimento', '$logradouro', '$numero_casa', "
                . "'$complemento', $cidade, '$uf', '$sexo')";
        
        mysqli_query($link, $query);
        
        
        if(mysqli_affected_rows($link) > 0)
        {
            //header("Location: ../../views/menu.php?pag=pacientes");
            
            echo'cadastrou';
            
            //$_SESSION['status_registro'] = "Registro inserido com sucesso!";
        }
        else{
            //header("Location: ../../views/menu.php?pag=pacientes");
            
            echo'erro';
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "Erro ao inserir registro! Por favor, verifique e tente novamente.";
        }
    }
