<?php
    include_once ('../dao/usuario_dao.php');

    $id_jogo = $_GET['id_jogo'];
    $pag_requisitante = $_GET['pr'];
       
    //Dados do usuário
    $result_seleciona_jogo_id = lista_jogos_id($id_jogo);
    $jogo = mysqli_fetch_assoc($result_seleciona_jogo_id);
    
    //Dados da cotação
    $cotacao = sel_cotacao($jogo['tb_cotacao_id']);
    
    $cont = false;

    $resul_sel_times = sel_times_partida($jogo['id']);
    while ($reg_partida_time = mysqli_fetch_assoc($resul_sel_times)) {

        $conta = 0;

        //$nome_time = sel_nome_time($reg_partida_time['tb_time_id']);

        if ($cont === true) {            
            $conta = 1;
        }

        $time_array[$conta] = $reg_partida_time['tb_time_id'];
        
        //echo $time_array[$conta].'<br>';

        $cont = true;
    }    
?>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-edit"></i> EDITAR JOGO
        </div><br>

        <div id="filtros" style="padding-left: 20px">
            <a id="voltar_pagina" href="menu.php" class="btn btn-primary" title="Voltar ao início">
                <i class="fa fa-home"></i>
            </a>
            <a id="voltar_lista" href="javascript:history.back()" class="btn btn-primary" title="Voltar">
                <i class="fa fa-chevron-left"></i>
            </a>                        
        </div>

        <div class="panel-body">
            <form id="form_cad_usuario" data-toggle="validator" class="form-horizontal" method="POST" 
                  action="../config/jogo/processa_edicao_jogo.php?id_cotacao=<?php echo $jogo['tb_cotacao_id']; ?>&id_partida=<?php echo $jogo['id'] ?>&id_casa=<?php echo $time_array[0] ?>&id_fora=<?php echo $time_array[1] ?>&pr=<?php echo $pag_requisitante ?>">
                <!--PARTIDA-->
                <div class="page-header">
                    <h4>Dados da Partida</h4>
                    <hr>
                </div>

                <div style="padding: 20px;" class="row" id="partida-row">
                    <div class="form-group">                 
                        <label for="ativo_check" class="col-sm-2 control-label">Ativo</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input id="ativo_check" name="ativo_check" type="checkbox" value="ativo" 
                                        <?php
                                            if($jogo['flag_ativo']=="1")
                                            {
                                                echo'checked';
                                            }
                                        ?>         
                                    >
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">                 
                        <label for="cancelado_check" class="col-sm-2 control-label">Cancelado</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input id="cancelado_check" name="cancelado_check" type="checkbox" value="cancelado"
                                        <?php
                                            if($jogo['flag_cancelado']=="1")
                                            {
                                                echo'checked';
                                            }
                                        ?>        
                                    >
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">                 
                        <label for="finalizado_check" class="col-sm-2 control-label">Finalizado</label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input id="finalizado_check" name="finalizado_check" type="checkbox" value="finalizado"
                                        <?php
                                            if($jogo['flag_finalizado']=="1")
                                            {
                                                echo'checked';
                                            }
                                        ?>        
                                    >
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="regional_cambista" class="col-sm-2 control-label">Campeonato</label>
                        <div class="col-sm-10">
                            <select class="form-control chosen-select" id="campeonato"
                                    name="campeonato"  
                                    data-error="Por favor, informe o nome completo para o cambista." 
                                    required
                                    data-placeholder="Selecione um campeonato...">
                                        <?php preeche_camp_combo_edit($jogo['tb_campeonato_id']) ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="dt-picker" class="col-sm-2 control-label">Data/Hora</label>
                        <div class="col-sm-10">
                            <div class='input-group date' style="width: 200px" id='datetimepicker'>
                                <input type='text' id="datahora" name="datahora" class="form-control js_date_time"
                                       required="true" data-error="Por favor, informe a data do jogo."
                                       value="<?php
                                                echo date("d/m/Y - H:i:s", strtotime($jogo['data_hora']));
                                              ?>"
                                       />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>
                <!--PARTIDA-->

                <!--TIMES-->
                <div class="page-header">
                    <h4>Times</h4>
                    <hr>
                </div>
                <?php
                    $option1 = lista_times_edit($time_array[0], lista_times());
                    $option2 = lista_times_edit($time_array[1], lista_times());
                ?>
                <div style="padding: 20px; align-content: center" class="row" id="times-row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time_casa" class="col-sm-2 control-label">Casa</label>
                            <div class="col-sm-10">
                                <select style="width: 300px" class="form-control chosen-select" id="time_casa" name="time_casa" data-error="Por favor, selecione o time de casa." required>
                                    <?php
                                        echo $option1;
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label style="color: graytext" for="gols_casa" class="col-sm-2 control-label">
                                Gols
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control js_goals" 
                                           placeholder="Casa" 
                                           aria-describedby="basic-addon1"
                                           id="gols_casa" name="gols_casa"
                                           style="width: 100px;"
                                           value="
                                           <?php
                                                if (!is_null($jogo['time_casa_gols'])) {
                                                    echo $jogo['time_casa_gols'];
                                                }
                                           ?>
                                           "
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time_fora" class="col-sm-2 control-label">Fora</label>
                            <div class="col-sm-10">
                                <select style="width: 300px" class="form-control chosen-select" id="time_fora" name="time_fora" data-error="Por favor, selecione o time de fora." required>
                                    <?php
                                        echo $option2;
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label style="color: graytext" for="gols_fora" class="col-sm-2 control-label">
                                Gols
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control js_goals" 
                                           placeholder="Fora" 
                                           aria-describedby="basic-addon1"
                                           id="gols_fora" name="gols_fora"
                                           style="width: 100px;"
                                           value="
                                           <?php
                                                if (!is_null($jogo['time_casa_gols'])) {
                                                    echo $jogo['time_casa_gols'];
                                                }
                                           ?>
                                           "
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--TIMES-->

                <!--COTAÇÕES-->
                <div class="page-header">
                    <h4>Cotações</h4>
                    <hr>
                </div>

                <div style="padding: 20px;" class="row" id="cotacoes-row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="casa" class="col-sm-2 control-label">
                                <nobr>Casa</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Casa" 
                                           aria-describedby="basic-addon1"
                                           id="casa" name="casa"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['casa']))
                                                {
                                                    echo $cotacao['casa'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="empate" class="col-sm-2 control-label">
                                <nobr>Empate</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Empate" 
                                           aria-describedby="basic-addon1"
                                           id="empate" name="empate"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['empate']))
                                                {
                                                    echo $cotacao['empate'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="fora" class="col-sm-2 control-label">
                                <nobr>Fora</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Fora" 
                                           aria-describedby="basic-addon1"
                                           id="fora" name="fora"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['fora']))
                                                {
                                                    echo $cotacao['fora'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="gol_meio" class="col-sm-2 control-label">
                                <nobr>1.5 Gols</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="1 Gol e Meio" 
                                           aria-describedby="basic-addon1"
                                           id="gol_meio" name="gol_meio"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['gol_meio']))
                                                {
                                                    echo $cotacao['gol_meio'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="mais_2gm" class="col-sm-2 control-label">
                                <nobr>Mais de 2.5 Gols</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Mais de 2.5 Gols" 
                                           aria-describedby="basic-addon1"
                                           id="mais_2gm" name="mais_2gm"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['mais_2gm']))
                                                {
                                                    echo $cotacao['mais_2gm'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="menos_3gm" class="col-sm-2 control-label">
                                <nobr>Menos de 2.5 Gols</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Menos de 2.5 Gols" 
                                           aria-describedby="basic-addon1"
                                           id="menos_3gm" name="menos_3gm"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['menos_3gm']))
                                                {
                                                    echo $cotacao['menos_3gm'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="ambas" class="col-sm-2 control-label">
                                <nobr>Ambas Marcam</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Ambas Marcam" 
                                           aria-describedby="basic-addon1"
                                           id="ambas" name="ambas"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['ambas']))
                                                {
                                                    echo $cotacao['ambas'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="casa_empate" class="col-sm-2 control-label">
                                <nobr>Casa ou Empate</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Casa ou Empate" 
                                           aria-describedby="basic-addon1"
                                           id="casa_empate" name="casa_empate"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['casa_empate']))
                                                {
                                                    echo $cotacao['casa_empate'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="fora_empate" class="col-sm-2 control-label">
                                <nobr>Fora ou Empate</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Fora ou Empate" 
                                           aria-describedby="basic-addon1"
                                           id="fora_empate" name="fora_empate"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['fora_empate']))
                                                {
                                                    echo $cotacao['fora_empate'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="casa_marca" class="col-sm-2 control-label">
                                <nobr>Casa Marca</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Casa Marca" 
                                           aria-describedby="basic-addon1"
                                           id="casa_marca" name="casa_marca"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['casa_marca']))
                                                {
                                                    echo $cotacao['casa_marca'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="fora_marca" class="col-sm-2 control-label">
                                <nobr>Fora Marca</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Fora Marca" 
                                           aria-describedby="basic-addon1"
                                           id="fora_marca" name="fora_marca"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['fora_marca']))
                                                {
                                                    echo $cotacao['fora_marca'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="casa_ou_fora" class="col-sm-2 control-label">
                                <nobr>Casa ou Fora</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Casa ou Fora" 
                                           aria-describedby="basic-addon1"
                                           id="casa_ou_fora" name="casa_ou_fora"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['casa_ou_fora']))
                                                {
                                                    echo $cotacao['casa_ou_fora'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="casavence_foramarca" class="col-sm-2 control-label">
                                <nobr>Casa Vence e Fora Marca</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Casa" 
                                           aria-describedby="basic-addon1"
                                           id="casavence_foramarca" name="casavence_foramarca"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['casavence_foramarca']))
                                                {
                                                    echo $cotacao['casavence_foramarca'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="foravence_casamarca" class="col-sm-2 control-label">
                                <nobr>Fora Vence e Casa Marca</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Fora Vence e Casa Marca" 
                                           aria-describedby="basic-addon1"
                                           id="foravence_casamarca" name="foravence_casamarca"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['foravence_casamarca']))
                                                {
                                                    echo $cotacao['foravence_casamarca'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="casavence_zero" class="col-sm-2 control-label">
                                <nobr>Casa Vence de Zero</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Casa Vence de Zero" 
                                           aria-describedby="basic-addon1"
                                           id="casavence_zero" name="casavence_zero"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['casavence_zero']))
                                                {
                                                    echo $cotacao['casavence_zero'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="color: graytext; padding-right: 50px;" for="foravence_zero" class="col-sm-2 control-label">
                                <nobr>Fora Vence de Zero</nobr>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money_cot" 
                                           placeholder="Fora Vence de Zero" 
                                           aria-describedby="basic-addon1"
                                           id="foravence_zero" name="foravence_zero"
                                           style="width: 150px;"
                                           value="
                                           <?php
                                                if(!is_null($cotacao['foravence_zero']))
                                                {
                                                    echo $cotacao['foravence_zero'];
                                                }
                                           ?>"
                                           >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>                   

                </div>    
                <!--COTAÇÕES-->



                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button id="botao_salvar" type="submit" class="btn btn-primary pull-right">Salvar <span class="glyphicon glyphicon-floppy-save"></span></button>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>