<?php
    
    include_once(__DIR__.'/../models/conexao.php');

    //Cadastra jogos
    function cadastrar_jogo
    (   
        //Dados do time
        $times,
        //Dados do jogo
        $flag_ativo, $data_hora, $campeonato, 
        //Cotações
        $casa, $empate, $fora, $gol_meio, $mais_2gm, $menos_3gm, 
        $ambas_marcam, $casa_empate, $fora_empate, $casa_marca, $fora_marca, 
        $casa_ou_fora, $casavence_foramarca, $foravence_casamarca, $casavence_zero, 
        $foravence_zero
    )
    {
        $link = conectar();
        
        //mysqli_autocommit($link, FALSE);

        
        //Query qye insere as cotações para a partida
        $query =  "INSERT INTO `tb_cotacao`(`casa`, `empate`, `fora`, `gol_meio`, "
                . "`mais_2gm`, `menos_3gm`, `ambas_marcam`, `casa_empate`, `fora_empate`, "
                . "`casa_marca`, `fora_marca`, `casa_ou_fora`, `casavence_foramarca`, "
                . "`foravence_casamarca`, `casavence_zero`, `foravence_zero`) "
                . "VALUES ('$casa', '$empate', '$fora', '$gol_meio', '$mais_2gm', '$menos_3gm', "
                . "'$ambas_marcam', '$casa_empate', '$fora_empate', '$casa_marca', '$fora_marca', "
                . "'$casa_ou_fora', '$casavence_foramarca', '$foravence_casamarca', "
                . "'$casavence_zero', '$foravence_zero')";
        
        //echo 'Query cotação: '.$query.'<br>';
                
        mysqli_query($link, $query);
        
        $cotacao_id = mysqli_insert_id($link);
        
        //Query que insere a partida
        $query2 = " INSERT INTO `tb_partida`(`flag_ativo`, `data_hora`, "
                . "`tb_cotacao_id`, `tb_campeonato_id`) "
                . "VALUES ('$flag_ativo', "
                . "'$data_hora', '$cotacao_id', '$campeonato')";
        
        //echo 'Query partida: '.$query2.'<br>';
        
        mysqli_query($link, $query2);
        
        $partida_id = mysqli_insert_id($link);
        
        //echo 'ID Partida: '.$partida_id.'<br>';
        
        foreach ($times as $time=>$time_id)
        {
            //Query que insere um dos times que fazem parte da partida
            $query3 = "INSERT INTO `tb_partida_time`(`tb_partida_id`, `tb_time_id`, `ordem`) "
                . "VALUES ('$partida_id', '$time_id', '$time')";
            
            mysqli_query($link, $query3);
            
//            echo 'ID Time: '.$time_id.'<br>';
//            echo 'Ordem: '.$time.'<br>';
            
            $time++;
        }
        
//        $erro = 0;
//        
//        if(!mysqli_query($link, $query)) $erro++;
//        if(!mysqli_query($link, $query2)) $erro++;
//        if(!mysqli_query($link, $query3)) $erro++;
//        
//        if($erro == 0)
//        {
//            mysqli_commit($link);echo 'Sucesso';
//            
//            if($pag_requisitante === 'ativos')
//            {
//                header("Location: ../../views/menu.php?pag=jogos");
//            }
//            else if($pag_requisitante === 'finalizados')
//            {
//                header("Location: ../../views/menu.php?pag=finalizados");
//            }
//            
//            $_SESSION['status_registro'] = "Registro editado com sucesso!";
//        }
//        else
//        {
//            mysqli_rollback($link);echo 'erro';
//            
//            if($pag_requisitante === 'ativos')
//            {
//                header("Location: ../../views/menu.php?pag=jogos");
//            }
//            else if($pag_requisitante === 'finalizados')
//            {
//                header("Location: ../../views/menu.php?pag=finalizados");
//            }
//            
//            $_SESSION['status_registro'] = "Erro ao editar registro! Por favor, verifique e tente novamente.";
//        }

        if(mysqli_affected_rows($link) > 0)
        {
            header("Location: ../../views/menu.php?pag=cad_jogo");
            
            $_SESSION['status_registro'] = "Registro inserido com sucesso!";
        }
        else{
            header("Location: ../../views/menu.php?pag=jogos");
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "Erro ao inserir registro! Por favor, verifique e tente novamente.";
        }
    }
    
    function editar_jogo
    (
        $pag_requisitante, 
        //Dados do time
        $times, $times_antes, 
        //Dados do jogo
        $flag_ativo, $flag_cancelado, $flag_finalizado, $data_hora, $campeonato, 
        $id_cotacao, $id_partida,
        //Gols da partida    
        $gols_casa, $gols_fora,
        //Cotações
        $casa, $empate, $fora, $gol_meio, $mais_2gm, $menos_3gm, 
        $ambas_marcam, $casa_empate, $fora_empate, $casa_marca, $fora_marca, 
        $casa_ou_fora, $casavence_foramarca, $foravence_casamarca, $casavence_zero, 
        $foravence_zero
    )
    {
        $link = conectar();
        
        mysqli_autocommit($link, FALSE);
        
        //Query qye insere as cotações para a partida
        $query =  "UPDATE `tb_cotacao` 
                   SET `casa`='$casa',`empate`='$empate',`fora`='$fora',`gol_meio`='$gol_meio',
                   `mais_2gm`='$mais_2gm',`menos_3gm`='$menos_3gm',`ambas_marcam`='$ambas_marcam',
                   `casa_empate`='$casa_empate', `fora_empate`='$fora_empate', `casa_marca`='$casa_marca',
                   `fora_marca`='$fora_marca',`casa_ou_fora`='$casa_ou_fora', `casavence_foramarca`='$casavence_foramarca', 
                   `foravence_casamarca`='$foravence_casamarca',`casavence_zero`='$casavence_zero',
                   `foravence_zero`='$foravence_zero' 
                   WHERE `id`='$id_cotacao'";
                        
        mysqli_query($link, $query) or die(print_r(mysqli_error($link)));
        
        
        //Query qye insere a partida
        $query2 = "UPDATE `tb_partida` 
                   SET `flag_ativo`='$flag_ativo',`flag_cancelado`='$flag_cancelado',
                   `flag_finalizado`='$flag_finalizado',`data_hora`='$data_hora',
                   `time_casa_gols`='$gols_casa',`time_fora_gols`='$gols_fora',
                   `tb_campeonato_id`='$campeonato' 
                   WHERE `id`='$id_partida'";
                
        mysqli_query($link, $query2) or die(print_r(mysqli_error($link)));
        
        //echo $query2;
        
        //$partida_id = mysqli_insert_id($link);
        
        //Query qye insere os times da partida
        foreach ($times as $time=>$time_id)
        {
            echo $time.'<br>';
            //Query que insere um dos times que fazem parte da partida
            $query3 = " UPDATE `tb_partida_time` "
                    . " SET `tb_time_id`='$time_id' "
                    . " WHERE `tb_partida_id`='$id_partida' AND `tb_time_id`='$times_antes[$time]'";
            
            //echo 'Query time_partida: '.$query3.'<br>';
            
            mysqli_query($link, $query3) or die(print_r(mysqli_error($link)));
            
            $time++;
        }
        
        $erro = 0;
        
        if(!mysqli_query($link, $query)) $erro++;
        if(!mysqli_query($link, $query2)) $erro++;
        if(!mysqli_query($link, $query3)) $erro++;
        
        if($erro == 0)
        {
            mysqli_commit($link);
            
            if($pag_requisitante === 'ativos')
            {
                header("Location: ../../views/menu.php?pag=jogos");
            }
            else if($pag_requisitante === 'finalizados')
            {
                header("Location: ../../views/menu.php?pag=finalizados");
            }
            
            $_SESSION['status_registro'] = "Registro editado com sucesso!";
        }
        else
        {
            mysqli_rollback($link);
            
            if($pag_requisitante === 'ativos')
            {
                header("Location: ../../views/menu.php?pag=jogos");
            }
            else if($pag_requisitante === 'finalizados')
            {
                header("Location: ../../views/menu.php?pag=finalizados");
            }
            
            $_SESSION['status_registro'] = "Erro ao editar registro! Por favor, verifique e tente novamente.";
        }
    }

    function lista_jogos_where($where_clause)
    {
        $link = conectar();
        
        $query =  "SELECT * FROM tb_partida "
                . $where_clause
                . " ORDER BY 'id'";
                       
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                
        //return mysqli_fetch_assoc($result);
        return $result;
    }
    
    function lista_jogos_id($id_jogo)
    {
        $link = conectar();
        
        $query =  "SELECT * FROM `tb_partida` WHERE `id`=$id_jogo";
               
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        //return mysqli_fetch_assoc($result);
        return $result;
    }
    
    function seleciona_times()
    {
        $link = conectar();
        
        $query = "SELECT * FROM tb_partida "
                ."WHERE flag_ativo = 1 ORDER BY 'id'";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        //return mysqli_fetch_assoc($result);
        return $result;
    }
    
    function seleciona_campeonatos_ativos($filtro_recebido)
    {
        $link = conectar();
        
        $query = "SELECT c.id AS id_campeonato, c.nome_camp AS nome_campeonato, p.nome_pais AS nome_pais
                  FROM tb_campeonato c
                  LEFT JOIN  tb_pais p ON p.id = c.tb_pais_id
                  LEFT JOIN  tb_partida pt ON pt.tb_campeonato_id = c.id
                  WHERE pt.flag_ativo = 1
                  
                  GROUP BY p.nome_pais";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        while ($registro = mysqli_fetch_assoc($result))
        {
            if($filtro_recebido == $registro['id_campeonato'])
            {
                $selected = "selected=true";
            }
            else{
                $selected = "";
            }
            
            echo "<option " .$selected. " value='".$registro['id_campeonato']."'>".$registro['nome_pais'].'» '.$registro['nome_campeonato']."</option>";
        }
    }
    
    function finalizar_partida($id_partida, $gols_casa, $gols_fora)
    {
        $link = conectar();
        
        $query = "UPDATE `tb_partida` 
                  SET `flag_ativo`=0,`flag_cancelado`=0,`flag_finalizado`=1, 
                  `time_casa_gols`='$gols_casa',`time_fora_gols`='$gols_fora' 
                  WHERE `id`='$id_partida'";
        
        mysqli_query($link, $query) or die(mysqli_error($link));
        
        if(mysqli_affected_rows($link) > 0)
        {
            header("Location: ../../views/menu.php?pag=jogos");
            
            $_SESSION['status_registro'] = "Jogo finalizado com sucesso!";
        }
        else{
            header("Location: ../../views/menu.php?pag=jogos");
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "Erro ao finalizar partida! Por favor, verifique e tente novamente.";
        }
    }
    
