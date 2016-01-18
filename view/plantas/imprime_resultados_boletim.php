<?php
include '../../entidade/Planta.php';
include '../../entidade/BoletimPlanta.php';
include '../../entidade/Cliente.php';
include '../../entidade/Propriedade.php';
include '../../entidade/Pesquisador.php';
require_once '../../view/restrito.php';
$daoPlanta = new Planta();
$daoBoletim = new BoletimPlanta();
$daoCliente = new Cliente();
$daoPropriedade = new Propriedade();
$daoPesquisador = new Pesquisador();
$usuario = $_SESSION['usuarioNome'];
$plantas = $daoPlanta->listar_planta_idboletim((int) $_GET['id']);
$boletim = $daoBoletim->lista_boletim_edicao((int) $_GET['id']);
$pesquisador = $daoPesquisador->listar_pesquisador_especifico($boletim->Pesquisador);
$cliente = $daoCliente->listar_cliente_especifico((int) $boletim->Id_cliente);
$propriedade = $daoPropriedade->listar_propriedade_especifica((int) $boletim->Propriedade);
?>
<head>
    <title>Relatório de Análise de Solos - Sislab</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../sislabweb/resource/css/bootstrap-impressao.css" >
    <link rel="stylesheet" href="../../../sislabweb/resource/css/datatables.css" >
    <script src="../../../sislabweb/resource/js/jquery.js"></script>
    <script src="../../../sislabweb/resource/js/datatables.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $("#example").DataTable({
                "paging": false,
                "ordering": false,
                "bFilter": false,
                "info": false
            });
        });
    </script>
    <style media="print,screen">
        .componentes{
            text-align: justify;
            font-size: 10px;
            border-bottom: 0px solid #ddd;

        }

        @media print {
            thead {display: table-header-group;
            }
        }

        #example   td{
            text-align: center;
            border: 2px #000 solid; 
        }

        #example th{
            border: 2px #003333 solid;
        }
        #example tbody{
            overflow: no-display;
            height: 100px;

        }


    </style>
