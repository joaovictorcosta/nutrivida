<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../models/funcoes_modelo.php');
    include_once ('../../dao/cambista_dao.php');
    
    verifica_acesso();

    $id = $_GET['id_cambista'];
    $status_check = $_POST['status_check'];
    $regional = $_POST['regional_cambista'];
    $nome = $_POST['nome_cambista'];
    $telefone = $_POST['telefone_cambista'];
    $lim_diario = $_POST['limite_diario'];
    $lim_individual = $_POST['limite_individual'];
    $comissao1 = $_POST['comissao1'];
    $comissao2 = $_POST['comissao2'];
    $comissao3 = $_POST['comissao3'];
    $login = $_POST['login_cambista'];
    
    //Verifica o status recebido
    if(!strcmp($status_check, "ativo"))
    {
        $flag_ativo = 1;
    }
    else{
        $flag_ativo = 0;
    }
    
    //Converte os valores monetários para o banco
    $lim_diario_conv = converte_moeda($lim_diario);
    $lim_individual_conv = converte_moeda($lim_individual);
    
    
    //echo $flag_ativo;
    edita_cambista($id, $nome, $login, $flag_ativo, $telefone, 
            $lim_diario_conv, $lim_individual_conv, $comissao1, $comissao2, $comissao3, $regional);