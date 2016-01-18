<?php
/**
 * Arquivo que faz a busca da propriedade de acordo com o cliente para o select no formuláriod e boletim.
 * @package view
 * @subpackage formularios
 * @since 1.0
 *  
 */

$page_title = 'SisLabWeb 1.0 - Cadastrar boletim de Solo'; //Título da página
//Includes necessários
include '../../view/template/cabecalho.php';  
require_once '../../view/restrito.php';
include '../../entidade/Cliente.php';
include '../../entidade/Solo.php';
include '../../entidade/BoletimSolo.php';
include '../../entidade/Pesquisador.php';
include '../../entidade/Propriedade.php';
//fim includes

//recebe do navgador ID do boletim, caso no livro de registro o pesquisador clique em EDITAR. Então a variável $editar fica setada.
if (isset($_GET['id'])) {
    $editar = (int) $_GET['id'];
}


$usuario = $_SESSION['usuarioNome']; 
//criação objetos
$dao = new Cliente();
$dao2 = new Solo();
$dao3 = new BoletimSolo();
$daoPesquisador = new Pesquisador();
$daoPropriedades = new Propriedade();
//fim criação objetos 

//Aqui caso seje para editar o boletim, Ele faz a procura no BD de acordo com o ID do boletim recebido pelo _GET do navegador
//Senão ele só lista as informações do BD, como as select do cliente, ID's quantidades e select do pesquisador.
if (isset($editar)) {
    $boletim = $dao3->lista_boletim_edicao($editar);
    $clientes = $dao->listar_cliente();
    $solos_boletim = $dao2->listar_solo_idboletim($editar);
    $solos = $dao2->listar_basico_solo();
    $contador_Amostras = $dao2->contador_amostra($editar);
    $pesquisadores = $daoPesquisador->lista_pesquisadores();
} else {
    $clientes = $dao->listar_cliente();
    $solos = $dao2->listar_basico_solo();
    $boletim = $dao3->lista_boletim();
    $ultimoIdBoletim = $dao3->lista_ultimo_id();
    $ultimoIdSolo = $dao2->lista_ultimo_id();
    $pesquisadores = $daoPesquisador->lista_pesquisadores();
}
//Foram inseridos o jquery e prototype e definido uma variável de conflito, pois o prototype conflita com o JQUERY na variavel $. então pra JQUERY fica $j.
?>

<script src="../../../sislabweb/resource/js/jquery.js"></script>
<script>  var $j = jQuery.noConflict();</script>

<script src="../../../sislabweb/resource/js/prototype.js"></script>

<script type="text/javascript" charset="utf-8">




//Função que carregas as propriedades de acordo com o cliente selecionado, ai preenche o select que mostra as propriedades de acordo com o cliente.
    function CarregaPropriedades(Cliente)
    {
        if (Cliente) {
            var myAjax = new Ajax.Updater("PropriedadesAjax", "buscar_propriedades.php?cliente=" + Cliente,
                    {
                        method: "get"
                    });
        }
    }


///Função do campo Input VALOR para mostrar virgulas e pontos automaticos.
    $j(document).ready(function () {

        $j("#Valor").mask('000.000.000.000.00', {reverse: true});

        $j("#Intervalo1").mask('000000', {reverse: true});
        $j("#Intervalo2").mask('000000', {reverse: true});

    });


    ///Função do botão remover dentro da tabela.
    (function ($) {
        RemoveTableRow = function (handler) {
            var tr = $(handler).closest('tr');
            tr.fadeOut(400, function () {
                tr.remove();
            });
            return false;
        };
    })(jQuery);

///Funcção do input data_entrada, que mostra um plugin com datas para clicar, ao inves de digitar.
    $j(document).ready(function () {
        $j('#Data_entrada').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: true,
            language: "pt-BR",
            calendarWeeks: true
        });

    });

