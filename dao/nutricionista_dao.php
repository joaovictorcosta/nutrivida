<?php

include_once(__DIR__ . '/../models/conexao.php');

//Função que seleciona usuário se ele existir no banco de dados
function sel_login_nutricionista($login, $senha) {
    $link = conectar();

    $query = "SELECT * FROM `tb_nutricionista` WHERE `login`='$login' AND `senha`=MD5('$senha')";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    return mysqli_fetch_assoc($result);
}
