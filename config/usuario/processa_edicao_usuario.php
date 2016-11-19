<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/usuario_dao.php');
    
    verifica_acesso();

    $id = $_GET['id'];
    $nome = $_POST['nome_usuario'];
    $login = $_POST['login_usuario'];
    $permissao = $_POST['permissao_usuario'];
    $status_check = $_POST['status_check'];
    //TODO: Implementar o recebimento das regionais do usuário
    //$reg_usuario = $_POST['regional'];
    
    //Verifica o status recebido
    if(!strcmp($status_check, "ativo"))
    {
        $flag_ativo = 1;
    }
    else{
        $flag_ativo = 0;
    }
    
    edita_usuario($id, $nome, $login, $permissao, $flag_ativo);