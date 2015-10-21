<?php
require_once '../../view/restrito.php';
include '../../entidade/Cliente.php';
include '../../entidade/Propriedade.php';
include_once __DIR__ . '/../conf/conexao.php';

$dao = new Cliente();
$daoPropriedade = new Propriedade();



if (isset($_GET['id'])) {
    $editar = (int) $_GET['id'];
    $cliente = $dao->listar_cliente_especifico($editar);
    $propriedades = $daoPropriedade->listar_propriedades_cliente($editar);
    $page_title = "SISLABWEB 1.0 - Editar cliente = " . $editar;
    $contador_Amostras = $daoPropriedade->contador_amostra($editar);
} else {
    $page_title = "SISLABWEB 1.0 - Cadastrar Cliente";
}

include '../../view/template/cabecalho.php';
?>



<script>

    function appendText() {
        var txt1 = "<p>Text.</p>"; // Create text with HTML
        var txt2 = $("<p></p>").text("Text."); // Create text with jQuery
        var txt3 = document.createElement("p");
        txt3.innerHTML = "Text."; // Create text with DOM
        $("body").append(txt1, txt2, txt3); // Append new elements
    }

   $(document).ready(function () {
        $('#Cep').mask('00000-000');
        $('#Fone').mask('(00) 0000-0000');
        $('#Fax').mask('(00) 0000-0000');
        $('#Celular').mask('(00) 0000-0000');
        $('#Cpf').mask('000.000.000-00', {reverse: true});
        $('#Cnpj').mask('00.000.000/0000-00', {reverse: true});
    });
//valida o CPF digitado
    function ValidarCPF(Objcpf) {
        var cpf = Objcpf.value;
        exp = /\.|\-/g
        cpf = cpf.toString().replace(exp, "");
        var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
        var soma1 = 0, soma2 = 0;
        var vlr = 11;
        for (i = 0; i < 9; i++) {
            soma1 += eval(cpf.charAt(i) * (vlr - 1));
            soma2 += eval(cpf.charAt(i) * vlr);
            vlr--;
        }
        soma1 = (((soma1 * 10) % 11) == 10 ? 0 : ((soma1 * 10) % 11));
        soma2 = (((soma2 + (2 * soma1)) * 10) % 11);
        var digitoGerado = (soma1 * 10) + soma2;
        if (digitoGerado != digitoDigitado)
            alert('CPF Invalido!');
    }


//valida o CNPJ digitado
    function ValidarCNPJ(ObjCnpj) {
        var cnpj = ObjCnpj.value;
        var valida = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        var dig1 = new Number;
        var dig2 = new Number;
        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace(exp, "");
        var digito = new Number(eval(cnpj.charAt(12) + cnpj.charAt(13)));
        for (i = 0; i < valida.length; i++) {
            dig1 += (i > 0 ? (cnpj.charAt(i - 1) * valida[i]) : 0);
            dig2 += cnpj.charAt(i) * valida[i];
        }
        dig1 = (((dig1 % 11) < 2) ? 0 : (11 - (dig1 % 11)));
        dig2 = (((dig2 % 11) < 2) ? 0 : (11 - (dig2 % 11)));
        if (((dig1 * 10) + dig2) != digito)
            alert('CNPJ Invalido!');
    }

    function confere() {
        if (document.getElementById("Nome").value == "") {
            alert("Por favor, preencha o nome.");
            return false;
        }

        if (document.getElementById("Fone").value == "") {
            alert("Por favor, preencha o Telefone.");
            return false;
        }
        if (document.getElementById("Cep").value == "") {
            alert("Por favor, preencha o CEP.");
            return false;
        }
        return true;
    }
//funcao para mostrar e ocultar campso CNPJ E CPF, CASO SELECIONADO fisico ou juridico
    function mostrar(frm, num) {
        if (num == 0) {
            frm.Cpf.style.visibility = 'visible';
            frm.Cnpj.style.visibility = 'hidden';
        }
        else {
            frm.Cpf.style.visibility = 'hidden';
            frm.Cnpj.style.visibility = 'visible';
        }
    }

