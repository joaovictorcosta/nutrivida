<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/usuario_dao.php');
    
    verifica_acesso();
                
    $nome = $_POST['nome_usuario'];
    $login = $_POST['login_usuario'];
    $senha = $_POST['senha_usuario'];
    $permissao = $_POST['permissao_usuario'];
    $status_check = $_POST['status_check'];
    $reg_usuario = $_POST['regional'];
    
    //Verifica o status recebido
    if(!strcmp($status_check, "ativo"))
    {
        $flag_ativo = 1;
    }
    else{
        $flag_ativo = 0;
    }

    cadastra_usuario($nome, $login, $senha, $permissao, $flag_ativo, $reg_usuario);
