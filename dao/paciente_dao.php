<?php

include_once(__DIR__ . '/../models/conexao.php');

//Função que seleciona todos os usuários do banco de dados
function lista_pacientes() {
    $link = conectar();

    $query = "SELECT * FROM tb_paciente ORDER BY 'nome'";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    //return mysqli_fetch_assoc($result);
    return $result;
}
