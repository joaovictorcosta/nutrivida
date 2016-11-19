<?php
    session_start();
    include_once '../../dao/usuario_dao.php';
    
    $senha1 = $_POST['digita_senha'];
    $senha2 = $_POST['confirma_senha'];
    $id = $_GET['id'];
    
    $res_usuario = mysqli_fetch_assoc(sel_usuario($id));
    
    
    if( ($senha1 == $senha2) && (md5($senha1) == $res_usuario['senha']) )
    {
        $_SESSION['status_registro'] = "As senhas informadas são idênticas à senha atual! Por favor, verifique e tente novamente";
        $_SESSION['alerta_erro'] = true;
        
        header("Location: ../../views/menu.php?pag=usuarios");

    }
    else if($senha1 == $senha2)
    {
        try
        {
            altera_senha($id, $senha2);
        } 
        catch (Exception $ex) {
            die(print_r($ex));
        }
    }

    else
    {
        $_SESSION['status_registro'] = "As senhas informadas são diferentes! Por favor, verifique e tente novamente";
        $_SESSION['alerta_erro'] = true;
        
        header("Location: ../../views/menu.php?pag=usuarios");    
    }
