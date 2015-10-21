<?php
require_once '../../view/restrito.php';
include '../../entidade/Pesquisador.php';

$dao = new Pesquisador();



if (isset($_GET['login'])) {
    $editar = $_GET['login'];
    $pesquisador = $dao->listar_pesquisador_especifico($editar);
    $page_title = "SISLABWEB 1.0 - Editar Pesquisador = " . $editar;
} else {
    $page_title = "SISLABWEB 1.0 - Cadastrar Pesquisador";
}

include '../../view/template/cabecalho.php';
?>

<script>


    $(document).ready(function () {
        $('#Cep').mask('00000-000');
        $('#Fone').mask('(00) 0000-0000');
        $('#Fax').mask('(00) 0000-0000');
        $('#Celular').mask('(00) 0000-0000');
        $('#Cpf').mask('000.000.000-00', {reverse: true});
        $('#Cnpj').mask('00.000.000/0000-00', {reverse: true});

    });



    function confere() {
        if (document.getElementById("Nome").value == "") {
            alert("Por favor, preencha o nome.");
            return false;
        }


        return true;
    }



//Função datatable- para funcionamento da tabela de lista de clientes.
    $(document).ready(function () {
    $('#tabelaPesquisador').dataTable({
            "bProcessing": true,
            "bPaginate": false,
            "bStateSave": true
        });
    });
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
                    <li  class="active"><a href="#menu1">Cadastrar novo pesquisador</a></li>

                    <li><a href="#menu2">Lista de pesquisadores</a></li>
                </ul>

                <div class="tab-content">
                    <div id="menu1" class="tab-pane fade in active">


                        <form method="post"  name="1" onSubmit="return confere()" class="form-horizontal" action="salvar_pesquisador.php">

                            <input TYPE="hidden" name="Id" id="Id"  type="text" class="form-control"  style="width: 200px" value="<?php
                            if (isset($editar)) {
                                echo $pesquisador->Id;
                            }
                            ?>">



                            <div class="form-group">
                                <label class="control-label col-md-1">Nome completo:</label>
                                <div class="col-sm-11">
                                    <input name="Nome_completo" id="Nome_completo" type="text" class="form-control" style="width: 250px;" value="<?php
                                    if (isset($editar)) {
                                        echo $pesquisador->Nome_completo;
                                    }
                                    ?>">

                                </div>
                            </div>




                            <div class="form-group">
                                <label class="control-label col-md-1">Login:</label>
                                <div class="col-sm-11">
                                    <input name="Login" id="Login" placeholder="Exemplo: Nome.Sobrenome" type="text" class="form-control"  style="width: 200px" value="<?php
                                    if (isset($editar)) {
                                        echo $pesquisador->Login;
                                    }
                                    ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="Email">E-mail:</label>
                                <div class="col-sm-11">            
                                    <input name="Email" id="Email" 
                                           maxlength="16" type="text" class="form-control"  style="width: 200px" value="<?php
                                           if (isset($editar)) {
                                               echo $pesquisador->Email;
                                           }
                                           ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="telefone">Pesquisador administrador?</label>
                                <div class="col-sm-11">


                                    <input type="checkbox"  name="Permissao" value="true" <?php
                                    if (isset($editar)) {
                                        if ($pesquisador->Permissao == 0) {
                                            echo checked;
                                        }
                                    }
                                    ?> />

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-1"  for="Email">Senha:</label>
                                <div class="col-sm-11">            
                                    <input name="Senha" id="Senha"  type="password"
                                           maxlength="16" type="text" class="form-control"  style="width: 200px" value="<?php
                                           if (isset($editar)) {
                                               echo $pesquisador->Senha;
                                           }
                                           ?>">
                                </div>
                            </div>


                            <hr>

                            <?php if (isset($editar)) {
                                ?>  <input name="Id" hidden="hidden" value="<?php echo $pesquisador->Login; ?>"/>                          <button class="btn btn-default center-block" type="submit" style="width: 250px">Salvar alterações</button>
                                <?php
                            } else {
                                ?>


                                <button class="btn btn-default center-block" type="submit" style="width: 250px">Cadastrar</button>
                            <?php } ?>
                        </form>



                    </div>

                    <div id="menu2" class="tab-pane fade">

                        <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed" id="tabelaPesquisador">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>E-mail</th>
                                    <th>Data de cadastro</th>
                                    <th>Data de ultimo acesso</th>
                                    <th>Administrador</th>
                                    <th>Boletins</th>
                                    <th>Ações</th>


                                </tr>
                            </thead>

                            <?php
                            $pesquisadores = $dao->lista_pesquisadores();
                            foreach ($pesquisadores as $res) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $res->Nome_completo;
                                        ?>
                                    </td>



                                    <td> 
                                        <?php echo $res->Login; ?>
                                    </td>

                                    <td> 
                                        <?php echo $res->Email; ?>
                                    </td>

                                    <td> 
                                        <?php echo $res->Data_cadastro; ?>
                                    </td>

                                    <td> 
                                        <?php echo $res->Data_ultimo_acesso; ?>
                                    </td>

                                    <td> 
                                        <?php
                                        if ($res->Permissao == 0) {
                                            echo '<i class="fa fa-check"></i>';
                                        } else {
                                            echo '<i class="fa fa-ban"></i>';
                                        }
                                        ?>

                                    </td>

                                    <td> 
                                        <?php echo $res->Login; ?>
                                    </td>   




                                    <td>  
                                        <a class="btn btn-xs btn-info" href="form_pesquisador.php?login=<?php echo $res->Login; ?>">Editar</a>
                                        <?php
                                        if ($_SESSION['Permissao'] == "0") {
                                            ?>
                                            <a  onclick="confirmacao_pesquisador(<?php echo $res->Login; ?>, '<?php echo $res->Login; ?>', 'salvar_pesquisador.php')" class="btn btn-xs btn-danger">Excluir</a>
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