<?php
    include_once(__DIR__.'/../models/conexao.php');
    
    function lista_regionais()
    {
        $link = conectar();
        
        $query = "SELECT * FROM tb_regional ORDER BY 'id'";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        //return mysqli_fetch_assoc($result);
        return $result;
    }
    
    function cadastra_regional($nome, $flag_ativo)
    {
        $link = conectar($nome, $flag_ativo);
        
        $query = "INSERT INTO tb_regional(nome_reg, flag_ativo) VALUES ('$nome', '$flag_ativo')";
        
        $result = mysqli_query($link, $query);
        
        //var_dump(mysqli_affected_rows($conn));
        
        if(mysqli_affected_rows($link) > 0)
        {
            header("Location: ../../views/menu.php?pag=regionais");
            
            $_SESSION['status_registro'] = "Registro inserido com sucesso!";
        }
        else
        {
            header("Location: ../../views/menu.php?pag=regionais");
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "A regional que você tentou inserir já existe! Por favor, verifique e tente novamente.";
        }
    }
    
    function exclui_regional($id)
    {
        $link = conectar();
        
        $query = "DELETE FROM `tb_regional` WHERE `tb_regional`.`id`='$id'";
        
        mysqli_query($link, $query) or dir(print_r(mysqli_error($link)));
        
        if(mysqli_affected_rows($link) != 0)
        {
            header("Location: ../../views/menu.php?pag=regionais");
          
            $_SESSION['status_registro'] = "Registro excluído com sucesso!";
        }
    }
    
    function seleciona_regional($id)
    {
        $link = conectar();
        
        $query = "SELECT * FROM `tb_regional` WHERE `tb_regional`.`id`='$id'";
        
        $result = mysqli_query($link, $query) or die(print_r(mysqli_error($link)));
        
        return $result;
    }
    
    function preenche_reg_combo()
    {
        $link = conectar();
        
        $query = "SELECT `id`, `nome_reg` FROM `tb_regional` WHERE `flag_ativo`=1 ORDER BY `nome_reg`";
        
        $result = mysqli_query($link, $query);
        
        while ($registro = mysqli_fetch_assoc($result))
        {
            echo "<option value='".$registro['id']."'>".$registro['nome_reg']."</option>";
        }
    }

    function edita_regional($id, $nome, $flag_ativo)
    {
        $link = conectar();
        
        $query = "UPDATE `tb_regional` SET `nome_reg`='$nome',`flag_ativo`='$flag_ativo' WHERE `id`='$id'";
        
        mysqli_query($link, $query);
        
        if(mysqli_affected_rows($link) != 0)
        {
            header("Location: ../../views/menu.php?pag=regionais");
            
            $_SESSION['status_registro'] = "Registro editado com sucesso!";
        }
        //if(mysqli_affected_rows($link) == 0)
        else
        {
            header("Location: ../../views/menu.php?pag=regionais");
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "A regional que você tentou inserir já existe! Por favor, verifique e tente novamente.";
        }
    }
    
    function preeche_edit_regional_combo($regional_selecionada)
    {
        $link = conectar();
        
        $query = "SELECT * FROM `tb_regional` ORDER BY `id` DESC";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        while ($registro = mysqli_fetch_assoc($result))
        {
            if($regional_selecionada == $registro['id'])
            {
                $sel = "selected";
            }
            else
            {
                $sel = "";
            }
            
            echo "<option ".$sel." value='".$registro['id']."'>".$registro['nome_reg']."</option>";
        }
        
    }