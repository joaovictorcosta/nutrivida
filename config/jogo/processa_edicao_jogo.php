<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/jogo_dao.php');
    include_once ('../../dao/campeonato_dao.php');
    include_once ('../../dao/pais_dao.php');
    
    verifica_acesso();
    
    //Identificação da página que requisitou a edição
    $pag_requisitante = $_GET['pr'];
        
    //Checkboxes ativo, cancelado e finalizado
    $ativo_check = $_POST['ativo_check'];
    $cancelado_check = $_POST['cancelado_check'];
    $finalizado_check = $_POST['finalizado_check'];
    
    //ID do campeonato
    $campeonato = $_POST['campeonato'];
    
    //ID da cotação
    $id_cotacao = $_GET['id_cotacao'];
    
    //ID da partida
    $id_partida = $_GET['id_partida'];
    
    //Converte a data para o formato MySQL
    $formato_data = date_create_from_format('d/m/Y H:i', $_POST['datahora']);
    $datahora = date_format($formato_data, 'Y-m-d H:i');
        
    //ID's time casa e fora antes da alteração
    $time_casa_antes = $_GET['id_casa'];
    $time_fora_antes = $_GET['id_fora'];
    $times_antes = array($time_casa_antes, $time_fora_antes);
    
    //ID's times casa e fora
    $time_casa = $_POST['time_casa'];
    $time_fora = $_POST['time_fora'];
    $times = array($time_casa, $time_fora);
    
    //Gols partida
    $gols_casa = $_POST['gols_casa'];
    $gols_fora = $_POST['gols_fora'];

    //Cotações
    $casa = $_POST['casa'];
    $empate = $_POST['empate'];
    $fora = $_POST['fora'];
    $gol_meio = $_POST['gol_meio'];
    $mais_2gm = $_POST['mais_2gm'];
    $menos_3gm = $_POST['menos_3gm'];
    $ambas_marcam = $_POST['ambas'];
    $casa_empate = $_POST['casa_empate'];
    $fora_empate = $_POST['fora_empate'];
    $casa_marca = $_POST['casa_marca'];
    $fora_marca = $_POST['fora_marca'];
    $casa_ou_fora = $_POST['casa_ou_fora'];
    $casavence_foramarca = $_POST['casavence_foramarca'];
    $foravence_casamarca = $_POST['foravence_casamarca'];
    $casavence_zero = $_POST['casavence_zero'];
    $foravence_zero = $_POST['foravence_zero'];
    

    
    if($time_casa == $time_fora)
    {
        

        $_SESSION['alerta_erro'] = true;

        $_SESSION['status_registro'] = "Os times que você tentou inserir são idênticos! Por favor, verifique e tente novamente.";
        
        header("Location: ../../views/menu.php?pag=cad_jogo");
               
        return false;
    }

       
    //Verifica checkbox ativo
    if(isset($ativo_check))
    {
        $flag_ativo = 1;
    }
    else
    {
        $flag_ativo = 0;
    }
    
    //Verifica checkbox cancelado
    if(isset($cancelado_check))
    {
        $flag_cancelado = 1;
    }
    else
    {
        $flag_cancelado = 0;
    }
    
    //Verifica checkbox finalizado
    if(isset($finalizado_check))
    {
        $flag_finalizado = 1;
    }
    else
    {
        $flag_finalizado = 0;
    }
    
    //Chamada da função de cadastro
    editar_jogo($pag_requisitante, 
        $times, $times_antes, $flag_ativo, $flag_cancelado, $flag_finalizado, $datahora, $campeonato,
        $id_cotacao, $id_partida, $gols_casa, $gols_fora,
        $casa, $empate, $fora, $gol_meio, $mais_2gm, $menos_3gm, $ambas_marcam, 
        $casa_empate, $fora_empate, $casa_marca, $fora_marca, $casa_ou_fora, 
        $casavence_foramarca, $foravence_casamarca, $casavence_zero, $foravence_zero
    );
    