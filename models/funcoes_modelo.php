<?php

function converte_moeda($valor) {

    $source = array('.', ',');

    $replace = array('', '.');

    $valor = str_replace($source, $replace, $valor); //remove os pontos e substitui a virgula pelo ponto

    return $valor; //retorna o valor formatado para gravar no banco
}
