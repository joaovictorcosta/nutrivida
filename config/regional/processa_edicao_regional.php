<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/regional_dao.php');
    
    verifica_acesso();

    $id = $_GET['id_regional'];
    $status_check = $_POST['status_check'];
    $nome = $_POST['nome_regional'];
    
    //Verifica o status recebido
    if(!strcmp($status_check, "ativo"))
    {
        $flag_ativo = 1;
    }
    else{
        $flag_ativo = 0;
    }
    
    edita_regional($id, $nome, $flag_ativo);