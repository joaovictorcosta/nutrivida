<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/jogo_dao.php');
    
    verifica_acesso();    

    $id_partida = $_GET['id_jogo'];
    $gols_casa = $_POST['gols_casa'];
    $gols_fora = $_POST['gols_fora'];
    
//    echo $gols_casa.'<br>';
//    echo $gols_fora;
    
    finalizar_partida($id_partida, $gols_casa, $gols_fora);
