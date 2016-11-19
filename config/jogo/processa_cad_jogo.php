<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/jogo_dao.php');
    include_once ('../../dao/campeonato_dao.php');
    include_once ('../../dao/pais_dao.php');
    
    verifica_acesso();
    
    //Checkboxes ativo, cancelado e finalizado
    $ativo_check = $_POST['ativo_check'];
    
    //ID do campeonato
    $campeonato = $_POST['campeonato'];
    $_SESSION['ultimo_campeonato'] = $campeonato;
    
    //Converte a data para o formato MySQL
    $formato_data = date_create_from_format('d/m/Y H:i', $_POST['datahora']);
    $datahora = date_format($formato_data, 'Y-m-d H:i');
    $_SESSION['ultima_data'] = $_POST['datahora'];
    
    //ID's times casa e fora
    $time_casa = $_POST['time_casa'];
    $time_fora = $_POST['time_fora'];
    $times = array($time_casa, $time_fora);
      
    //Times
//    $time_casa_gols = $_POST['gols_casa'];
//    $time_fora_gols = $_POST['gols_fora'];

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

    
    //echo $nome_campeonato;
    
    //Verifica checkbox ativo
    if(isset($ativo_check))
    {
        $flag_ativo = 1;
    }
    else
    {
        $flag_ativo = 0;
    }
    
//    echo $pag_requisitante;
//    echo $flag_ativo;
    
    //Chamada da função de cadastro
    cadastrar_jogo(
        $times, $flag_ativo, $datahora, 
        $campeonato,  
        $casa, $empate, $fora, $gol_meio, $mais_2gm, $menos_3gm, $ambas_marcam, 
        $casa_empate, $fora_empate, $casa_marca, $fora_marca, $casa_ou_fora, 
        $casavence_foramarca, $foravence_casamarca, $casavence_zero, $foravence_zero
    );
    