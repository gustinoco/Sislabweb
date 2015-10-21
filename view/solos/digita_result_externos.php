<?php
include '../../entidade/Solo.php';
require_once '../../view/restrito.php';
$dao = new Solo();
$usuario = $_SESSION['usuarioNome'];
if (isset($_GET['id'])) {
    $solos = $dao->listar_solo_com_id_boletim_usuario((int) $_GET['id'], $usuario);
    $page_title = "SISLABWEB 1.0 - Editar amostra = " . $_GET['id'];
} else {

    if ($_SESSION['Permissao'] == "0") {
                            $solos=$dao->listar_todos_solo();
                        }
                        else{
                            $solos = $dao->listar_solo($usuario);
                        }
    
    $page_title = "SISLABWEB 1.0 - Todas amostras";
}

include '../../view/template/cabecalho.php';
?>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#example').dataTable({
            "bProcessing": true,
            "bPaginate": false, 
            "bStateSave": true


        });
    });


</script>

<style>

    * {
        margin: 0;
        padding: 0;
    }

    fieldset {
        border: 0;
    }

    body, input, select, textarea, button {
        font-family: sans-serif;
        font-size: 1em;
    }

    .grupo:before, .grupo:after {
        content: " ";
        display: table;
    }

    .grupo:after {
        clear: both;
    }
    .campo {
            margin-bottom: 1em;
    }
     
    .campo label {
            margin-bottom: 0.2em;
            color: #666;
            display: block;
    }

    fieldset.grupo .campo {
        float:  left;
        margin-right: 1em;
    }
    .campo textarea {
        padding: 0.2em;
        border: 1px solid #CCC;
        box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
        display:  block;
    }

    .campo select option {
        padding-right: 1em;
    }

    .campo input:focus, .campo select:focus, .campo textarea:focus {
        background: #FFC;
    }

