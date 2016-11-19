<div class="container-fluid">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-ticket"></i> APOSTAS</div>
            <br />
            <div id="filtros">
                <a id="home_voltar" href="../views/menu.php" class="btn btn-primary" title="Voltar ao início"><i class="fa fa-home"></i></a>
                
                <br><br>
                <form method="POST" action="../views/menu.php?pag=finalizados">

                    <div class="form-group">
                        <div id="aposta_filtro">
                            <div class="row">
                                <div class="form-group component-align-bottom col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for="regional_aposta">Regional</label>
                                    <select class="form-control" id="regional_aposta" name="ra">
                                        <option value=0>Todas</option>
                                        <?php preenche_reg_combo(); ?>
                                    </select>
                                </div>

                                <div class="form-group component-align-bottom col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for="regional_aposta">Cambista</label>
                                    <select class="form-control" id="regional_aposta" name="ra">
                                        <option value=0>Todos</option>
                                        <?php preenche_cambista_combo(); ?>
                                    </select>
                                </div>

                                <div class="form-group component-align-bottom col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <label for="filtroInicial">Data Inicial</label>
                                    <input type="text" class="form-control js_date" 
                                           id="filtroInicial"
                                           required="true"
                                           name="data_inicial" 
                                           value=""                           >
                                </div>
                                <div class="form-group component-align-bottom col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <label for="filtroFinal">Data Final</label>
                                    <input type="text" class="form-control js_date" 
                                           id="filtroFinal" 
                                           required="true"
                                           name="data_final" 
                                           value=""
                                           >
                                </div>
                                <div class="form-group component-align-bottom col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <button id="submitDataFiltro" type="submit" class="btn btn-primary " 
                                            title="Filtrar">
                                        Filtrar <span class="fa fa-filter"></span>
                                    </button> 
                                </div>

                            </div>


                        </div>
                    </div>
                </form>
                
                <div id="info_legendas">
                    <span class="label label-primary"><i class="fa fa-home"></i> - Menu Inicial</span>
                    <span class="label label-info"><i class="glyphicon glyphicon-eye-open"></i> - Visualizar</span>
                    <span class="label label-danger"><i class="glyphicon glyphicon-trash"></i> - Cancelar</span>
                </div>
            </div>
            <div class="table-responsive" style="padding: 20px">
                <table id="datatables" class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Autent.</th>
                            <th>Apostador</th>
                            <th>Valor</th>
                            <th>Regional</th>
                            <th>Cambista</th>
                            <th>Comissão</th>
                            <th>Ação</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_lista_cambistas = lista_usuarios();
                        while ($usuario = mysqli_fetch_assoc($result_lista_cambistas)) 
                        {
                            
                            if($usuario['flag_ativo']==1)
                            {
                                //$ativo = "Sim";
                                $col_sts = 'success';
                                $ativo_sts = "Ganhou";
                                //$label = "class = 'label label-success'";
                                
                            }
                            else
                            {
                                $col_sts = 'danger';
                                $ativo_sts = "Inativo";
                            }
                        ?>

                            <tr class="<?php echo $col_sts; ?>">
                                
                                <td>
                                    <center>
                                        <span class="label label-<?php echo $col_sts ?>"/> <?php echo $ativo_sts; ?>
                                    </center>
                                </td>
                                
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td></td>

                                <td>
                                    <center>
                                        <a href="" class="btn btn-info" data-toggle="modal" 
                                           title="Visualizar" data-target="#modal_dados_<?php echo $usuario['id']; ?>"
                                        >
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                        
                                        <a href="javascript:func()" onclick="confirmaExclusao('<?php echo $usuario['id']; ?>', '<?php echo $usuario['nome_usu']; ?>', 'do usuário', 'usuario')" class="btn btn-danger" title="Excluir" >
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </center>
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
