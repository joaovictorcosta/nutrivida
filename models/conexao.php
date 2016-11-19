<?php
    
    //Conecta ao banco de dados usando MySQLi
    function conectar()
    {
        try
        {
            //Localhost
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "databasenutri";
            
            $conn = mysqli_connect($host, $user, $password, $database);
//            mysqli_autocommit($conn, FALSE);
            //echo 'Conexão bem sucedida!';
            
        } catch (Exception $ex) {
            die("Erro de conexão: " . mysqli_connect_error());
        }
        
        return $conn;
    }

