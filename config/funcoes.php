<?php

    function usuario_modal($id, $nome, $login, $permissao, $flag_atv, $criado, $modificado)
    {
        
        $perm = sel_permissao($permissao);
        
        if(!isset($modificado))
        {
            $modificado = "-------";
        }
        
        if($flag_atv === "1")
        {
            $status = "Ativo";
        }
        else{
            $status = "Inativo";
        }
        
        $codigo_html=
       '<div class="modal fade" id="modal_dados_'.$id.'" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">'.$nome.'</h4>
              </div>
              
              <div class="modal-body">
                
                <table class="table table-hover table-striped">
                    <tbody>
                        <th>Status:</th>
                            <td>'.$status.'</td>
                        </tr>
                        <tr>
                            <th>Nome de usuário:</th>
                            <td>'.$login.'</td>
                        </tr>
                        <tr>
                            <th>Permissão de acesso:</th>
                            <td>'.$perm.'</td>
                        </tr>
                        <tr>
                            <th>Criado em:</th>
                            <td>'.date("d/m/Y - H:i:s", strtotime($criado)).'</td>
                        </tr>
                        <tr>
                            <th>Modificado em:</th>
                            <td>'.date("d/m/Y - H:i:s", strtotime($modificado)).'</td>
                        </tr>
                    </tbody>
                </table>
                
                
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              </div>
              
            </div>
          </div>
        </div>';
        
        return $codigo_html;
    }
    
    function altera_senha_usuario_modal($id, $nome)
    {
        $codigo_html = 
                '<div class="modal fade" id="modal_altera_senha_'.$id.'" tabindex="-1" role="dialog" aria-labelledby="alteraSenhaModalw">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="alteraSenhaModal">'.$nome.'<small style="color: graytext"> (Alterar Senha)</small></h4>
                            </div>

                            <div class="modal-body">
                                                                
                                <form method="POST" action="../config/usuario/processa_alter_senha.php?id='.$id.'"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Nova Senha:</label><br>
                                            <input type="password" class="form-control" name="digita_senha" placeholder="Digita a senha" required/>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <label>Confirmação:</label><br>
                                            <input type="password" class="form-control" name="confirma_senha" placeholder="Digite novamente" required/>
                                        </div>

                                    </div>
                                    <br><br>                                 
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                ';
        
        return $codigo_html;
    }
    
    function  cambista_modal($id, $nome, $telefone, $limite_diario, $limite_individual, 
            $comissao1, $comissao2, $comissao3, $login, $senha, $tb_regional_id, $flag_ativo,
            $criado, $modificado)
    {
        
        if(!isset($modificado))
        {
            $modificado = "-------";
        }
        
        if($flag_ativo === "1")
        {
            $status = "Ativo";
        }
        else{
            $status = "Inativo";
        }
        
        $nome_regional = mysqli_fetch_assoc(seleciona_regional($tb_regional_id));
        
        
        $codigo_html=
       '<div class="modal fade" id="modal_cambista_'.$id.'" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">'.$nome.'</h4>
              </div>
              
              <div class="modal-body">
                
                <table class="table table-hover table-striped">
                    <tbody>
                        <th>Status:</th>
                            <td>'.$status.'</td>
                        </tr>
                        <tr>
                            <th>Nome:</th>
                            <td>'.$nome.'</td>
                        </tr>
                        <tr>
                            <th>Nome de usuário:</th>
                            <td>'.$login.'</td>
                        </tr>
                        <tr>
                            <th>Telefone:</th>
                            <td>'.$telefone.'</td>
                        </tr>
                        <tr>
                            <th>Regional:</th>
                            <td>'.$nome_regional['nome_reg'].'</td>
                        </tr>
                        <tr>
                            <th>Limite Diário:</th>
                            <td>R$'.$limite_diario.'</td>
                        </tr>
                        <tr>
                            <th>Limite Individual:</th>
                            <td>R$'.$limite_individual.'</td>
                        </tr>
                        <tr>
                            <th>Comissão 1:</th>
                            <td>'.$comissao1.'%</td>
                        </tr>
                        <tr>
                            <th>Comissão 2:</th>
                            <td>'.$comissao2.'%</td>
                        </tr>
                        <tr>
                            <th>Comissão 3:</th>
                            <td>'.$comissao3.'%</td>
                        </tr>
                        <tr>
                            <th>Criado em:</th>
                            <td>'.date("d/m/Y - H:i:s", strtotime($criado)).'</td>
                        </tr>
                        <tr>
                            <th>Modificado em:</th>
                            <td>'.date("d/m/Y - H:i:s", strtotime($modificado)).'</td>
                        </tr>
                    </tbody>
                </table>
                
                
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              </div>
              
            </div>
          </div>
        </div>';
        
        return $codigo_html;
    }
    
    function altera_senha_cambista_modal($id, $nome)
    {
        $codigo_html = 
                '<div class="modal fade" id="modal_altera_senha_cambista'.$id.'" tabindex="-1" role="dialog" aria-labelledby="alteraSenhaModalw">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="alteraSenhaModal">'.$nome.'<small style="color: graytext"> (Alterar Senha)</small></h4>
                            </div>

                            <div class="modal-body">
                                                                
                                <form method="POST" action="../config/cambista/processa_alter_senha.php?id='.$id.'"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Nova Senha:</label><br>
                                            <input type="password" class="form-control" name="digita_senha" placeholder="Digita a senha" required/>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <label>Confirmação:</label><br>
                                            <input type="password" class="form-control" name="confirma_senha" placeholder="Digite novamente" required/>
                                        </div>

                                    </div>
                                    <br><br>                                 
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                ';
        
        return $codigo_html;
    }
    
    function finalizar_partida_modal($id, $times, $id_campeonato)
    {
        $campeonato = seleciona_campeonato_id($id_campeonato);
        
        $codigo_html = 
                '<div class="modal fade" id="modal_finalizar_partida_'.$id.'" tabindex="-1" role="dialog" aria-labelledby="finaliza_partida">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="finaliza_partida">'.$campeonato.'<small style="color: graytext"> (Finalizar Partida)</small></h4>
                            </div>

                            <div class="modal-body">
                                                                
                                <form method="POST" action="../config/jogo/processa_finalizacao_jogo.php?id_jogo='.$id.'"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>'.($times[0]).'</label><br>
                                            <input type="text" class="form-control js_goals" name="gols_casa" placeholder="Quantidade de gols" required/>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <label>'.($times[1]).'</label><br>
                                            <input type="text" class="form-control js_goals" name="gols_fora" placeholder="Quantidade de gols" required/>
                                        </div>

                                    </div>
                                    <br><br>                                 
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Finalizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                ';
       return $codigo_html;
    }
    
    function escreve_cotacoes
    (
        $casa, $empate, $fora, $gol_meio, $mais_2gm, $menos_3gm, 
        $ambas_marcam, $casa_empate, $fora_empate, $casa_marca, $fora_marca, 
        $casa_ou_fora, $casavence_foramarca, $foravence_casamarca, $casavence_zero, 
        $foravence_zero
    )
    {
        $html = "";
        
        $html .='<p align="justify">';
        $html .='<small>Casa: <b>' . $casa . '</b> | </small>';
        $html .='<small>Empate: <b>' . $empate . '</b> | </small>';
        $html .='<small>Fora: <b>' . $fora . '</b> | </small>';
        $html .='<small>1.5 Gol: <b>' . $gol_meio . '</b> | </small>';
        $html .='<small>+2.5 Gols: <b>' . $mais_2gm . '</b> | </small>';
        $html .='<small>-2.5 Gols: <b>' . $menos_3gm . '</b> | </small>';
        $html .='<small>Ambas: <b>' . $ambas_marcam . '</b> | </small>';
        $html .='<small>Casa/Empate: <b>' . $casa_empate . '</b> | </small>';
        $html .='<small>Fora/Empate: <b>' . $fora_empate . '</b> | </small>';
        $html .='<small>Casa Marca: <b>' . $casa_marca . '</b> | </small>';
        $html .='<small>Fora Marca: <b>' . $fora_marca . '</b> | </small>';
        $html .='<small>Casa ou Fora: <b>' . $casa_ou_fora . '</b> | </small>';
        $html .='<small>Casa Vence e Fora Marca: <b>' . $casavence_foramarca . '</b> | </small>';
        $html .='<small>Fora Vence e Casa Marca: <b>' . $foravence_casamarca . '</b> | </small>';
        $html .='<small>Casa Vence de Zero: <b>' . $casavence_zero . '</b> | </small>';
        $html .='<small>Fora Vence de Zero: <b>' . $foravence_zero . '</b></small>';
        $html .='</p>';
        
        return $html;
    }
?>
