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
            <div class="panel-heading"><i class="fa fa-users-md"></i> PACIENTES</div>
            <br />
            <div id="filtros">
                <a id="home_voltar" href="../views/menu.php" class="btn btn-primary" title="Voltar ao início"><i class="fa fa-home"></i></a>
                <a id="cad_usuario" href="../views/menu.php?pag=cad_paciente" class="pull-right btn btn-primary" title="Adicionar Usuário"><i class="fa fa-plus"></i></a>
                
                <div id="info_legendas">
                    <span class="label label-primary"><i class="fa fa-home"></i> - Menu Inicial</span>
                    <span class="label label-default"><i class="glyphicon glyphicon-lock"></i> - Alterar Senha</span>
                    <span class="label label-info"><i class="glyphicon glyphicon-eye-open"></i> - Visualizar</span>
                    <span class="label label-warning"><i class="glyphicon glyphicon-edit"></i> - Editar</span>
                    <span class="label label-danger"><i class="glyphicon glyphicon-trash"></i> - Excluir</span>
                    <span class="label label-primary"><i class="glyphicon glyphicon-plus"></i> - Cadastrar</span>
                </div>
            </div>
            <div class="table-responsive" style="padding: 20px">
                <table id="datatables" class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_lista_paciente = lista_pacientes();
                        while ($paciente = mysqli_fetch_assoc($result_lista_paciente)) 
                        {
                        ?>

                            <tr>

                                <td style="width: 300px"><?php echo $paciente['nome']; ?></td>

                                <td style="width: 60px">
                                    <center>
                                        <a href="../views/menu.php?pag=edita_usuario&id_usuario=<?php echo $paciente['id']; ?>" class="btn btn-warning" title="Editar" >
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        
                                        <a href="javascript:func()" onclick="confirmaExclusao('<?php echo $paciente['id']; ?>', '<?php echo $usuario['nome_usu']; ?>', 'do usuário', 'usuario')" class="btn btn-danger" title="Excluir" >
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
