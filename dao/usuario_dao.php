<?php    

    include_once(__DIR__.'/../models/conexao.php');
    
    //Função que cadastra usuários
    function cadastra_usuario($nome, $login, $senha, $permissao, $flag_ativo, $regional)
    {
        $link = conectar();

        $query =  "INSERT INTO `tb_usuario` (`nome_usu`, `login`, `senha`, `tb_permissao_id`, `flag_ativo`)"
                . "VALUES ('$nome', '$login', MD5('$senha'), '$permissao', '$flag_ativo');";
        
        mysqli_query($link, $query);
        
        $usuario_id = mysqli_insert_id($link);
                        
        foreach ($regional as $index=>$valor)
        {
            $query2 = "INSERT INTO `tb_regional_usuario`(`tb_regional_id`, `tb_usuario_id`) "
                    . "VALUES ('$index', '$usuario_id');";
            
            mysqli_query($link, $query2);
                        
            $valor++;
            
            //unset($valor);
        }
        
        
        if(mysqli_affected_rows($link) > 0)
        {
            header("Location: ../../views/menu.php?pag=usuarios");
            
            $_SESSION['status_registro'] = "Registro inserido com sucesso!";
        }
        else{
            header("Location: ../../views/menu.php?pag=usuarios");
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "O nome de usuário que você tentou inserir já existe! Por favor, verifique e tente novamente.";
        }
    }
    
    function edita_usuario($id, $nome, $login, $permissao, $flag_ativo)
    {
        $link = conectar();
        
        $query = "UPDATE `tb_usuario` 
                  SET `nome_usu`='$nome', `login`='$login', `tb_permissao_id`='$permissao', `flag_ativo`='$flag_ativo' 
                  WHERE `id`= $id";
        
        mysqli_query($link, $query);
                            
        $reg_usu_att = mysqli_fetch_assoc(sel_usuario($id));
        
        //Verifica se o usuário que está sendo editado é o usuário que está editando
        if($reg_usu_att['id'] == $_SESSION['id_usuario'])
        {
            //Se for atualiza as informações exibidas no sistema
            $_SESSION['nome_usuario'] = $reg_usu_att['nome_usu'];
            $_SESSION['permissao_usuario'] = $reg_usu_att['tb_permissao_id'];
            $_SESSION['login_usuario'] = $reg_usu_att['login'];
        }
        
        if(mysqli_affected_rows($link) != 0)
        {
            header("Location: ../../views/menu.php?pag=usuarios");
            
            $_SESSION['status_registro'] = "Registro editado com sucesso!";
        }
        else if(mysqli_affected_rows($link) == 0)
        {
            header("Location: ../../views/menu.php?pag=usuarios");
            
            $_SESSION['alerta_erro'] = true;
            
            $_SESSION['status_registro'] = "O nome de usuário que você tentou inserir já existe! Por favor, verifique e tente novamente.";
        }
    }
    
    //Função que seleciona usuário se ele existir no banco de dados
    function sel_login_usuario($login, $senha)
    {
        $link = conectar();

        $query = "SELECT * FROM `tb_usuario` WHERE `flag_ativo`=1 AND `login`='$login' AND `senha`=MD5('$senha')";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                
        return mysqli_fetch_assoc($result);
    }
    
    //Função que seleciona todos os usuários do banco de dados
    function lista_usuarios()
    {
        $link = conectar();
        
        $query = "SELECT * FROM tb_usuario ORDER BY 'nome'";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        //return mysqli_fetch_assoc($result);
        return $result;
    }
    
    //Função que exlui o usuário baseado no id recebido como parâmetro
    function exclui_usuario($id)
    {
        $link = conectar();
        
        $query = "DELETE FROM `tb_usuario` WHERE `tb_usuario`.`id`='$id'";
        
        $reg_usu_att = mysqli_fetch_assoc(sel_usuario($id));
        
        mysqli_query($link, $query) or die(print_r(mysqli_error($link)));
        
        //echo $reg_usu_att['id'];
        //echo $_SESSION['id_usuario'];

        //Verifica se o usuário que está sendo editado é o usuário que está editando
        if($reg_usu_att['id'] == $_SESSION['id_usuario'])
        {
            //Se for encerra o acesso do usuário
            header("Location: ../../config/encerra_acesso.php");
        }
        else if(mysqli_affected_rows($link) != 0)
        {
            header("Location: ../../views/menu.php?pag=usuarios");
          
            $_SESSION['status_registro'] = "Registro excluído com sucesso!";
        }
    }
    
    //Função que seleciona o usuário que possui o id passado como parâmetro
    function sel_usuario($id)
    {
        $link = conectar();
        
        $query = "SELECT * FROM `tb_usuario` WHERE `id`=$id";
        
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        
        return $result;
    }
    
    //Função que seleciona as regionais para quais o usuário tem acesso
    function sel_regionais_usuario($id)
    {
        $link = conectar();
        
        $query = "SELECT tb_regional.id 
                  FROM tb_usuario 
                  INNER JOIN tb_regional_usuario ON (tb_usuario.id = tb_regional_usuario.tb_usuario_id) 
                  INNER JOIN tb_regional ON (tb_regional_usuario.tb_regional_id = tb_regional.id) 
                  WHERE tb_usuario.id = $id 
                  ORDER BY tb_regional.id;";
        
        $result = mysqli_query($link, $query);
        
        return $result;
    }
    
    //Função que troca a senha do usuário no banco de dados
    function altera_senha($id, $novasenha)
    {
        $link = conectar();
        
        $query = "UPDATE tb_usuario 
                  SET senha=MD5('$novasenha') 
                  WHERE id = $id;";
        
        mysqli_query($link, $query) or die (mysqli_error($link));
        
        if(mysqli_affected_rows($link) != 0)
        {
            header("Location: ../../views/menu.php?pag=usuarios");
            
            //var_dump(mysqli_insert_id());
            //var_dump(mysqli_affected_rows($conn));
            
            $_SESSION['status_registro'] = "Senha alterada com sucesso!";
        }
    }
