<?php

session_start();

include_once ('../seguranca.php');
include_once ('../../dao/nutricionista_dao.php');

verifica_acesso();

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$logradouro = $_POST['logradouro'];
$numero_casa = $_POST['numero'];
$complemento = $_POST['complemento'];
$cidade = $_POST['cidade'];
$uf = $_POST['cidade'];
$sexo = $_POST['sexo'];

//cadastra_nutricionista($nome, $data_nascimento, $logradouro, $numero_casa, $complemento, $cidade, $uf, $sexo);



