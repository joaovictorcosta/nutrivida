<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-user-plus"></i> CADASTRAR PACIENTE
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
            
            <form id="form_cad_usuario" data-toggle="validator" method="POST" action="../config/usuario/processa_cad_usuario.php">
                
                <!--DADOS DO USUÁRIO-->
                <div class="page-header">
                    <h4>Dados do Paciente</h4>
                    <hr>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tipoPessoa" class="required">Nome</label>
                        <input type="text" class="form-control" required="">
                    </div>
                </div>
                
                
                <br><br>
                <!--DADOS DE ACESSO-->
                <div class="page-header">
                    <h4>Dados de Acesso</h4>
                    <hr>
                </div>
                
                <div class="form-group">
                    <label for="login_usuario" class="col-sm-2 control-label">Usuário</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login_usuario" name="login_usuario" placeholder="Nome de usuário" data-error="Por favor, informe o nome de usuário que será usado no login." required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="senha_usuario" class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="senha_usuario" name="senha_usuario" placeholder="Senha" data-error="Por favor, informe a senha do usuário." required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="permissao_usuario" class="col-sm-2 control-label">Permissão</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="permissao_usuario" name="permissao_usuario" data-error="Por favor, selecione um nível de permissão para o usuário." required>
                            <?php
                                preeche_permiss_combo();
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <!--DADOS DA  REGIONAL-->
                <div class="page-header">
                    <h4>Regionais Permitidas</h4>
                    <hr>
                </div>
                
                <?php
                $usuario = lista_regionais();
                while ($reg = mysqli_fetch_assoc($usuario)) 
                {
                    $id_regional = $reg['id'];
                    $nome_regional = $reg['nome_reg'];
                    
                    if($reg['flag_ativo'] == 1){
                ?>
                    
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="col-sm-1">
                            <div class="checkbox">
                                <label>
                                    <label class="col-md-10" for="<?php echo"regional_$id_regional" ?>">
                                        <input type="checkbox" name="<?php echo"regional[$id_regional]"; ?>" id="<?php echo"regional_$id_regional" ?>" value="<?php echo $nome_regional; ?>"> 
                                        <small><?php echo $nome_regional; ?></small>
                                    </label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>j
                
                <?php
                    }
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