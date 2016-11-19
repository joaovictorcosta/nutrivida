<?php
    //Lista todos os jogos ativos
    function lista_times()
    {
        $link = conectar();
        $query = "SELECT tb_time.id as id_time, tb_time.nome_time, tb_campeonato.nome_camp
                  FROM tb_campeonato, tb_time
                  WHERE tb_time.tb_campeonato_id = tb_campeonato.id";
        $result = mysqli_query($link, $query) or die(print_r(mysqli_error()));
        
        return $result;
       
    }
    
    function preenche_time_combo($result)
    {
        $header_atual="";
        
        $html="";
        
        while ($registro = mysqli_fetch_assoc($result)) {
            if($registro['nome_camp'] != $header_atual){
                if($header_atual != ""){
                    $html .= "</optgroup>";
                }
                
                $html .= "<optgroup label='".$registro['nome_camp']."'>";
                $header_atual = $registro['nome_camp'];
            }
            
            $html .= "<option value='" . $registro['id_time'] . "'>" . $registro['nome_time'] . "</option>";
        }
        
        $html .= "</optgroup>";
        
        return $html;
        
        exit();
    }
    
    function lista_times_edit($id_time, $result)
    {
//        $link = conectar();
//        $query = "SELECT tb_time.id as id_time, tb_time.nome_time, tb_campeonato.nome_camp
//                  FROM tb_campeonato, tb_time
//                  WHERE tb_time.tb_campeonato_id = tb_campeonato.id";
//        $result = mysqli_query($link, $query) or die(print_r(mysqli_error()));
//        //return $result;
        
        $header_atual="";
        $html="";
        
        while ($registro = mysqli_fetch_assoc($result)) {
            
            if($id_time == $registro['id_time'])
            {
                $sel = "selected";
            }
            else
            {
                $sel = "";
            }
            
            if($registro['nome_camp'] != $header_atual){
                if($header_atual != ""){
                    $html .= "</optgroup>";
                }
                
                $html .= "<optgroup label='".$registro['nome_camp']."'>";
                $header_atual = $registro['nome_camp'];
            }
            
            $html .= "<option value='" . $registro['id_time'] . "' ".$sel.">" . $registro['nome_time'] . "</option>";
        }
        
        $html .= "</optgroup>";
        
        return $html;
    }
    
    function sel_nome_time($id_time)
    {
        $link = conectar();
        
        $query = "SELECT tb_time.nome_time FROM tb_time "
                ."WHERE id = '$id_time'";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        //return mysqli_fetch_assoc($result);
        return mysqli_fetch_assoc($result);
    }
    
    function sel_times_partida($id_partida)
    {
        $link = conectar();
        
        $query = "SELECT tb_time_id FROM `tb_partida_time` "
                ."WHERE `tb_partida_id`='$id_partida' "
                ."ORDER BY ordem";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        return $result;
    }