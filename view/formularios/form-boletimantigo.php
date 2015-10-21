<?php
$page_title = 'SisLabWeb 1.0 - Cadastrar boletim de Solo';

include '../../view/template/cabecalho.php';
require_once '../../view/restrito.php';
include '../../entidade/Cliente.php';
include '../../entidade/Sistema.php';
include '../../entidade/Cultura.php';
include '../../entidade/Solo.php';
include '../../entidade/BoletimSolo.php';

if (isset($_GET['id'])) {
    $editar = (int) $_GET['id'];
}


$dao = new Cliente();
$dao2 = new Solo();
$dao3 = new BoletimSolo();
$daoCultura = new Cultura();
$daoSistemas = new Sistema();

if (isset($editar)) {
    $boletim = $dao3->lista_boletim_edicao($editar);
    $culturas = $daoCultura->listar_culturas();
    $sistemas = $daoSistemas->listar_sistemas();
    $clientes = $dao->listar_cliente();
    $solos_boletim = $dao2->listar_solo_idboletim($editar);
    $solos = $dao2->listar_basico_solo();
    $contador_Amostras = $dao2->contador_amostra($editar);
} else {
    $clientes = $dao->listar_cliente();
    $solos = $dao2->listar_basico_solo();
    $boletim = $dao3->lista_boletim();
    $ultimoId = $dao3->lista_ultimo_id();
    $culturas = $daoCultura->listar_culturas();
    $sistemas = $daoSistemas->listar_sistemas();
}
?>


<script type="text/javascript" charset="utf-8">

    //tabela das amostras disponiveis, plugin datatable, ativado scroll. Tem um bug só que tem que clicar para organizar o TD.
    $(document).ready(function () {
        $('#table1').DataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,
        });
    });

    //tabela das amostras Inseridas, plugin datatable.
    $(document).ready(function () {
        $('#table2').dataTable({
            "scrollCollapse": true,
            "paging": false,
            "bFilter": false

        });
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





    function mostraClientes(cliente) {

        return cliente;
    }



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

///Função do campo Input VALOR para mostrar virgulas e pontos automaticos.
    $(document).ready(function () {

        $("#Valor").mask('000.000.000.000,00', {reverse: true});

    });

///Função que preenche os campos Cliente e propriedade automaticamente ao clicar na option Cliente.
    function preencheCliente() {
        var x = document.getElementById("Clientess").value;
        document.getElementById("labelCliente").innerHTML = x;

    }

///Funcção do input data_entrada, que mostra um plugin com datas para clicar, ao inves de digitar.
    $(document).ready(function () {
        $('#Data_entrada').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: true,
            language: "pt-BR",
            calendarWeeks: true
        });

    });

    function confere() {
        if (document.getElementById("Valor").value == "") {
            alert("Preencha um valor");
            return false;
        }
        if (document.getElementById("Al").value == "") {
            alert("Por favor, preencha o Al.");
            return false;
        }
        if (document.getElementById("Telefone").value == "") {
            alert("Por favor, preencha o cnpj.");
            return false;
        }
        if (document.getElementById("Nome").value == "") {
            alert("Por favor, preencha o nome.");
            return false;
        }
        return true;
    }

</script>

