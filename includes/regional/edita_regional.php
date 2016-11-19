<?php
    $id = $_GET['id_regional'];
    
    //Dados do usuário
    $usuario = seleciona_regional($id);
    $regional = mysqli_fetch_assoc($usuario);
?>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-edit"></i> EDITAR REGIONAL
        </div><br>

        <div id="filtros" style="padding-left: 20px">
            <a id="voltar_pagina" href="menu.php" class="btn btn-primary" title="Voltar ao início">
                <span class="glyphicon glyphicon-home"></span>
            </a>
            <a id="voltar_lista" href="javascript:history.back()" class="btn btn-primary" title="Voltar">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>                        
        </div>

        <div class="panel-body">
            
            <form id="form_cad_regional" data-toggle="validator" class="form-horizontal" method="POST" action="../config/regional/processa_edicao_regional.php?id_regional=<?php echo $id; ?>">
                
                <!--DADOS DA REGIONAL-->
                <div class="page-header">
                    <h4>Dados da Regional</h4s>
                    <hr>
                </div>
                
                
                <div class="form-group">                 
                    <label for="status_check" class="col-sm-2 control-label">Ativo</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input id="status_check" name="status_check" type="checkbox" value="ativo"
                                    <?php
                                        if($regional['flag_ativo']=="1")
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
                    <label for="nome_regional" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nome_regional"
                               name="nome_regional" placeholder="Nome" 
                               data-error="Por favor, informe o nome completo para a regional." 
                               required
                               value="<?php echo $regional['nome_reg']; ?>"
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

