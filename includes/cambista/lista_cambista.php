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
            <div class="panel-heading"><span class="glyphicon glyphicon-phone"></span> CAMBISTAS</div>
            <br />
            <div id="filtros">
                <a id="home_voltar" href="../views/menu.php" class="btn btn-primary" title="Voltar ao início"><i class="fa fa-home"></i></span></a>
                <a id="cad_cambista" href="../views/menu.php?pag=cad_cambista" class="pull-right btn btn-primary" title="Adicionar Cambista"><i class="fa fa-plus"></i></a>
            </div>
            <div id="info_legendas">
                <span class="label label-primary"><i class="fa fa-home"></i> - Menu Inicial</span>
                <span class="label label-default"><i class="glyphicon glyphicon-lock"></i> - Alterar Senha</span>
                <span class="label label-info"><i class="glyphicon glyphicon-eye-open"></i> - Visualizar</span>
                <span class="label label-warning"><i class="glyphicon glyphicon-edit"></i> - Editar</span>
                <span class="label label-danger"><i class="glyphicon glyphicon-trash"></i> - Excluir</span>
                <span class="label label-primary"><i class="glyphicon glyphicon-plus"></i> - Cadastrar</span>
            </div>
            <div class="table-responsive" style="padding: 20px">
                <table id="datatables" class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Regional</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_lista_cambistas = lista_cambistas();
                        while ($cambista = mysqli_fetch_assoc($result_lista_cambistas)) 
                        {
                            
                            if($cambista['flag_ativo']==1)
                            {
                                //$ativo = "Sim";
                                $col_sts = 'success';
                                $ativo_sts = "Ativo";
                                //$label = "class = 'label label-success'";
                                
                            }
                            else
                            {
                                $col_sts = 'danger';
                                $ativo_sts = "Inativo";
                            }
                        ?>

                            <tr class="<?php echo $col_sts; ?>">

                                <td style="width: 5px">
                                    <center>
                                        <span class="label label-<?php echo $col_sts ?>"/> <?php echo $ativo_sts; ?>
                                    </center>
                                </td>

                                <td style="width: 150px"><?php echo $cambista['nome_camb']; ?></td>
                                
                                <td style="width: 60px"><?php echo $cambista['login']; ?></td>
                                
                                <td style="width: 60px">
                                    <?php
                                        //Retorna todos os dados da regional do cambista
                                        $regional_cambista = mysqli_fetch_assoc(seleciona_regional($cambista['tb_regional_id']));
                                        
                                        echo $regional_cambista['nome_reg'];
                                    ?>
                                </td>

                                <td style="width: 60px">
                                    <center>
                                        <a href="" class="btn btn-default" data-toggle="modal" 
                                           title="Alterar Senha" data-target="#modal_altera_senha_cambista<?php echo $cambista['id']; ?>" >
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </a>
                                        
                                        <a href="" class="btn btn-info" data-toggle="modal" 
                                           title="Visualizar" data-target="#modal_cambista_<?php echo $cambista['id']; ?>"
                                        >
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                        
                                        <a href="../views/menu.php?pag=edita_cambista&id_cambista=<?php echo $cambista['id']; ?>" class="btn btn-warning" title="Editar" >
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        
                                        <a href="javascript:func()" onclick="confirmaExclusao('<?php echo $cambista['id']; ?>', '<?php echo $cambista['nome_camb']; ?>', 'do cambista', 'cambista')" class="btn btn-danger" title="Excluir" >
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </center>                               
                                
                                    <?php
                                    
                                        echo altera_senha_cambista_modal($cambista['id'], $cambista['nome_camb']);
                                    
                                        echo cambista_modal(
                                            $cambista['id'], $cambista['nome_camb'], $cambista['telefone'], 
                                            $cambista['limite_diario'],
                                            $cambista['limite_individual'], 
                                            $cambista['comissao1'], $cambista['comissao2'], 
                                            $cambista['comissao3'], $cambista['login'], 
                                            $cambista['senha'], $cambista['tb_regional_id'], 
                                            $cambista['flag_ativo'], $cambista['criado'], 
                                            $cambista['modificado']
                                        )
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
