<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/regional_dao.php');
    
    verifica_acesso();

    $nome = $_POST['nome_regional'];
    $status_check = $_POST['nome_regional'];
    
    //Verifica o status recebido
    if(strcmp($status_check, "ativo"))
    {
        $flag_ativo = 1;      
    }
        
    cadastra_regional($nome, $flag_ativo);
