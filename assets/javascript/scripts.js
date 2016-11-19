//Função javascript que confirma a exclusão de registros e chama a devida função
function confirmaExclusao(id, nome, desc_operacao, tipo_registro){
    var resposta = confirm(
        "Tem certeza que deseja excluir permanentemente os registros "+desc_operacao+": "+nome+"?"
    );
    
    if(resposta === true){
        window.location.href = "./../config/"+tipo_registro+"/processa_rem_"+tipo_registro+".php?id="+id;
    }
}

//Função javascript que faz o controle dos elementos das DataTables
function DataTablesConfig(id)
{
    $(document).ready(function () {
        $("#" + id).dataTable({
            "oLanguage": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de <b>_START_</b> à <b>_END_</b> de um total de <b>_TOTAL_</b> registros",
                "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "<span class='glyphicon glyphicon-filter'></span> _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "<span class='glyphicon glyphicon-search'></span>",
                "oPaginate": {
                    "sNext": "<span class='glyphicon glyphicon-chevron-right'></span>",
                    "sPrevious": "<span class='glyphicon glyphicon-chevron-left'></span>",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
}

function customDatepickerFull(classe)
{
    $(document).ready(function (){
       $('.'+classe).datetimepicker({
            format: 'd/m/Y H:i',
            allowTimes:['00:00', '00:30', '01:00', '01:30', '2:00', '02:30',
            '3:00', '3:30', '04:00', '04:30', '05:00', '05:30','06:00', '06:30', 
            '07:00', '7:30', '8:00', '08:30', '9:00', '9:30', '10:00', '10:30', 
            '11:00','11:30','12:00', '12:30', '13:00','13:30', '14:00', '14:30', 
            '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30',
            '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', 
            '23:00', '23:30'
           ],
        });
        
        $.datetimepicker.setLocale('pt-BR');
    });
}

function customDatepicker(classe)
{
    $(document).ready(function (){
       $('.'+classe).datetimepicker({
            format: 'd/m/Y',
            timepicker: false
        });
        
        $.datetimepicker.setLocale('pt-BR');
    });
}

function desmarcaCheckbox(ativo_check, cancelado_check, finalizado_check)
{
    var ativo = "#" + ativo_check;
    var cancelado = "#" + cancelado_check;
    var finalizado = "#" + finalizado_check;
    
//    document.write(ativo+"<br>");
//    document.write(cancelado+"<br>");
//    document.write(finalizado+"<br>");
    
    $(ativo).click(function () {
            
            //alert('Cancelado desmarcado');
            $(cancelado).prop("checked", false);

            //alert('Finalizado desmarcado');
            $(finalizado).prop("checked", false);
        }
    );
    
    $(cancelado).click(function () {
            
            //alert('Cancelado desmarcado');
            $(ativo).prop("checked", false);

            //alert('Finalizado desmarcado');
            $(finalizado).prop("checked", false);
        }
    );
    
    $(finalizado).click(function () {
            
            //alert('Cancelado desmarcado');
            $(ativo).prop("checked", false);

            //alert('Finalizado desmarcado');
            $(cancelado).prop("checked", false);
        }
    );
    
}

//function listaCampeonatos(){
//    $.ajax({
//        url: 'http://localhost/projetos/centraljogos/webservice/listagem.php',
//        type: 'GET',
//        dataType: 'json',
//        data: {type:'listaCampeonatos'},
//        ContentType: 'application/json',
//        success: function(response){
//
//            alert(JSON.stringify(response));
//
//            /*for (i=0 ; i<response.json.length ; i++){
//                alert('Entrou no for / Pos. array: '+i);
//                console.log(response.json[i].nome_campeonato);
//                alert(response.json[i].nome_campeonato);
//            }*/
//
//            for (i=0 ; i<response.json.length ; i++){
//                //alert('Entrou no for / Pos. array: '+i);
//                console.log(response.json[i].campeonato.nome_campeonato);
//                var camp = (response.json[i].campeonato.nome_campeonato);
//
//                var retornoHTML = '';
//    
//                retornoHTML += '<div id="painel_partidas" class="panel panel-primary panel-heading-margin">';
//                    
//                    retornoHTML += '<div class="panel-heading">';
//                        retornoHTML += '<center>';
//                            retornoHTML += '<b>Brasil &raquo; Série A - 19/10/2016</b>';
//                            retornoHTML += '<button data-toggle="collapse" data-target="#partida" class="btn btn-default btn-xs pull-right"><i class="fa fa-compress"></i></button>';
//                        retornoHTML += '</center>';
//                    retornoHTML += '</div>';
//
//                    retornoHTML += '<div id="partida">';
//                        retornoHTML += '<div class="w3-border">';
//                            retornoHTML += '<table>';
//                                retornoHTML += '<thead>';
//                                    retornoHTML += '<tr style="height: 100%">';
//                                        retornoHTML += '<td>';
//                                            retornoHTML += '<div style="background-color: #999999; color: white;">';
//                                                retornoHTML += '&nbsp; Flamengo X São Paulo';
//                                                retornoHTML += '<span class="pull-right">';
//                                                    retornoHTML += '15:30 &nbsp;';
//                                                    retornoHTML += '<button class="btn btn-danger btn-xs pull-right" disabled="true">';
//                                                        retornoHTML += '<span class="fa fa-close"> Limpar</span>';
//                                                    retornoHTML += '</button>';
//                                                retornoHTML += '</span>';
//                                            retornoHTML += '</div>';
//                                        retornoHTML += '</td>';
//                                    retornoHTML += '</tr>';
//                                retornoHTML += '</thead>';
//                            retornoHTML += '</table>';
//                            
//                            retornoHTML += '<center>';
//                                retornoHTML += '<button class="btn btn-xs btn-danger" onclick="listaCampeonatos()"><i class="fa fa-search"></i>';
//                                    retornoHTML += 'Testar JSON';
//                                retornoHTML += '</button>';
//                            retornoHTML += '</center>';
//                                                        
//                        retornoHTML += '</div>';
//                    retornoHTML += '</div>';
//                    
//                retornoHTML += '</div>';
//
//                $('#resultado').html(retornoHTML);
//            }
//        },
//        error: function(err){
//            alert('Ocorreu um erro ao se comunicar com o servidor! Por favor, entre em contato com o administrador ou tente novamente mais tarde.');
//            console.log(err);
//        }
//    });
//}