<div class="row">

    <br/><br/><br/>

    <div class="page-header">
        <?php
        if (isset($editar)) {
            echo "<center><h1>Editar boletim</h1></center>";
        } else {
            echo "<center><h1>Cadastrar novo boletim</h1></center>";
        }
        ?>
    </div>

    <form onSubmit="return confere()" action="salvar_formulario_solo.php" method="post" role="form" class="form-inline">


        <div class="form-inline">



            <label>Selecione um cliente:</label>
            <select style="min-width:65%" onclick="preencheCliente()"  name="Id_cliente" id="Clientess" class="form-control">    
                <option> Selecione o cliente </option>
                <?php foreach ($clientes as $cliente) { ?>  

                    <option <?php
                    if (isset($editar)) {
                        if ($boletim->Id_cliente == $cliente->Id) {
                            echo "selected=selected";
                        }
                    }
                    ?>

                        style="width: 900px;" id="optionCliente" name="<?php echo $cliente->Id; ?>" value="<?php echo $cliente->Id; ?>" ><?php echo $cliente->Nome; ?></option>
                    }
                <?php } ?>
            </select>
            <a href="entrada_dados.php" class="btn btn-info" role="button">Cadastrar novo cliente</a>
        </div>

        <hr>


        <div class="form-group">
            <label>Boletim nº:</label>
            <?php
            if (isset($editar)) {
                ?>
                <input class="form-control"  style="width: 70px; " readonly="readonly" name="Id"  value="<?php echo $boletim->Id; ?>"<?php
            } else {
                ?> <label class="form-control" style="width: 70px; background-color: #e3e3e3;"><?php
                       echo $ultimoId['MaximoId'] + 1;
                   }
                   ?> 
        </div>

        <div class="form-group">
            <label>Data de entrada:</label>
            <input class="form-control" name="Data_entrada" id="Data_entrada"  value="<?php
            if (isset($editar)) {
                echo $boletim->Data_entrada;
            } else {
                echo date("d/m/Y");
            }
            ?>" />

        </div>

        <div class="form-group">
            <label>Pesquisa:</label>
            <input type="checkbox"  name="Pesquisa" value="true" <?php
            if (isset($editar)) {
                if ($boletim->Pesquisa == 1) {
                    echo checked;
                }
            }
            ?> />
        </div>

        <hr>

        <div class="form-inline">
            <label>Dados do cliente</label>
        </div>

        <div class="form-group">
            <label>Cliente:</label>
            <?php if (isset($editar)) {
                ?>                <label type="text"  id="labelCliente" value="<?php $cliente->Nome_propriedade ?>" style="width: 400px; background-color: #e3e3e3;" class="form-control"/>
            <?php } else { ?>
                <label type="text"  id="labelCliente" style="width: 400px; background-color: #e3e3e3;" class="form-control"/>
            <?php } ?>
        </div>

        <div class="form-group">
            <label style="margin-left:70px">Cultura:</label>
            <select name="Cultura" class="form-control">    

                <?php foreach ($culturas as $cultura) { ?>
                    <option  <?php
                    if (isset($editar)) {
                        if ($boletim->Cultura == $cultura->Nome) {
                            echo "selected=selected";
                        }
                    }
                    ?>
                        name="culturas"  value="<?php echo $cultura->Nome ?>"> <?php echo $cultura->Nome; ?></option>
                    }
                <?php } ?>


            </select>


        </div>

        <div class="form-group" style="margin-top:10px">
            <label>Propriedade:</label>
            <label type="text" style="width: 400px; background-color: #e3e3e3;" id="labelPropriedade" class="form-control"  />
        </div>
        <div class="form-group">

            <label style="margin-left:30px">Sistema:</label>
            <select name="Sistema" class="form-control">    

                <?php foreach ($sistemas as $sistema) { ?>
                    <option  <?php
                    if (isset($editar)) {
                        if ($boletim->Sistema == $sistema->Nome) {
                            echo "selected=selected";
                        }
                    }
                    ?>
                        name="sistema"  value="<?php echo $sistema->Nome ?>"><?php echo $sistema->Nome; ?></option>
                    }
                <?php } ?>
            </select>
        </div>
        <hr>

        <div class="form-inline">
            <label style="margin-left:35%">Valor: </label>         
            <input type="" class="form-control" name="Valor" id="Valor" value="<?php
            if (isset($editar)) {
                echo $boletim->Valor;
            }
            ?>"/>        
        </div>

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


                    <?php
                }
            } else {
                ?>   

                <div id="amostraSolo">
                    <tbody id="dynamicInput" id="amostraSolo">
                    </tbody>             
                </div>
            <?php }
            ?>
        </table>

        <?php if (isset($editar)) {
            ?><a class="btn btn-xs btn-info" style="font-size: 15px; margin-left: 80% " href="../solos/digita_result_externos.php?id=<?php echo $editar; ?>">Editar Resultado das amostras</a>                              
        <?php } ?>      
        <hr>

        <div class="form-inline">
            <label>Observações</label>
            <input rows="5" style="width: 85%; height: 50px;"class="form-control" name="Observacao" id="Observacao"  value="<?php
            if (isset($editar)) {
                echo $boletim->Observacao;
            }
            ?>" />

        </div>



        <hr>

        <?php if (isset($editar)) {
            ?> <button class="btn btn-success" type="submit" value="Salvar alterações">Salvar alterações</button>


            <?php
        } else {
            ?>      <button class="btn btn-success" type="submit" value="Cadastrar">Cadastrar </button><?php
        }
        ?>

        <hr>
        <a href="solos/digita_result_externos.php" class="btn btn-info" role="button">Imprime comprovante</a>

        <a href="solos/digita_result_externos.php" class="btn btn-info" role="button">Exportar para Excel</a>

    </form>


</div>

