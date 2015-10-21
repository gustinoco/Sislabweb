<?php
$page_title = 'SisLabWeb 1.0 - Cadastrar boletim de Solo';


include '../../view/template/cabecalho.php';
require_once '../../view/restrito.php';
include '../../entidade/Cliente.php';
include '../../entidade/Sistema.php';
include '../../entidade/Cultura.php';
include '../../entidade/Solo.php';
include '../../entidade/BoletimSolo.php';
include '../../entidade/Pesquisador.php';
include '../../entidade/Propriedade.php';


if (isset($_GET['id'])) {
    $editar = (int) $_GET['id'];
}
$usuario = $_SESSION['usuarioNome'];


$dao = new Cliente();
$dao2 = new Solo();
$dao3 = new BoletimSolo();
$daoCultura = new Cultura();
$daoSistemas = new Sistema();
$daoPesquisador = new Pesquisador();
$daoPropriedades = new Propriedade();
if (isset($editar)) {
    $boletim = $dao3->lista_boletim_edicao($editar);
    $culturas = $daoCultura->listar_culturas();
    $sistemas = $daoSistemas->listar_sistemas();
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
    $culturas = $daoCultura->listar_culturas();
    $sistemas = $daoSistemas->listar_sistemas();
    $ultimoIdSolo = $dao2->lista_ultimo_id();
    $pesquisadores = $daoPesquisador->lista_pesquisadores();
}
?>
<script src="../../../sislabweb/resource/js/jquery.js"></script>
<script>  var $j = jQuery.noConflict();</script>

<script src="../../../sislabweb/resource/js/prototype.js"></script>

<script type="text/javascript" charset="utf-8">





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
            <label >Pesquisa:</label>
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
            <a href="form_cliente.php" class="btn btn-info" role="button">Cadastrar novo cliente</a>
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
            <a href="form_pesquisador.php" class="btn btn-info" role="button">Cadastrar novo pesquisador</a>
        </div>

        <hr />

        <div class="form-inline">
            <label>Tipo de ....</label>
        </div>


        <div class="form-group">
            <label>Cultura:</label>
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


        <div class="form-group" style="margin-left: 10%">
            <label >Sistema:</label>
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


        <hr />


        <?php if (isset($editar)) {
            ?>  



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

                </div></center>
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
            <input type="" class="form-control" placeholder="Exemplo: 000.000.00" name="Valor" id="Valor" value="<?php
            if (isset($editar)) {
                echo $boletim->Valor;
            }
            ?>"/>        
        </div>



        <hr />

        <?php if (isset($editar)) {
            ?> <button class="btn btn-success" type="submit" value="Salvar alterações">Salvar alterações</button>
            <a href="solos/digita_result_externos.php" class="btn btn-info" role="button">Imprime comprovante</a>

            <a href="solos/digita_result_externos.php" class="btn btn-info" role="button">Exportar para Excel</a>


            <?php
        } else {
            ?>      <button class="btn btn-success" type="submit" value="Cadastrar">Cadastrar </button>
            <input class="btn btn-warning" type="button" value="Voltar" onClick="history.go(-1)"> 
            <?php
        }
        ?>

    </form>
</div>

<?php
include '../../view/template/rodape.php';
?>