//Função datatable- para funcionamento da tabela de lista de clientes.
    $(document).ready(function () {
        $('#tabelaCliente').DataTable();
    });
///REDIRECIONA APOS EXCLUSAI E EDIÇÃO DO CLIENTE, PARA A TAB LISTA DE CLIENTES
    $(document).ready(function (event) {
        $('ul.nav.nav-tabs a:first').tab('show'); // Select first tab
        $('ul.nav.nav-tabs a[href="' + window.location.hash + '"]').tab('show'); // Select tab by name if provided in location hash
        $('ul.nav.nav-tabs a[data-toggle="tab"]').on('shown', function (event) {    // Update the location hash to current tab
            window.location.hash = event.target.hash;
        })
    });

    ///Função do botão remover dentro da tabela.
    (function ($) {
        RemoveTableRow = function (handler) {
            var tr = $(handler).closest('fechamento');
            tr.fadeOut(400, function () {
                tr.remove();
            });
            return false;
        };
    })(jQuery);

    var contador = 0;
    function addInput(divName) {
        var newdiv = document.createElement('div');

        newdiv.innerHTML = '<fechamento><hr> '
                + ' <label class="control-label"><strong>Propriedade</strong></label> '
                + '                            <div class="form-group">'
                + '<label class="control-label col-md-1">Nome:</label>'
                + '                                <div class="col-sm-3">'
                + '                                  <input name="myInputs[' + contador + '][Nome]" type="text" class="form-control"  style="width: 200px" value="">'
                + '                              </div>'
                + '                              <label class="control-label col-md-1">Área:</label>'
                + '                              <div class="col-sm-3">'
                + '                                  <input name="myInputs[' + contador + '][Area]" type="text" class="form-control"  style="width: 200px" value="">'
                + '                              </div>'
                + '                              <label class="control-label col-md-1">Localidade:</label>'
                + '                              <div class="col-sm-3">'
                + '                                  <input name="myInputs[' + contador + '][Localidade]" type="text" class="form-control"  style="width: 200px" value="">'
                + '                              </div>'
                + '                              <label class="control-label col-md-1">Cidade:</label>'
                + '                              <div class="col-sm-3">'
                + '                                  <input name="myInputs[' + contador + '][Municipio]" type="text" class="form-control"  style="width: 200px" value="">'
                + '                              </div>'
                + '                              <label class="control-label col-md-1">Estado:</label>'
                + '                              <div class="col-sm-3">'
                + '                                  <input name="myInputs[' + contador + '][Estado]" type="text" class="form-control"  style="width: 200px" value="">'
                + '                              </div>'
                + '                                 <div class="col-sm-3">'
                + '                                 <input type="button" name="deletar" class="btn btn-xs btn-danger" value="Remover" onclick="RemoveTableRow(this)"/>'
                + '                              </div>'
                + '                          </div>'
                + '</fechamento>';
        contador++;
        document.getElementById(divName).appendChild(newdiv);
    }
</script>



<body>
    <div class="row">
        <div class="entradadados">
            <br/><br/><br/>

            <div class="page-header">
                <center><h1>Registros de clientes</h1></center>
            </div>

            <?php