</style>
<body>
    <div class="container-fluid">
        <div class="artsplantas">
            <br/><br/><br/>

            <div class="page-header">



                <center><h1>Digita Resultado Pesquisas Externas</h1></center>
            </div>
            <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed" id="example">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Pesquisador</th>
                        <th>pHCaCl2</th>
                        <th>Al</th>
                        <th>Ca</th>
                        <th>Mg</th>
                        <th>HAl3</th>
                        <th>Kmgdm3</th>
                        <th>Fator</th>
                        <th>PMehl</th>
                        <th>PResin</th>
                        <th>Cu</th>
                        <th>Fe</th>
                        <th>Mn</th>
                        <th>Zn</th>
                        <th>B</th>
                        <th>Normalidade</th>
                        <th>Massa</th>
                        <th>VolGasto</th>
                        <th>Dicromato</th>
                        <th>TOC</th>
                        <th>Leitura1</th>
                        <th>Temp1</th>
                        <th>Leitura2</th>
                        <th>Temp2</th>
                        <?php if ($_SESSION['Permissao'] == "0") {
                            echo'<th>Ações</th>';
                        }
                        ?>


                    </tr>
                </thead>

                <?php
                foreach ($solos as $res) {
                    ?>   


                    <tr>

                    <form method="post" action="salvar_solo.php">


                        <td><div class="campo">
                                <?php echo $res->Id; ?>
                                <input name="Id" id="Id" type="hidden" value="<?php echo $res->Id; ?>" />
                            </div></td>


                        <td> <div class="campo">
                                <?php echo date("d/M/Y H:m:s", strtotime($res->Data_cadastro)); ?>
                            </div></td>

                        <td> <div class="campo">
                                <?php echo $res->Pesquisador; ?>

                            </div></td>

                        <td>  <div class="campo">
                                <input type="text" id="Phcacl2" name="Phcacl2" style="width: 5em" value="<?php echo $res->Phcacl2; ?>" />
                            </div></td>

                        <td><div class="campo">
                                <input type="text" id="Al" name="Al" style="width: 5em" value="<?php echo $res->Al; ?>" />
                            </div></td>

                        <td><div class="campo">
                                <input type="text" id="Ca" name="Ca" style="width: 5em" value="<?php echo $res->Ca; ?>" />
                            </div></td>


                        <td><div class="campo">
                                <input type="text" id="Mg" name="Mg" style="width: 5em" value="<?php echo $res->Mg; ?>" />
                            </div></td>


                        <td><div class="campo">
                                <input type="text" id="Hal3" name="Hal3" style="width: 5em" value="<?php echo $res->Hal3; ?>" />
                            </div></td>

                        <td> <div class="campo">
                                <input type="text" id="Kmgdm3" name="Kmgdm3" style="width: 7em" value="<?php echo $res->Kmgdm3; ?>" />
                            </div></td>


                        <td> <div class="campo">
                                <input type="text" id="Fator" name="Fator" style="width: 5em" value="<?php echo $res->Fator; ?>" />
                            </div></td>


                        <td>  <div class="campo">
                                <input type="text" id="pmehl" name="Pmehl" style="width: 6em" value="<?php echo $res->Pmehl; ?>" />
                            </div></td>



                        <td> <div class="campo">
                                <input type="text" id="Presin" name="Presin" style="width: 6em" value="<?php echo $res->Presin; ?>" />
                            </div></td>

                        <td> <div class="campo">
                                <input type="text" id="Cu" name="Cu" style="width: 5em" value="<?php echo $res->Cu; ?>" />
                            </div></td>


                        <td> <div class="campo">
                                <input type="text" id="Fe" name="Fe" style="width: 5em" value="<?php echo $res->Fe; ?>" />
                            </div></td>


                        <td>  <div class="campo">
                                <input type="text" id="Mn" name="Mn" style="width: 5em" value="<?php echo $res->Mn; ?>" />
                            </div></td>


                        <td>   <div class="campo">
                                <input type="text" id="Zn" name="Zn" style="width: 5em" value="<?php echo $res->Zn; ?>" />
                            </div></td>


                        <td> <div class="campo">
                                <input type="text" id="b" name="B" style="width: 5em" value="<?php echo $res->B; ?>" />
                            </div></td>

                        <td>  <div class="campo">
                                <input type="text" id="Normalidade" name="Normalidade" style="width: 7em" value="<?php echo $res->Normalidade; ?>" />
                            </div></td>


                        <td>  <div class="campo">
                                <input type="text" id="Massa" name="Massa" style="width: 5em" value="<?php echo $res->Massa; ?>" />
                            </div></td>


                        <td>   <div class="campo">
                                <input type="text" id="Vol_gasto" name="Vol_gasto" style="width: 8em" value="<?php echo $res->Vol_gasto; ?>" />
                            </div></td>


                        <td>  <div class="campo">
                                <input type="text" id="Dicromato" name="Dicromato" style="width: 6em" value="<?php echo $res->Dicromato; ?>" />
                            </div></td>


                        <td>   <div class="campo">
                                <input type="text" id="Toc" name="Toc" style="width: 5em" value="<?php echo $res->Toc; ?>" />
                            </div></td>


                        <td>   <div class="campo">
                                <input type="text" id="Leitura1" name="Leitura1" style="width: 5em" value="<?php echo $res->Leitura1; ?>" />
                            </div></td>


                        <td> <div class="campo">
                                <input type="text" id="Temp1" name="Temp1" style="width: 5em" value="<?php echo $res->Temp1; ?>" />
                            </div></td>


                        <td>   <div class="campo">
                                <input type="text" id="Leitura2" name="Leitura2" style="width: 5em" value="<?php echo $res->Leitura2; ?>" />
                            </div></td>


                        <td>  <div class="campo">
                                <input type="text" id="Temp2" name="Temp2" style="width: 5em" value="<?php echo $res->Temp2; ?>" />
                            </div></td>
  <?php
                            if ($_SESSION['Permissao'] == "0") {
                                ?>
                        <td>  
                            <input class="btn btn-xs btn-success" value="Editar" type="submit" name="submit">

                          
                                <a onclick="confirmacao(<?php echo $res->Id; ?>,<?php
                                if ($res->Id_boletim > 0) {
                                    echo $res->Id_boletim;
                                } else {
                                    echo 0;
                                }
                                ?>, 'salvar_solo.php')" class="btn btn-xs btn-danger"  value="Excluir" >Excluir</a>


                        </td>
                        <?php
                               }
                               ?>        
                    </form>
                    </tr>
                <?php } ?> 

            </table>
        </div>
    </div>

    <?php
    if (!isset($_GET['id'])) {
        ?><a href="javascript:window.open('imprime_amostras.php','SisLab Relatório','width=1220,height=1500')" class="btn btn-lg btn-primary" role="button">Imprimir todas amostras</a><?php
    } else {
        ?>  <a href="javascript:window.open('imprime_amostras.php?id=<?php echo $_GET['id'] ?>','SisLab Relatório','width=1220,height=1500')" class="btn btn-lg btn-primary" role="button">Imprimir todas amostras</a> <?php
    }
    ?>

    <a href="formularios/form_boletim_solo.php" class="btn btn-lg btn-primary" role="button">Exportar para excel</a></p>



<div class="container">

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
        ?>
</div>







<?php
include '../../view/template/rodape.php';
?>