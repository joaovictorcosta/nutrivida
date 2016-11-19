<?php
    session_start();
    
    static $sp = DIRECTORY_SEPARATOR;
    
    $_SESSION['nome_sistema'] = "Nutri Vida";
    
    include ('.'.$sp.'views'.$sp.'login.php');   
?>


