<?php
include '../../entidade/Solo.php';
include '../../entidade/BoletimSolo.php';
include '../../entidade/Cliente.php';
include '../../entidade/Propriedade.php';
include '../../entidade/Pesquisador.php';
require_once '../../view/restrito.php';
$daoSolo = new Solo();
$daoBoletim = new BoletimSolo();
$daoCliente = new Cliente();
$daoPropriedade = new Propriedade();
$daoPesquisador = new Pesquisador();
$usuario = $_SESSION['usuarioNome'];
$solos = $daoSolo->listar_solo_idboletim((int) $_GET['id']);
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
        <div class="row">

            <table cellpadding = "1"  class = "table-responsive table-hover table-condensed table-bordered" id = "example">
                <thead>
                    <tr>
                        <?php /// CAMPOS FORAM REDUZIDOS PARA CABER NA IMPRESSÃO E NÃO PRECISAR REDIMENCIONAR TEXTOS E TAMANHOS, ENTÃO SÓ DIMINUI AQUI PARA A4  ?>
                        <th colspan="2" style="width: 10px" >Ident. da amostra</th>
                        <th>pHCaCl<sub>2</sub></th>
                        <th>pH Agua</th>
                        <th>Al</th>
                        <th>Ca</th>
                        <th>Mg</th>
                        <th>(H+Al)</th>
                        <th>K</th>
                        <th>P Mehl.</th>
                        <th>Soma Base</th>
                        <th>CTC</th>
                        <th>CTC Efetivo</th>
                        <th>m</th>
                        <th>V</th>
                        <th>M.O</th>
                        <th>Cu</th>
                        <th>Fe</th>
                        <th>Mn</th>
                        <th>Zn</th>
                        <th>Areia</th>
                        <th>Silte</th>
                        <th>Argila</th>
                    </tr>

                    <tr class="componentes">

                        <th>Lab.</th>
                        <th>Identificação</th>
                        <th><center>(1:2,5)</center></th>
                <th><center>*</center></th>
                <th colspan="5"><center>------------------(cmol<sub>c</sub>dm<sup>-3</sup>)------------------</center></th>
                <th><center>(mg dm<sup>-3</sup>)</th>
                    <th colspan="3"><center>-------------------(cmol<sub>c</sub>dm<sup>-3</sup>)-------------------</center></th>
                    <th colspan="2"><center>-----(%)-----</center></th>
                    <th><center>(g kg<sup>-1</sup>)</center></th>
                    <th colspan="4"><center>------------------(mg dm<sup>-3</sup>)------------------</center></th>

                    <th colspan="3"><center>--------------(g kg<sup>-1)</sup>--------------</center></th>

                    </tr>
                    </thead>
                    
                    
                    
                    <tbody>    
                        <?php
                        foreach ($solos as $res) {
                            ?>   

                            <tr>
                                <td><div>
                                        <?php echo $res->Id; ?>
                                        <input name="Id" id="Id" type="hidden" value="<?php echo $res->Id; ?>" />
                                    </div></td>




                                <td>  <div>
                                        <?php echo $res->Identificao; ?>
                                    </div></td>


                                <td>  <div>
                                        <?php
                                        if (!$res->Phcacl2 == "")
                                            echo $res->Phcacl2;
                                        ?>
                                    </div></td>



                                <td>  <div>
                                        <?php
                                        if ($res->Phcacl2 == "") {
                                            echo '';
                                        } else {
                                            $valor = str_replace(",", ".", $res->Phcacl2);
                                            $PhAgua = 1.371 + 0.868 * (float) $valor;
                                            echo number_format($PhAgua, 2, ",", "");
                                        }
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (!$res->Al == "")
                                            echo $res->Al;
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
                                        if (!$res->Hal3 == "")
                                            echo $res->Hal3;
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
                                        if (!$res->Pmehl == "")
                                            echo $res->Pmehl;
                                        ?>
                                    </div></td>


                                <td>  <div>
                                        <?php
                                        if ($res->Ca == "" || $res->Mg == "" || $res->K == "") {
                                            echo "";
                                        } else {
                                            (float) $ca = str_replace(",", ".", $res->Ca);
                                            (float) $mg = str_replace(",", ".", $res->Mg);
                                            (float) $k = str_replace(",", ".", $res->K);
                                            $s = $ca + $mg + $k;
                                            echo number_format($s, 2, ",", "");
                                        }
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (empty($s) || $res->Hal3 == "") {
                                            echo "";
                                        } else {
                                            (float) $hal3 = str_replace(",", ".", $res->Hal3);
                                            (float) $s = str_replace(",", ".", $s);
                                            $ctc = $s + $hal3;

                                            echo number_format($ctc, 2, ",", "");
                                        }
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (empty($s) || $res->Al == "") {
                                            echo "";
                                        } else {
                                            (float) $al = str_replace(",", ".", $res->Al);
                                            (float) $s = str_replace(",", ".", $s);

                                            $ctce = $s + $al;

                                            echo number_format($ctce, 2, ",", "");
                                        }
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (empty($s) || $res->Al == "") {
                                            echo "";
                                        } else {
                                            (float) $al = str_replace(",", ".", $res->Al);
                                            (float) $s = str_replace(",", ".", $s);
                                            $m = ($al / ($s + $al)) * 100;
                                            echo number_format($m, 0, ",", "");
                                        }
                                        ?>
                                    </div></td>

                                <td>  <div>
                                        <?php
                                        if (empty($s) || $res->Hal3 == "") {
                                            echo "";
                                        } else {
                                            (float) $hal3 = str_replace(",", ".", $res->Hal3);
                                            (float) $s = str_replace(",", ".", $s);
                                            $t = $s + $hal3;
                                            $v = ($s / $t) * 100;
                                            echo number_format($v, 0, ",", "");
                                        }
                                        ?>

                                    </div></td>



                                <td><div>
                                        <?php echo $res->Materia_organica; ?>
                                    </div></td>


                                <td><div>
                                        <?php echo $res->Cu; ?>
                                    </div></td>


                                <td><div>
                                        <?php echo $res->Fe; ?>
                                    </div></td>

                                <td> <div>
                                        <?php echo $res->Mn; ?>
                                    </div></td>


                                <td> <div>
                                        <?php echo $res->Zn; ?>
                                    </div></td>


                                <td>  <div>
                                        <?php
                                        if ($res->Areia == "0,00")
                                            echo "";
                                        else
                                            echo number_format($res->Areia, 0, ",", "");
                                        ?>
                                    </div></td>



                                <td> <div>

                                        <?php
                                        if ($res->Silte == "0,00")
                                            echo "";
                                        else
                                            echo number_format($res->Silte, 0, ",", "");
                                        ?>

                                    </div></td>

                                <td> <div>
                                        <?php
                                        if ($res->Argila == "0,00")
                                            echo "";
                                        else
                                            echo number_format($res->Argila, 0, ",", "");
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
            <div class="col-md-2" style="float:left">
                <b>Métodos Utilizados </b>
                <br>
                Ca,Mg,Al (KCl 1 Mol/L)
                <br>
                P,K, Cu, Fe, Mn, Zn(Mehlich -1)     
                <br>
                Areia, Argila, Silte (Método do desímetro)
            </div>

            <div class="col-md-4" style="float: left" >
                <b> Obs: </b>O pH em água foi estimado pela equação pH H<sub>2</sub>0 = 1,371 + 0,868 x pH CaCl<sub>2</sub>
                <br>
                (H + Al) estimada pela equação para solos do Mato Grosso do Sul
                <br>
                *M.O. (Matéria Orgânica): Combustão via seca  (Determinador elementar de carbono<br> (Carbono Orgânico Total (TOC)/Determinação por analisador elementar CNHS)

            </div>

            <div class="col-md-4" style="float: left">
                <b>ln (H+Al)</b> = 8,0857763 - 1,0621553*pHSMP
                <br>
                <b>S</b> = Ca + Mg + K - Soma de bases
                <br>
                <b>m</b> = (Al/S + A) * 100 - Saturação de alumínio em %
                <br>
                <b>V</b> = (S/T) * 100 - Grau de saturação de bases
                <br>
                <b>CTC</b> = S + (H +Al) - Capacidade de troca de cátions
                <br>
                <b>CTC efetiva</b> = S + Al


            </div>

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
