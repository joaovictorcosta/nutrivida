<?php
    session_start();
    
    include_once ('../seguranca.php');
    include_once ('../../dao/regional_dao.php');
    
    verifica_acesso();
        
    $id = $_GET['id'];
    
    exclui_regional($id);