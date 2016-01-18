<?php
$page_title = "SISLABWEB 1.0 - Livro de registros de boletins";
include '../../view/template/cabecalho.php';
include '../../entidade/BoletimSolo.php';
include '../../entidade/Solo.php';
include '../../entidade/Cliente.php';
include '../../entidade/Propriedade.php';
require_once '../../view/restrito.php';

$daoSolo = new Solo();
$dao = new BoletimSolo();
$daoCliente = new Cliente();
$daoPropriedade = new Propriedade();

$usuario = $_SESSION['usuarioNome'];

if ($_SESSION['Permissao'] == "0") {
    $boletins = $dao->lista_boletim();
} else {
    $boletins = $dao->lista_boletim_pesquisador($usuario);
}
?>

<script type="text/javascript" charset="utf-8">

 $(document).ready(function () {
        $('#livro_registro').dataTable({
            "bProcessing": true,
            "bPaginate": false,
            "bStateSave": true


        });
    });





</script>

<body>
    <div class="row">
        <div class="artsplantas">
            <br/><br/><br/>

            <div class="page-header">

                <center><h1>Livro de Registro de Solos</h1></center>
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

            <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed" id="livro_registro">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th style="width: 15%">Cliente</th>
                        <th>Propriedade</th>
                        <th>Pesquisa</th>
                        <th>Valor</th>
                        <th style="width: 15%">Observações</th>                           
                        <th style="width: 35%">Amostras</th>
                        <th>Imprimir</th>
                        <th>Editar</th>
                        <?php
                        if ($_SESSION['Permissao'] == "0") {
                            echo '<th>Excluir</th>';
                        }
                        ?>


                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($boletins as $res) {
                        ?>


                        <tr>
                            <!--- fazer o redimencionamento para pagina e habilitar a edição --->
                    <form method="post" action="">


                        <td><div>
                                <?php echo $res->Id; ?>
                                <input name="Id" id="Id" type="hidden" value="<?php echo $res->Id; ?>" />
                            </div></td>


                        <td> <div>
                                <?php echo $res->Data_entrada; ?>
                            </div></td>

                        <td><div>

                                <?php
                                $clientess = $daoCliente->listar_cliente_especifico((int) $res->Id_cliente);


                                echo $clientess->Nome;
                                ?> 
                            </div></td>

                        <td><div>                                        
                                <?php
                                $propriedades = $daoPropriedade->listar_propriedade_especifica((INT) $res->Propriedade);

                                echo $propriedades->Nome;
                                ?>

                            </div></td>

                        <td><div><center>
                                    <?php
                                    if ($res->Pesquisa == 1) {
                                        echo '<i class="fa fa-check"></i>';
                                    } else {
                                        echo '<i class="fa fa-ban"></i>';
                                    }
                                    ?>

                                </center></div></td>




                        <td><div>
                                <?php echo $res->Valor; ?>
                            </div></td>

                        <td><div>
                                <?php echo $res->Observacao; ?>

                            </div></td>




                        <td><div>
                                <?php
                                $solos = $daoSolo->listar_solo_idboletim((int) $res->Id);
                                foreach ($solos as $res2) {
                                    echo '<strong>' . $res2->Id . ', </strong>';
                                }
                                ?>

                            </div></td>

                            
                            <td><div>

                                <!---<a class="btn btn-xs btn-success center-block" href="javascript:abrir('imprime_comprovante_boletim.php',<?php echo $res->Id; ?>);">Comprovante</a> ---->                              
                                <br>
                                <a class="btn btn-xs btn-success center-block" href="javascript:abrir('imprime_resultados_boletim.php',<?php echo $res->Id; ?>);">Resultados</a>                              
                            </div></td>

                            
                            
                        <td><div>
                                <a class="btn btn-xs btn-warning center-block" href="../formularios/form_boletim_solo.php?id=<?php echo $res->Id; ?>">Boletim</a>                              
                                <br>
                                <a class="btn btn-xs btn-warning center-block" href="../solos/digita_result_externos.php?id=<?php echo $res->Id; ?>">Resultados</a>                              

                            </div></td>

                        
                        <?php
                        if ($_SESSION['Permissao'] == "0") {
                            ?>
                            <td><div>
                                    <br>
                                    <a onclick="confirmacao2(<?php echo $res->Id; ?>, '../formularios/salvar_formulario_solo.php')" class="btn btn-xs btn-danger"  value="Excluir" >Excluir</a>
                                </div></td><?php
                        }
                        ?>                             






                    </form>

                    </tr>

                <?php } ?>                    
                </tbody>

            </table>





            <?php
            include '../../view/template/rodape.php';
            ?>