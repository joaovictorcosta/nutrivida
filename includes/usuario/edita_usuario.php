<?php

    $id = $_GET['id_usuario'];
    
    //Dados do usuário
    $result_seleciona_cambista_id = sel_usuario($id);
    $usuario = mysqli_fetch_assoc($result_seleciona_cambista_id);
    
    //var_dump($usuario);
    
    //Dados das regionais para as quais o usuário tem acesso
//    $resultado2 = sel_regionais_usuario($id);
//    $regional = mysqli_fetch_assoc($resultado2);
    
    
    //var_dump($regional['id']);

?>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-pencil-square"></i> EDITAR USUÁRIO
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
            
            <form id="form_cad_usuario" data-toggle="validator" class="form-horizontal" method="POST" action="../config/usuario/processa_edicao_usuario.php?id=<?php echo $id;?>">
                
                <!--DADOS DO USUÁRIO-->
                <div class="page-header">
                    <h4>Dados do Usuário</h4s>
                    <hr>
                </div>
                
                
                <div class="form-group">                 
                    <label for="status_check" class="col-sm-2 control-label">Ativo</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input id="status_check" name="status_check" type="checkbox" value="ativo"
                                    <?php
                                        if($usuario['flag_ativo']=="1")
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
                    <label for="nome_usuario" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input 
                            type="text" class="form-control" id="nome_usuario"
                            name="nome_usuario" placeholder="Nome" 
                            data-error="Por favor, informe o nome completo para o usuário." required
                            value="<?php echo $usuario['nome_usu']; ?>"
                        >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <!--DADOS DE ACESSO-->
                <div class="page-header">
                    <h4>Dados de Acesso</h4>
                    <hr>
                </div>
                
                <div class="form-group">
                    <label for="login_usuario" class="col-sm-2 control-label">Usuário</label>
                    <div class="col-sm-10">
                        <input 
                            type="text" class="form-control" id="login_usuario" 
                            name="login_usuario" placeholder="Usuário" 
                            data-error="Por favor, informe o nome de usuário que será usado no login." 
                            required
                            value="<?php echo $usuario['login']; ?>"
                        >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="permissao_usuario" class="col-sm-2 control-label">Permissão</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="permissao_usuario" name="permissao_usuario" data-error="Por favor, selecione um nível de permissão para o usuário." required>
                            <?php
                                preeche_edit_perm_combo($usuario['tb_permissao_id']);
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <!--DADOS DA  REGIONAL-->
                <div class="page-header">
                    <h4>Regionais Permitidas <small style="color: graytext">Obs: Edição de regionais temoporariamente indisponível</small></h4>
                    <hr>
                </div>
                
                <?php
                $result_lista_regionais = lista_regionais();

                while($regional = mysqli_fetch_assoc($result_lista_regionais)) 
                {
                    $id_regional = $regional['id'];
                    $nome_regional = $regional['nome_reg'];
                    
                    //var_dump($id_regional);
                ?>
                    
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="col-sm-1">
                            <div class="checkbox">
                                <label>
                                    <label class="col-md-10" for="<?php echo"regional_$id_regional" ?>">
                                        <input 
                                            type="checkbox" name="<?php echo"regional[$id_regional]"; ?>" 
                                            id="<?php echo"regional_$id_regional" ?>" 
                                            value="<?php echo $nome_regional; ?>"
                                            <?php
                                                $result_lista_regionais_usuario = sel_regionais_usuario($id);
                                                while($reg_usuario = mysqli_fetch_assoc($result_lista_regionais_usuario))
                                                {
                                                    if($reg_usuario['id'] == $id_regional)
                                                    {
                                                        echo 'checked';
                                                    }
                                                }
                                            ?>
                                        >    
                                        <small><?php echo $nome_regional; ?></small>
                                    </label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                }
                ?>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button id="botao_salvar" type="submit" class="btn btn-primary pull-right">Salvar <span class="glyphicon glyphicon-floppy-save"></span></button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