</head>
<body onload="focus();
        print();">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <DIV class="col-md-8">
                    <img style="float: left" class="img-responsive" src="../../../sislabweb/img/logo.png">
                </div>
                <br>
                <div class="col-md-4 h4">
                    <label>Boletim:&nbsp;  </label>
                    <?php echo $boletim->Id ?>
                    <br>
                    <label>Data Entrada:&nbsp;  </label>
                    <?php echo $boletim->Data_entrada ?>
                    <br>
                    <label>Data saída:&nbsp;  </label>
                    <?php echo date("d/m/Y"); ?>
                    <br>
                </div>
            </div>
            <br><br>

            <div class="col-md-12">
                <div style="float: left; width: 45%; height: 130px;  border: 4px solid #cccccc" class="col-md-4 h4">
                    <label>Nome do cliente:&nbsp; <?php echo $cliente->Nome; ?> </label>
                    <br>
                    <label>E-mail:&nbsp;  </label><?php echo $cliente->Email; ?>
                    <br>
                    <?php
                    if ($cliente->Cpf == "") {
                        ?><label>Cnpj:&nbsp;  </label><?php
                        echo $cliente->Cnpj;
                    } else {
                        ?><label>Cpf: &nbsp; </label><?php
                        echo $cliente->Cpf;
                    }
                    ?>

                    <br>
                    <label>Endereço: &nbsp; </label><?php echo $cliente->Endereco; ?> &nbsp;&nbsp;&nbsp; <?php echo $cliente->Cep ?>&nbsp;&nbsp;&nbsp; <?php echo $cliente->Cidade ?> / <?php echo $cliente->Estado ?>

                    <br>
                    <label>Telefone: &nbsp; </label><?php echo $cliente->Fone; ?> &nbsp;&nbsp;&nbsp; <?php echo $cliente->Celular ?>
                    <br>

                </div>

                <div style="float: left; width: 25%; height: 130px;  border: 4px solid #cccccc" class="col-md-4 h4">
                    <label>Pesquisador:&nbsp; <?php echo $pesquisador->Nome_completo; ?> </label>
                    <br>
                    <label>E-mail:&nbsp;  </label><?php echo $pesquisador->Email; ?>
                    <br>
                    <label>Cultura: &nbsp;</label><?php echo $boletim->Cultura ?>  <br>
                    <label>Sistema:&nbsp;</label> <?php echo $boletim->Sistema ?>

                </div>


                <div  style="float:right; width: 30%; height: 130px;  border: 4px solid #cccccc"  class="col-md-4 h4">
                    <label>Propriedade:&nbsp;  </label><?php echo $propriedade->Nome; ?>
                    <br>
                    <label>Localidade:&nbsp;  </label><?php echo $propriedade->Localidade; ?>
                    <br>  
                    <label>Municipio:&nbsp;  </label><?php echo $propriedade->Municipio; ?>&nbsp;  <?php echo $propriedade->Estado; ?>

                </div>
            </div>
        </div>
        <br>
        <div class="row ">

            <table cellpadding = "1"  class = "table-hover table-condensed table-bordered" id = "example" style="width: 65%">
                <thead>
                    <tr>
                        <?php /// CAMPOS FORAM REDUZIDOS PARA CABER NA IMPRESSÃO E NÃO PRECISAR REDIMENCIONAR TEXTOS E TAMANHOS, ENTÃO SÓ DIMINUI AQUI PARA A4  ?>
                        <th colspan="2" style="width: 10px" >Ident. da amostra</th>
                        <th>C</th>
                        <th>N</th>
                        <th>P</th>
                        <th>K</th>
                        <th>Ca</th>
                        <th>Mg</th>
                        <th>S</th>
                        <th>Cu</th>
                        <th>Fe</th>
                        <th>Mn</th>
                        <th>Zn</th>
                        <th>B</th>

                    </tr>

                    <tr class="componentes">

                        <th>Lab.</th>
                        <th>Identificação</th>
                        <th>(g kg<sup>-1</sup></th>
                        
                        <th colspan="6"><center>------------------(g kg<sup>-1</sup>)------------------</center></th>
                
                    <th colspan="5"><center>-------------------(mg kg<sup>-1</sup>)-------------------</center></th>
                    

                    </tr>
                    </thead>
                    <tbody>    
                        <?php
                        foreach ($plantas as $res) {
                            ?>   

                            <tr>
                                <td><div>
                                        <?php echo $res->Id; ?>
                                        <input name="Id" id="Id" type="hidden" value="<?php echo $res->Id; ?>" />
                                    </div></td>




                                <td>  <div style="text-align: left">
                                        <?php echo $res->Identificacao; ?>
                                    </div></td>


                                    <td>  <div>
                                        <?php
                                        if (!$res->C == "")
                                            echo $res->C;
                                        ?>
                                    </div></td>

                                    
                                <td>  <div>
                                        <?php
                                        if (!$res->N == "")
                                            echo $res->N;
                                        ?>
                                    </div></td>





                                <td>  <div>
                                        <?php
                                        if (!$res->P == "")
                                            echo $res->P;
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (!$res->K == "")
                                            echo $res->K;
                                        ?>
                                    </div></td>



                                <td>  <div>
                                        <?php
                                        if (!$res->Ca == "")
                                            echo $res->Ca;
                                        ?>
                                    </div></td>


                                <td>  <div>
                                        <?php
                                        if (!$res->Mg == "")
                                            echo $res->Mg;
                                        ?>
                                    </div></td>


                                <td>  <div>
                                        <?php
                                        if (!$res->S == "")
                                            echo $res->S;
                                        ?>
                                    </div></td>



                                <td>  <div>
                                        <?php
                                        if (!$res->Cu == "")
                                            echo $res->Cu;
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (!$res->Fe == "")
                                            echo $res->Fe;
                                        ?>
                                    </div></td>
                                <td>  <div>
                                        <?php
                                        if (!$res->Mn == "")
                                            echo $res->Mn;
                                        ?>
                                    </div></td>
                                <td>  <div>
                                        <?php
                                        if (!$res->Zn == "")
                                            echo $res->Zn;
                                        ?>
                                    </div></td>
                                <td>  <div>
                                        <?php
                                        if (!$res->B == "")
                                            echo $res->B;
                                        ?>
                                    </div></td>
                                    
                              


                                <?php $s = 0; ?>
                            </tr>

                            <?php
                        }
                        ?> 
                    </tbody>
            </table>
        </div>
        <br>
        <div class="row" style="float:left">
          
            <div class="col-md-2" style="text-align: center; float:left">

                <br><br>
                ______________________________
                <br>
                Willian Marra Silva
                <br>
                Eng.Químico M.Sc., CREA 119/D-MS
            </div>
        </div>
    </div>
</body>

<?php
include '../../view/template/rodape.php';
