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
            
            <form id="form_cad_usuario" data-toggle="validator" method="POST" action="../config/paciente/processa_cad_paciente.php">
                
                <!--DADOS DO USUÁRIO-->
                <div class="page-header">
                    <h4>Dados do Paciente</h4>
                    <hr>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipoPessoa" class="required">Nome</label>
                            <input type="text" class="form-control" required="">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sexo_div">Sexo</label>
                            <select class="form-control">
                                <option value="m">Masculino</option>
                                <option value="f">Feminino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dt-picker">Data/Hora</label>
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' id="datahora" name="datahora" class="form-control js_date_time"
                                       required="true"
                                       />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <br><br>
                <!--DADOS DE ACESSO-->
                <div class="page-header">
                    <h4>Endereço</h4>
                    <hr>
                </div>
                
               <div class="row">
                    
                   <div class="col-md-4">
                       <div class="form-group">
                           <label for="logradouro" class="required">Logradouro</label>
                           <input id="logradouro" nome="logradouro" type="text" class="form-control" required="">
                       </div>
                   </div>
                   
                   <div class="col-md-2">
                       <div class="form-group">
                           <label for="bairro" class="required">Bairro</label>
                           <input id="bairro" nome="bairro" type="text" class="form-control" required="">
                       </div>
                   </div>

                   <div class="col-md-1">
                       <div class="form-group">
                           <label for="numero" class="required">Número</label>
                           <input id="numero" nome="numero" type="text" class="form-control" required="">
                       </div>
                   </div>

                   <div class="col-md-1">
                       <div class="form-group">
                           <label for="complemento" class="required">Complemento</label>
                           <input id="complemento" nome="complemento" type="text" class="form-control">
                       </div>
                   </div>
                   
                   <div class="col-md-3">
                       <div class="form-group">
                           <label for="cidade" class="required">Cidade</label>
                           <input id="cidade" nome="cidade" type="text" class="form-control" required="">
                       </div>
                   </div>
                   
                   <div class="col-md-1">
                       <div class="form-group">
                           <label for="uf" class="required">UF</label>
                           <input id="uf" nome="uf  " type="text" class="form-control">
                       </div>
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