//Função que verifica os campos que podem ser vazios ou não.
    function confere() {
        if (!document.getElementById("Clientess").selectedIndex) {
            alert("Selecione um cliente");
            return false;
        }

        if (!document.getElementById("Propriedades").selectedIndex) {
            alert("Selecione uma propriedade");
            return false;
        }

        if (!document.getElementById("Pesquisador").selectedIndex) {
            alert("Selecione um pesquisador");
            return false;
        }

        return true;
    }

    
    //Começo da função que quando tem amostras disponiveis, verifica a inserção caso haja inserida, pois no momento quando insere ele não deleta.
    //Também é a função que insere as disponiveis na tabela do boletim.
    var i = 0;
    var conflito = [0];
    var contador = 0;
    function addInput(divName, idAmostra) {
        for (i = 0; i < conflito.length; i++) {
            if (conflito[i] === idAmostra) {
                alert("Esta amostra já está inserida.");
            }
            else {
                if (i === 0) {

                    var newdiv = document.createElement('tr');
                    newdiv.innerHTML = "<tr><td><input style='width: 100px;' name='myInputs[" + contador + "][Id]' readonly='readonly' class='form-control' value='" + idAmostra + "' /></td>  <td>  <input class='form-control' style='width: 300px;' name='myInputs[" + contador + "][Identificacao]' class='form-control'/>       </td>   <td>     <input name='myInputs[" + contador + "][Rotina]' type='checkbox' value='true'/>  </td>   <td><input name='myInputs[" + contador + "][Mo]' type='checkbox' value='true' />    </div></td>    <td>          <input name='myInputs[" + contador + "][Micro]' type='checkbox' value='true' />       </td>        <td>   <input name='myInputs[" + contador + "][Textura]'  type='checkbox' value='true' />                 </div></td>          <td>                           <button type='button' class='btn btn-xs btn-danger' onclick='RemoveTableRow(this)'>Remover</button>  </td></tr>";
                    document.getElementById(divName).appendChild(newdiv);
                    conflito[i] = idAmostra;
                    contador = contador + 1;
                    return;
                }


            }
        }
    }



</script>

<div class="row">
    <br/><br/><br/>
    <div class="page-header">
        <?php
        //Caso editar seje cetado, header da pagina mostra Edição ou cadastar novo.
        if (isset($editar)) {
            echo "<center><h1>Editar boletim</h1></center>";
        } else {
            echo "<center><h1>Cadastrar novo boletim</h1></center>";
        }
        ?>
    </div>

