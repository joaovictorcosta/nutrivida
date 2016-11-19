<?php

include '../models/conexao.php';

header("Access-Control-Allow-Origin: *");

$link = conectar();

if(isset($_GET['type']))
{    
    if($_GET['type'] == "login")
    {        
        $login = $_GET['login'];
        $senha = $_GET['senha'];
        
        $query = "SELECT * FROM `tb_cambista` WHERE `login`='$login' AND `senha`=md5('$senha')";
        
        $result = mysqli_query($link, $query);
        
        $totalResult = mysqli_num_rows($result);
        
        if($totalResult > 0)
        {
//            $registros = array();
//            
//            while($reg = mysqli_fetch_array($result, MYSQLI_ASSOC))
//            {
//                $registros[] = array('Cambista' => $reg);
//            } 
//            
//            $saida = json_encode(array('Lista' => $registros));
//                        
//            echo $saida;
            
            echo json_encode('success');
            
        }
        else
        {
            echo json_encode('fail');
        }
    }
}