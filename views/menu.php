<?php
session_start();
include_once('../config/seguranca.php');
include_once('../config/funcoes.php');
include_once('../dao/paciente_dao.php');


//Verifica se o usuário está logado.
verifica_acesso();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="theme-color" content="#337ab7">
        <meta name="author" content="">
        <link rel="icon" href="../assets/imagens/bola.ico">

        <title><?php echo $_SESSION['nome_sistema']?></title>

        <!-- STYLES SHEETS -->
        <link href="../assets/datatables/media/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.bootstrap.min.css">
        <link href="../assets/css/menu.css" rel="stylesheet">
        <link href="../assets/chosen/chosen.min.css" rel="stylesheet">
        <link href="../assets/pace/themes/blue/pace-theme-minimal.css" rel="stylesheet">
        <link href="../assets/datetimepicker/build/jquery.datetimepicker.min.css" rel="stylesheet">

    </head>

    <body>

        <?php

        //Inclui a navbar de admnistrador
        include ('../includes/navbar_master.php');
        //include ('../includes/navbar.php');
        
        $pagina['home'] = "../includes/home.php";
        
        //Usuários
        $pagina['usuarios'] = "../includes/usuario/lista_usuario.php";
        $pagina['cad_usuario'] = "../includes/usuario/cadastra_usuario.php";
        $pagina['edita_usuario'] = "../includes/usuario/edita_usuario.php";
        
        //Pacientes
        $pagina['paciente'] = "../includes/paciente/lista.php";
        $pagina['cad_paciente'] = "../includes/paciente/cadastrar.php";

        
        //Se a variável 'link' for diferente de vazio.
        if (isset($_GET["pag"])) 
        {
            $link = $_GET["pag"];

             //Se o arquivo da página existir inclui.
            if (file_exists($pagina[$link]))
            {
                include_once $pagina[$link];
            }
            else
            {
                die (include_once '../includes/pagina_erro.php');
            }
        }
        //Caso contrário inclui a página 'home'.
        else 
        {
            include_once '../includes/home.php';
        }
            
        ?>

    </body>
    <!-- Bootstrap core JavaScript
        ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>');</script>
    <script src="../assets/maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="../assets/datatables/media/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../assets/datatables/media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
    <script src="../assets/pace/pace.min.js"></script>
    <script src="../assets/chosen/chosen.jquery.min.js"></script>
    <script src="../assets/datetimepicker/build/jquery.datetimepicker.full.js"></script>
    <script src="../assets/jquerymaskplugin/jquery.mask.plugin.js"></script>
    <script type="text/javascript" src="../assets/javascript/scripts.js"></script>
    
    <!--    Plugins JS-->
    <script type="text/javascript" charset="utf-8"> 
        //$('.js_money').mask('0000000000.00', {reverse: true});
        $('.js_money').mask('000.000.000.000.000,00', {reverse: true});
        $('.js_date_time').mask('00/00/0000 00:00');
        $('.js_date').mask('00/00/0000');
        $('.js_money_com').mask('00.0', {reverse: true});
        $('.js_money_cot').mask('00.00', {reverse: true});
        $('.js_goals').mask('00');
        $('.chosen-select').chosen();
        $('.js_phone_with_ddd').mask('(00) 00000-0000');
        customDatepickerFull("js_date_time");
        customDatepicker("js_date");
        DataTablesConfig("datatables");
        desmarcaCheckbox("ativo_check", "cancelado_check", "finalizado_check");
    </script>
    
</html>

    