<!-- Inicio do formulário -->
    <form onSubmit="return confere()" action="salvar_formulario_solo.php" method="post" role="form" class="form-inline">
        <div class="form">
            <label>Boletim nº:</label>
            <?php
            if (isset($editar)) {
                ?>
                <input class="form-control"  style="width: 70px; " readonly="readonly" name="Id"  value="<?php echo $boletim->Id; ?>"<?php
        } else {
                ?> <label class="form-control" style="width: 70px; background-color: #e3e3e3;"><?php
                       echo $ultimoIdBoletim['MaximoId'] + 1;
                   }
                   ?> 
        </div>

        <br /><br />


        <div>
            <label>Data de entrada:</label>
            <input class="form-control" name="Data_entrada" id="Data_entrada"  value="<?php
                   if (isset($editar)) {
                       echo $boletim->Data_entrada;
                   } else {
                       echo date("d/m/Y");
                   }
                   ?>" />

        </div>

        <br />

        <div>
            <label>Pesquisa:</label>
            <input type="checkbox"  name="Pesquisa" value="true" <?php
            if (isset($editar)) {
                if ($boletim->Pesquisa == 1) {
                    echo checked;
                }
            }
                   ?> />
        </div>

        <hr />


        <div class="form-inline">
            <label>Selecione um cliente:</label>
            <select style="min-width:65%" onchange="CarregaPropriedades(this.value)"  name="Id_cliente" id="Clientess" class="form-control">    
                <option> Selecione o cliente </option>
                <?php foreach ($clientes as $cliente) { ?>  

                    <option <?php
                    if (isset($editar)) {
                        if ($boletim->Id_cliente == $cliente->Id) {
                            echo "selected=selected";
                            $cliente_selecionado = $cliente->Id;
                        }
                    }
                    ?>

                        style="width: 900px;" name="<?php echo $cliente->Id; ?>" value="<?php echo $cliente->Id; ?>" ><?php echo $cliente->Nome; ?></option>
                    }
                <?php } ?>
            </select>
            <center><a href="form_cliente.php" class="btn btn-info" role="button">Cadastrar novo cliente</a></center>
        </div>

        <hr />


        <div class="form-inline" id="PropriedadesAjax">
            <label>Selecione uma propriedade:</label>
            <select style="min-width:61.2%" name="Propriedade" id="Propriedade" class="form-control">    
                <?php
                if (isset($editar)) {
                    $propriedades = $daoPropriedades->listar_propriedades_cliente($cliente_selecionado);
                    foreach ($propriedades as $propriedade) {
                        ?> 
                        <option   <?php
                if ($boletim->Propriedade == $propriedade->Id) {
                    echo "selected=selected";
                }
                        ?> value="<?php echo $propriedade->Id; ?>" name="Propriedade" id="Propriedade"><?php echo $propriedade->Nome; ?></option>  
                            <?php
                        }
                    } else {
                        echo '<option value="">Selecione a propriedade</option>';
                    }
                    ?>
            </select>
        </div>

        <hr />

        <div class="form-inline">
            <label>Selecione um pesquisador:</label>
            <select style="min-width:61.56%" name="Pesquisador" id="Pesquisador" class="form-control">    
                <option> Selecione um pesquisador responsável </option>
                <?php foreach ($pesquisadores as $pesquisador) { ?>  

                    <option <?php
                    if (isset($editar)) {
                        if ($boletim->Pesquisador == $pesquisador->Login) {
                            echo "selected=selected";
                        }
                    }
                    ?>

                        style="width: 750px;" id="optionCliente" name="<?php echo $pesquisador->Login; ?>" value="<?php echo $pesquisador->Login; ?>" ><?php echo $pesquisador->Login; ?></option>

                <?php } ?>
            </select>
            <center><a href="form_pesquisador.php" class="btn btn-info" role="button">Cadastrar novo pesquisador</a></center>
        </div>

        <hr />

        <div class="form-inline">
            <label>Tipo de ....</label>
        </div>


        <div class="form-group">
            <label>Cultura:</label>
            
            <input type="text" class="form-control" name="Cultura" id="Cultura" value="<?php
            if (isset($editar)) {
                echo $boletim->Cultura;
            }
        ?>"/>        
            
        </div>


        <div class="form-group" style="margin-left: 10%">
            <label >Sistema:</label>
                      <input type="text" class="form-control" name="Sistema" id="Sistema" value="<?php
            if (isset($editar)) {
                echo $boletim->Sistema;
            }
        ?>"/>   
        </div>


        <hr />


        <?php if (isset($editar)) {
            ?>  

            <hr>
            <label>Lista de amostras disponíveis para inserção no boletim</label>
            <table id="table1" class="table table-striped table-bordered display" style="width: 100%">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Pesquisador</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($solos as $solo) { ?>     

                        <tr>
                            <td>
                                <?php echo $solo->Id; ?>
                                <input name="Id_solo" type="hidden" value="<?php echo $solo->Id; ?>" />
                            </td>

                            <td>
                                <?php echo date("d/m/Y H:m:s", strtotime($solo->Data_cadastro)); ?>
                            </td>

                            <td>
                                <?php echo $solo->Pesquisador; ?>
                            </td>

                            <td>
                                <input onClick="addInput('dynamicInput', <?php echo $solo->Id; ?>)" class="btn btn-xs btn-success" value="Inserir" type="button">

                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <hr>


            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Número Laboratório</th>
                        <th>Identificação</th>
                        <th>Rotina</th>
                        <th>M.O.</th>
                        <th>Micro</th>
                        <th>Textura</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <?php
                if (isset($editar)) {
                    foreach ($solos_boletim as $solo) {
                        $contador_Amostras++;
                        ?><tr>
                            <td>
                                <input style='width: 100px;' name='myInputs[<?php echo $contador_Amostras ?>][Id]' readonly='readonly' class='form-control' value='<?php echo $solo->Id; ?>' />
                            </td> 

                            <td>  
                                <input class='form-control' style='width: 300px;' name='myInputs[<?php echo $contador_Amostras ?>][Identificao]' class='form-control' value='<?php echo $solo->Identificao; ?>'/>       
                            </td> 

                            <td> 
                                <input name='myInputs[<?php echo $contador_Amostras ?>][Rotina]' type='checkbox' value='true'  <?php
            if ($solo->Rotina == 1) {
                echo checked;
            }
                        ?> />
                            </td> 

                            <td><input name='myInputs[<?php echo $contador_Amostras ?>][Mo]' type='checkbox' value='true'   <?php
                    if ($solo->Mo == 1) {
                        echo checked;
                    }
                        ?> />    
                            </td>   

                            <td>       
                                <input name='myInputs[<?php echo $contador_Amostras ?>][Micro]' type='checkbox' value='true'   <?php
                    if ($solo->Micro == 1) {
                        echo checked;
                    }
                        ?> />   
                            </td> 

                            <td>  
                                <input name='myInputs[<?php echo $contador_Amostras ?>][Textura]'  type='checkbox' value='true'   <?php
                    if ($solo->Textura == 1) {
                        echo checked;
                    }
                        ?> />     
                            </td>     

                            <td>       
                                <input type='button' name='deletar' class='btn btn-xs btn-danger' value='Remover' onclick='RemoveTableRow(this);
                                                    DeletarBD(<?php echo $editar ?>);' />
                            </td>
                        </tr> 
                        <div id="amostraSolo">
                            <tbody id="dynamicInput" id="amostraSolo">
                            </tbody>             
                        </div>


                        </div>


                        <?php
                    }
                }
                ?>

            </table>


            <a class="btn btn-xs btn-info" style="font-size: 15px; margin-left: 80% " href="../solos/digita_result_externos.php?id=<?php echo $editar; ?>">Editar Resultado das amostras</a>                              


        <?php } else {
            ?>


            <center><div class="center">
                    <label>Id's disponiveis a partir do número</label>
                    <label class='form-control'><?php echo $ultimoIdSolo['MaximoId'] ?></label>

                    <p><label>Insira o intervalo</label></p>

                    De<input type="" class="form-control" name="Intervalo1" id="Intervalo1" value="<?php echo $ultimoIdSolo['MaximoId'] + 1 ?>" />
                    Até<input type="" class="form-control" name="Intervalo2" id="Intervalo2" value="" />

                </div><br>
                <label>Insira apenas o prefixo da identificação - Será sequencial</label>
                <input class='form-control' placeholder="Exemplo: 1-ABC    2-ABC" style='width: 300px;' name='Identificacao' class='form-control' value=''/>      
                <BR><br>
                <label>Rotina</label>
                <input name='Rotina' type='checkbox' value='true' >
                <br>
                <label>Mo</label>                                
                <input name='Mo' type='checkbox' value='true' />
                   <br>
                <label>Micro</label>
                <input name='Micro' type='checkbox' value='true' />
                   <br>
                <label>Textura</label>
                <input name='Textura' type='checkbox' value='true' />


            </center>
        <?php } ?>

        <hr />


        <div class="form-inline">
            <label>Observações</label>
            <input rows="5" style="width: 85%; height: 50px;"class="form-control" name="Observacao" id="Observacao"  value="<?php
        if (isset($editar)) {
            echo $boletim->Observacao;
        }
        ?>" />

        </div>

        <hr />

        <div class="form-inline">
            <label style="margin-left:35%">Valor: </label>         
            <input type="" class="form-control" name="Valor" id="Valor" value="<?php
            if (isset($editar)) {
                echo $boletim->Valor;
            }
            else echo "R$ "
        ?>"/>        
        </div>



        <hr />

        <?php if (isset($editar)) {
            ?> <button class="btn btn-success" type="submit" value="Salvar alterações">Salvar alterações</button>
            <a href="../solos/imprime_resultados_boletim.php?id=<?php echo $boletim->Id?>" class="btn btn-info" role="button">Imprime resultados</a>

            <a href="solos/digita_result_externos.php" class="btn btn-info" role="button">Exportar para Excel</a>


            <?php
        } else {
            ?>      <button class="btn btn-success" type="submit" value="Cadastrar">Cadastrar </button>
            <input class="btn btn-warning" type="button" value="Voltar" onClick="history.go(-1)"> 
            <?php
        }
        ?>

    </form>
<!-- Fim do formulário -->
</div>

<?php
include '../../view/template/rodape.php';
?>