<?php

include '../models/conexao.php';

header("Access-Control-Allow-Origin: *");

$link = conectar();


if ($_GET['type'] == "listaJogos") {
    //echo 'Tipo de operação: ' . $_GET['type'] . '<br>';

    $query = "SELECT * FROM tb_partida WHERE tb_campeonato_id = 630 AND (flag_ativo = 1 AND flag_cancelado <> 1 AND flag_finalizado <> 1)";

    $result = mysqli_query($link, $query);

    $registros = array();

    while ($reg = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $registros[] = array('partida' => $reg);
    }

    $saida = json_encode(array('Lista' => $registros));

    echo $saida;
}


else if ($_GET['type'] == "listaCampeonatos") {
    //echo 'Tipo de operação: ' . $_GET['type'] . '<br>';

    $query = "SELECT c.id AS id_campeonato, c.nome_camp AS nome_campeonato, p.nome_pais AS nome_pais
                  FROM tb_campeonato c
                  LEFT JOIN  tb_pais p ON p.id = c.tb_pais_id
                  LEFT JOIN  tb_partida pt ON pt.tb_campeonato_id = c.id
                  WHERE pt.flag_ativo = 1
                  
                  GROUP BY p.nome_pais";

    $result = mysqli_query($link, $query);

    $registros = array();

    while ($reg = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $registros[] = array('campeonato' => $reg);
    }

    $saida = json_encode(array('json' => $registros));

    echo $saida;
}
