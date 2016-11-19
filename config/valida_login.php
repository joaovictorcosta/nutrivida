<?php
    
    session_start();
    
    //Recebe os campos da página login
    $input_usuario = $_POST['usuario'];
    $input_senha = $_POST['senha'];

    include ('../dao/nutricionista_dao.php');
    
    $usuario_logado = sel_login_nutricionista($input_usuario, $input_senha);
    
    //Se o resultado retornar vazio executa
    if(empty($usuario_logado))
    {
        //Mensagem de erro
        $_SESSION['login_erro'] = "Usuário e/ou senha inválido(s)! Por favor, tente novamente.";
        
        //Redireciona para a tela de login
        header('Location: ../index.php');
    }
    else
    {
        //Sessions que recebem os valores dos campos do banco de dados
        $_SESSION['id_usuario'] = $usuario_logado['id'];
        $_SESSION['nome_usuario'] = $usuario_logado['nome'];
        $_SESSION['login_usuario'] = $usuario_logado['login'];

        $_SESSION['tipo_usuario'];
        
        if($_SESSION['permissao_usuario'] == 1)
        {
            $_SESSION['tipo_usuario'] = "Master";
            header('Location: ../views/menu.php');
        }
        else if($_SESSION['permissao_usuario'] == 2)
        {
            $_SESSION['tipo_usuario'] = "Administrador";
            header('Location: ../views/menu.php');
        }
        else if($_SESSION['permissao_usuario'] == 3)
        {
            $_SESSION['tipo_usuario'] = "Regional";
            header('Location: ../views/menu.php');
        }
        if($_SESSION['permissao_usuario'] == 4)
        {
            $_SESSION['tipo_usuario'] = "Jogos";
            header('Location: ../views/menu.php');
        }
    }

