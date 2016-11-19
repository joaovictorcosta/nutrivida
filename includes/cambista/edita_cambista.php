<?php
    $id = $_GET['id_cambista'];
        
    //Dados do usuário
    $result_seleciona_cambista_id = sel_cambista($id);
    $cambista = mysqli_fetch_assoc($result_seleciona_cambista_id);

?>
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-plus-square"></i> EDITAR CAMBISTA
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
            
            <form id="form_cad_usuario" data-toggle="validator" class="form-horizontal" method="POST" action="../config/cambista/processa_edicao_cambista.php?id_cambista=<?php echo $id;?>">
                
                <!--DADOS DO CAMBISTA-->
                <div class="page-header">
                    <h4>Dados do Cambista</h4>
                    <hr>
                </div>
                
                
                <div class="form-group">                 
                    <label for="status_check" class="col-sm-2 control-label">Ativo</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input id="status_check" name="status_check" type="checkbox" value="ativo"
                                    <?php
                                        if($cambista['flag_ativo']=="1")
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
                    <label for="regional_cambista" class="col-sm-2 control-label">Regional</label>
                    <div class="col-sm-10">
                        <select type="" class="form-control" id="regional_cambista" name="regional_cambista" placeholder="Nome" data-error="Por favor, informe o nome completo para o cambista." required>
                            <?php preeche_edit_regional_combo($cambista['tb_regional_id']) ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nome_cambista" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input 
                            type="text" class="form-control" id="nome_cambista"
                            name="nome_cambista" placeholder="Nome" 
                            data-error="Por favor, informe o nome completo para o cambista." required
                            value="<?php echo $cambista['nome_camb'] ?>"
                        >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                                
                <div class="form-group">
                    <label for="telefone_cambista" class="col-sm-2 control-label">Telefone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control js_phone_with_ddd" 
                               id="telefone_cambista" name="telefone_cambista" 
                               placeholder="Ex: (99) 99999-9999" data-error="Por favor, informe um número de telefone. Ex: (99) 99999-9999" required
                               value="<?php echo $cambista['telefone'] ?>"
                        >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <!--DADOS DOS LIMITES-->
                <div class="page-header">
                    <h4>Limites de Vendas</h4>
                    <hr>
                </div>

                <div class="row" id='limites_row'>
                    
<!--                    Input Limite Diário-->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="limite_diario" class="col-sm-2 control-label">Diário</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money" 
                                           placeholder="Limite diário de apostas" 
                                           aria-describedby="basic-addon1"
                                           id="limite_diario" name="limite_diario"
                                           data-error="Por favor, informe o limite diário de apostas em R$ para o cambista." 
                                           required
                                           style="width: 250px;"
                                           value="<?php echo $cambista['limite_diario'] ?>"
                                    >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="limite_individual" class="col-sm-2 control-label">Individual</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">R$</span>
                                    <input type="text" class="form-control js_money" 
                                           placeholder="Limite individual de apostas" 
                                           aria-describedby="basic-addon1"
                                           id="limite_individual" name="limite_individual"
                                           data-error="Por favor, informe o limite individual de apostas em R$ para o cambista." 
                                           required
                                           style="width: 250px;"
                                           value="<?php echo $cambista['limite_individual'] ?>"
                                    >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!--DADOS DAS COMISSÕES-->
                <div class="page-header">
                    <h4>Comissões</h4>
                    <hr>
                </div>

                <div class="row" id='limites_row'>
                    
<!--                    Input Limite Diário-->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comissao1" class="col-sm-2 control-label">Comissão</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">%</span>
                                    <input type="text" class="form-control" 
                                           placeholder="Um jogo" 
                                           aria-describedby="basic-addon1"
                                           id="comissao1" name="comissao1"
                                           data-error="Por favor, informa a comissão do cambista em % para apostas com 1 jogo." 
                                           required
                                           style="width: 250px;"
                                           value="<?php echo $cambista['comissao1'] ?>"
                                    >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <!--                    Input Limite Diário-->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comissao2" class="col-sm-2 control-label">Comissão</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">%</span>
                                    <input type="text" class="form-control" 
                                           placeholder="Dois jogos" 
                                           aria-describedby="basic-addon1"
                                           id="comissao2" name="comissao2"
                                           data-error="Por favor, informa a comissão do cambista em % para apostas com 2 jogo." 
                                           required
                                           style="width: 250px;"
                                           value="<?php echo $cambista['comissao2'] ?>"
                                    >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!--                    Input Limite Diário-->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comissao3" class="col-sm-2 control-label">Comissão</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">%</span>
                                    <input type="text" class="form-control" 
                                           placeholder="Três jogos ou mais" 
                                           aria-describedby="basic-addon1"
                                           id="comissao3" name="comissao3"
                                           data-error="Por favor, informa a comissão do cambista em % para apostas com 3 ou mais jogos." 
                                           required
                                           style="width: 250px;"
                                           value="<?php echo $cambista['comissao3'] ?>"
                                    >
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <!--DADOS DE ACESSO-->
                <div class="page-header">
                    <h4>Dados de Acesso</h4>
                    <hr>
                </div>
                
                <div class="form-group">
                    <label for="login_cambista" class="col-sm-2 control-label">Usuário</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login_cambista"
                               name="login_cambista" placeholder="Nome de usuário" 
                               data-error="Por favor, digite um nome de usuário." required
                               value="<?php echo $cambista['login'] ?>"
                        >
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button id="botao_salvar" type="submit" class="btn btn-primary pull-right">Salvar <span class="glyphicon glyphicon-floppy-save"></span></button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>


