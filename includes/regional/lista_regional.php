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
            <div class="panel-heading"><span class="fa fa-globe"></span> REGIONAIS</div>
            <br />
            <div id="filtros">
                <a id="home_voltar" href="../views/menu.php" class="btn btn-primary" title="Voltar ao início"><i class="fa fa-home"></i></span></a>
                <a id="cad_regional" href="../views/menu.php?pag=cad_regional" class="pull-right btn btn-primary" title="Adicionar Regional"><i class="fa fa-plus"></i></a>
            </div>
            <div id="info_legendas">
                <span class="label label-primary"><i class="fa fa-home"></i> - Menu Inicial</span>
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
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usuario = lista_regionais();
                        while ($regional = mysqli_fetch_assoc($usuario)) 
                        {
                            
                            if($regional['flag_ativo']==1)
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

                                <td style="width: 300px"><?php echo $regional['nome_reg']; ?></td>

                                <td style="width: 25px">
                                    <center>
                                        <a href="../views/menu.php?pag=edita_regional&id_regional=<?php echo $regional['id'];  ?>" class="btn btn-warning" title="Editar" >
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="javascript:func()" onclick="confirmaExclusao('<?php echo $regional['id']; ?>', '<?php echo $regional['nome_reg']; ?>', 'da regional', 'regional')" class="btn btn-danger" title="Excluir" >
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
