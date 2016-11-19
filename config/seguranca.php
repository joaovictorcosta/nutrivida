<?php    
    
    function verifica_acesso()
    {
        if
        (empty($_SESSION['nome_usuario']) || empty($_SESSION['permissao_usuario']) || empty($_SESSION['login_usuario']))
        {
            //Destrói todos os dados da sessão
            unset(
                $_SESSION['nome_usuario'],
                $_SESSION['id_usuario'],
                $_SESSION['acesso_usuario'],
                $_SESSION['login_usuario']
            );

            //Mensagem de erro
            $_SESSION['login_erro'] = "Área restrita para usuários cadastrados.";

            //Redireciona para a tela de login
            header("Location: ../index.php");
        }
    }
    
    function usuario_logado()
    {
        //$perm = sel_permissao($_SESSION['permissao_usuario']);
        
        echo $_SESSION['nome_usuario']
            ." | "
            ."<small><font style='color: #337ab7'>". "Usuario X" ."</font></small>   ";
        
    }

    function verifica_master()
    {
        if($_SESSION['permissao_usuario'] != 1)
        {
            //Mensagem de erro
            $_SESSION['login_erro'] = "Usuário e/ou senha inválido(s)! Por favor, tente novamente.";
        
            //Redireciona para a tela de login
            header('Location: ../index.php');
        }
    }