//verifica se existe uma mensagem de confirmação na sessão

            if (isset($_SESSION['mensagem'])) {
                $mensagem = $_SESSION['mensagem'];
                ?>  
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['mensagem']; ?></div>
                    <?php
                unset($_SESSION['mensagem']);
            }

            if (isset($_SESSION['mensagem_erro'])) {
                $mensagem = $_SESSION['mensagem_erro'];
                ?>  
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['mensagem_erro']; ?></div>
                    <?php
                unset($_SESSION['mensagem_erro']);
            }
            ?>



            <div class="container">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#menu1">Cadastrar Cliente</a></li>

                    <li><a href="#menu2">Lista de clientes</a></li>
                </ul>

                <div class="tab-content">
                    <div id="menu1" class="tab-pane fade in active">

                        <form method="post"  name="1" onSubmit="return confere()" class="form-horizontal" action="salvar_cliente.php">

                            <div class="form-group">
                                <label class="control-label col-md-1" for="txtUsuario">Nome:</label>
                                <div class="col-sm-11">
                                    <input name="Nome" id="Nome" type="text" class="form-control" style="width: 250px;" value="<?php
            if (isset($editar)) {
                echo $cliente->Nome;
            }
            ?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <input type="radio" name="rad" checked="checked" onclick="mostrar(this.form, 0)" /> Cliente físico
                                <input type="radio" name="rad" onclick="mostrar(this.form, 1)" /> Cliente juridico
                                <br>
                                <label class="control-label col-md-1" for="cpf">Cpf:</label>
                                <div class="col-sm-11">
                                    <input type="text" name="Cpf" id="Cpf" onBlur="ValidarCPF(form.cpf);" maxlength="14"  class="form-control" style="width:200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Cpf;
                                    }
            ?>" /> 
                                </div>
                                <p>
                                    <label class="control-label col-md-1" for="cpf">Cnpj:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="Cnpj" id="Cnpj" maxlength="18" onBlur="ValidarCNPJ(form.cnpj);" style="width:200px; visibility:hidden" class="form-control" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Cnpj;
                                    }
            ?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="email">E-mail:</label>
                                <div class="col-sm-11">
                                    <input name="Email" id="Email" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Email;
                                    }
            ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="celular">Celular:</label>
                                <div class="col-sm-11">            
                                    <input name="Celular" id="Celular" 
                                           maxlength="16" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Celular;
                                    }
            ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="telefone">Telefone:</label>
                                <div class="col-sm-11">
                                    <input name="Fone"  maxlength="16"  id="Fone" type="text" class="form-control"  style="width: 200px" value="<?php
                                           if (isset($editar)) {
                                               echo $cliente->Fone;
                                           }
            ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="fax">Fax:</label>
                                <div class="col-sm-11">
                                    <input name="Fax" id="Fax" maxlength="16" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Fax;
                                    }
            ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="endereco">Endereço:</label>
                                <div class="col-sm-11">
                                    <input name="Endereco" id="Endereco" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Endereco;
                                    }
            ?>">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-1" for="cidade">Cidade:</label>
                                <div class="col-sm-11">
                                    <input name="Cidade" id="Cidade" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Cidade;
                                    }
            ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="estado">Estado:</label>
                                <div class="col-sm-11">
                                    <input name="Estado" id="Estado" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Estado;
                                    }
            ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1" for="cep">Cep:</label>
                                <div class="col-sm-11">
                                    <input name="Cep" id="Cep"
                                           maxlength="10"  type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $cliente->Cep;
                                    }
            ?>">
                                </div>
                            </div>






                            <div id="dynamicInput">

                            </div>

                            <?php
                            if (isset($editar)) {
                                foreach ($propriedades as $propriedade) {
                                     $contador_Amostras++
                                    ?>
                                    <hr> 
                                    <input name="myInputs[<?php echo $contador_Amostras ?>][Id]" type="hidden" value="<?php echo $propriedade->Id; ?>" />
                                    <input name="myInputs[<?php echo $contador_Amostras ?>][Cliente_id]" type="hidden" value="<?php echo $propriedade->Cliente_id; ?>" />
                                    <label class="control-label"><strong>Propriedade</strong></label> 
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Nome:</label>
                                        <div class="col-sm-3">
                                            <input name="myInputs[<?php echo $contador_Amostras ?>][Nome]" type="text" class="form-control"  style="width: 200px" value="<?php echo $propriedade->Nome; ?>">
                                        </div>
                                        <label class="control-label col-md-1">Área:</label>
                                        <div class="col-sm-3">
                                            <input name="myInputs[<?php echo $contador_Amostras ?>][Area]" type="text" class="form-control"  style="width: 200px" value="<?php echo $propriedade->Area; ?>">
                                        </div>
                                        <label class="control-label col-md-1">Localidade:</label>
                                        <div class="col-sm-3">
                                            <input name="myInputs[<?php echo $contador_Amostras ?>][Localidade]" type="text" class="form-control"  style="width: 200px" value="<?php echo $propriedade->Localidade; ?>">
                                        </div>
                                        <label class="control-label col-md-1">Cidade:</label>
                                        <div class="col-sm-3">
                                            <input name="myInputs[<?php echo $contador_Amostras ?>][Municipio]" type="text" class="form-control"  style="width: 200px" value="<?php echo $propriedade->Municipio; ?>">
                                        </div>
                                        <label class="control-label col-md-1">Estado:</label>
                                        <div class="col-sm-3">
                                            <input name="myInputs[<?php echo $contador_Amostras ?>][Estado]" type="text" class="form-control"  style="width: 200px" value="<?php echo $propriedade->Estado; ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="button" name="deletar" class="btn btn-xs btn-danger" value="Remover" onclick="RemoveTableRow(this)"/>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>


                            <input type="button" class="form-control" value="Adicionar propriedade" onClick="addInput('dynamicInput');" />
                            <hr>

                            <?php if (isset($editar)) {
                                ?>  <input name="Id" hidden="hidden" value="<?php echo $cliente->Id; ?>"/>                          <button class="btn btn-default center-block" type="submit" style="width: 250px">Salvar alterações</button>
                                <?php
                            } else {
                                ?>


                                <button class="btn btn-default center-block" type="submit" style="width: 250px">Cadastrar</button>
<?php } ?>
                        </form>





                    </div>

                    <div id="menu2" class="tab-pane fade">


                        <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed" id="tabelaCliente">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cpf/Cnpj</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>E-mail</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Propriedades</th>
                                    <th>Ações</th>


                                </tr>
                            </thead>

                            <?php
                            $clientes = $dao->listar_cliente();
                            foreach ($clientes as $res) {
                                ?>   


                                <tr>
                                    <td> 
    <?php echo $res->Nome; ?>
                                    </td>

                                    <td> 
                                        <?php
                                        if ($res->Cpf == "") {
                                            echo $res->Cnpj;
                                        } else {
                                            echo $res->Cpf;
                                        }
                                        ?>
                                    </td>

                                    <td> 
    <?php echo $res->Fone; ?>
                                    </td>

                                    <td> 
    <?php echo $res->Celular; ?>
                                    </td>

                                    <td> 
    <?php echo $res->Email; ?>
                                    </td>

                                    <td> 
    <?php echo $res->Cidade; ?>
                                    </td>

                                    <td> 
    <?php echo $res->Estado; ?>
                                    </td>

                                    <td> 

                                        <?php
                                        $propriedades = $daoPropriedade->listar_propriedades_cliente($res->Id);
                                        foreach ($propriedades as $res3) {
                                            echo $res3->Nome;
                                            ?>, <?PHP
                                        }
                                        ?>

                                    </td>






                                    <td>  
                                        <a class="btn btn-xs btn-info" href="form_cliente.php?id=<?php echo $res->Id; ?>">Editar</a>
                                        <?php
                                        if ($_SESSION['Permissao'] == "0") {
                                            ?>
                                            <a  onclick="confirmacao_cliente(<?php echo $res->Id; ?>, '<?php echo $res->Nome; ?>', 'salvar_cliente.php')" class="btn btn-xs btn-danger">Excluir</a>
                                            <?php
                                        }
                                        ?>        



                                    </td>

                                </tr>
<?php } ?> 

                        </table>


                    </div>

                </div>
            </div>

        </div>

    </div>
    <script>
        $(document).ready(function () {
            $(".nav-tabs a").click(function () {
                $(this).tab('show');
            });
        });
    </script>
    <?php
    include '../../view/template/rodape.php';
    ?>