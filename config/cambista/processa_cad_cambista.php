<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../models/funcoes_modelo.php');
    include_once ('../../dao/cambista_dao.php');
    
    verifica_acesso();
                
    $status_check = $_POST['status_check'];
    $regional = $_POST['regional_cambista'];
    $nome = $_POST['nome_cambista'];
    $telefone = $_POST['telefone_cambista'];
    $limite_diario = $_POST['limite_diario'];
    $limite_individual = $_POST['limite_individual'];
    $login = $_POST['login_cambista'];
    $senha = $_POST['senha_cambista'];
    $comissao1 = $_POST['comissao1'];
    $comissao2 = $_POST['comissao2'];
    $comissao3 = $_POST['comissao3'];
    
    //Verifica o status recebido
    if(!strcmp($status_check, "ativo"))
    {
        $flag_ativo = 1;
    }
    else{
        $flag_ativo = 0;
    }

    //Converte os valores monetários para o banco
    $lim_diario_conv = converte_moeda($limite_diario);
    $lim_individual_conv = converte_moeda($limite_individual);
    
    cadastra_cambista($nome, $telefone, $lim_diario_conv, $lim_individual_conv,
            $comissao1, $comissao2, $comissao3, $login, $senha, $regional, $flag_ativo);

