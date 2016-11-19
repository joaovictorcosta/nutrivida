<?php
    if (isset($_POST['filtro_campeonato']) AND $_POST['filtro_campeonato'] != 0)
    {
        $campeonato_sel = $_POST['filtro_campeonato'];
        
        $where_clause = "WHERE flag_ativo <> 1 AND flag_cancelado <> 1 AND flag_finalizado <> 1 AND tb_partida.tb_campeonato_id = $campeonato_sel";
    }
    else{
        $where_clause = "WHERE flag_ativo <> 1 AND flag_cancelado <> 1 AND flag_finalizado <> 1";
    }
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <!--ALERTA MENSAGEM INICIO-->
        <?php
        //Exibe o alerta se a sessão 'status_registro' estiver setada
        if (isset($_SESSION['status_registro']))
        {
            $tipo_alerta = "success";
            $icone_alerta = "check";
            
            //Se o tipo de alerta estiver setada entende-se que a query de inserção
            //retornou um valor menor que zero indicando que não foi possível
            //inserir o registro. Neste caso o ícone e a mensagem do alerta são
            //alteradas.
            if(isset($_SESSION['alerta_erro']))
            {
                $tipo_alerta = "danger";
                $icone_alerta = "exclamation-triangle";
            }
        ?>
        <div class="alert alert-<?php echo $tipo_alerta; ?>">
            <i class="fa fa-<?php echo $icone_alerta; ?>"></i> &nbsp;
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $_SESSION['status_registro']; ?></strong>
            </div>
        <?php
            unset($_SESSION['status_registro']);
            unset($_SESSION['alerta_erro']);
        }
        ?>
        <!--ALERTA MENSAGEM FIM-->
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-soccer-ball-o"></i> JOGOS INATIVOS</div>
            <br />
            <div id="filtros">
                <a id="home_voltar" href="../views/menu.php" class="btn btn-primary" title="Voltar ao início"><i class="fa fa-home"></i></a>
                <a id="cad_usuario" href="../views/menu.php?pag=cad_jogo" class="pull-right btn btn-primary" title="Adicionar Jogo"><i class="fa fa-plus"></i></a>
                <br><br>
                <form class="form-inline" method="POST" action="../views/menu.php?pag=jogos">

                    <label for="sel1">Filtrar por campeonato:</label><br>
                    <div class="form-group">
                        <select style="width: 300px;" class="form-control" id="filtro_campeonato" name="filtro_campeonato">
                            <option value="0">Todos...</option>
                            <?php
                                    seleciona_campeonatos_ativos($_POST['filtro_campeonato']);                           
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button id="filtrar-button" type="submit" class="btn btn-primary pull-right" title="Filtrar">Filtrar <span class="fa fa-filter"></span></button>
                        </div>
                    </div>
                </form>
                
                <div id="info_legendas">
                    <span class="label label-primary"><i class="fa fa-home"></i> - Menu Inicial</span>
                    <span class="label label-danger"><i class="fa fa-check"></i> - Finalizar</span>
                    <span class="label label-default"><i class="fa fa-ticket"></i> - Apostas</span>
                    <span class="label label-info"><i class="glyphicon glyphicon-eye-open"></i> - Visualizar</span>
                    <span class="label label-warning"><i class="glyphicon glyphicon-edit"></i> - Editar</span>
                    <span class="label label-primary"><i class="glyphicon glyphicon-plus"></i> - Cadastrar</span>
                </div>
            </div>
            <div class="table-responsive" style="padding: 20px">
                <table id="datatables" class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Jogo</th>
                            <th>Hora</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_lista_jogos = lista_jogos_where($where_clause);
                        while ($jogos = mysqli_fetch_assoc($result_lista_jogos)) 
                        {

                        ?>

                            <tr class="warning">

                                <td style="width: 5px">
                                    <center>
                                        <span class="label label-warning"/> Inativo
                                    </center>
                                </td>

                                <td style="width: 250px">
                                    
                                    <?php
                                    
                                        //$nome_time = sel_nome_time($id_time);
                                        $cont = false;
                                        
                                        echo'<b>';
                                        echo'<small>';
                                        $resul_sel_times = sel_times_partida($jogos['id']);
                                        while($reg_partida_time = mysqli_fetch_assoc($resul_sel_times))
                                        {                                              

                                            $conta = 0;
                                            
                                            $nome_time = sel_nome_time($reg_partida_time['tb_time_id']);
                                                                                       
                                            if($cont === true)
                                            {
                                                echo ' X ';
                                                $conta=1;
                                            }
                                            
                                            $time_array[$conta] = $nome_time['nome_time'];
                                            
                                            echo mb_strtoupper($nome_time['nome_time']);
                                            //echo $nome_time['nome_time'];
                                            
                                            $cont = true;
                                        }
                                        
                                        $cotacoes = sel_cotacao($jogos['tb_cotacao_id']);

                                        echo '</small>';
                                        echo '</b>';
                                        
                                        echo escreve_cotacoes($cotacoes['casa'], $cotacoes['empate'], $cotacoes['fora'], 
                                                $cotacoes['gol_meio'], $cotacoes['mais_2gm'], $cotacoes['menos_3gm'], 
                                                $cotacoes['ambas_marcam'], $cotacoes['casa_empate'], $cotacoes['fora_empate'], 
                                                $cotacoes['casa_marca'], $cotacoes['fora_marca'], $cotacoes['casa_ou_fora'], 
                                                $cotacoes['casavence_foramarca'], $cotacoes['foravence_casamarca'], 
                                                $cotacoes['casavence_zero'], $cotacoes['foravence_zero'])
                                    ?>
                                
                                </td>
                                
                                <td style="width: 40px">
                                    <center>
                                        <?php echo date("d/m/Y - H:i:s", strtotime($jogos['data_hora'])) ?>
                                    </center>
                                </td>

                                <td style="width: 80px">
                                    <center>
                                        <a href="" class="btn btn-danger" data-toggle="modal" 
                                           title="Ativar Jogo" data-target="#modal_finalizar_partida_<?php echo $jogos['id']; ?>" >
                                            <span class="fa fa-check"></span>
                                        </a>
                                        
                                        <a href="../views/menu.php?pag=edita_usuario&id_usuario=<?php echo $jogos['id']; ?>" class="btn btn-default disabled" title="Apostas" >
                                            <span class="fa fa-ticket"></span>
                                        </a>
                                        
<!--                                        <a href="" class="btn btn-info disabled" data-toggle="modal" 
                                           title="Visualizar" data-target="#modal_dados_<?php echo $jogos['id']; ?>"
                                        >
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>-->
                                        
                                        <a href="../views/menu.php?pag=edita_jogo&id_jogo=<?php echo $jogos['id']; ?>&pr=ativos" class="btn btn-warning" title="Editar" >
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                                                               
                                    </center>
                                
                                <?php 
//                                    echo usuario_modal($usuario['id'], $usuario['nome_usu'], $usuario['login'],
//                                            $usuario['tb_permissao_id'], $usuario['flag_ativo'], $usuario['criado'],
//                                            $usuario['modificado']); 
//                                    
                                    echo finalizar_partida_modal($jogos['id'], $time_array, $jogos['tb_campeonato_id']);
                                ?>
                                
                                </td>
                                </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

