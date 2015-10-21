<?php
include '../../entidade/Solo.php';
require_once '../../view/restrito.php';
$dao = new Solo();
$usuario = $_SESSION['usuarioNome'];
if (isset($_GET['id'])) {
    $solos = $dao->listar_solo_com_id_boletim_usuario((int) $_GET['id'], $usuario);
} else {
    $solos = $dao->listar_solo($usuario);
}
?>
<head>
    <title>Relatório amostras Sislab</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../sislabweb/resource/css/bootstrap.css" >
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
</head>
<body onload="focus();
        print();
        focus();">
<center> <img class="img-responsive" src="../../../sislabweb/img/logo.png"></center>
<table cellpadding = "0" cellspacing = "0" border = "0" class = "table table-striped table-bordered table-condensed" id = "example">
    <thead>
        <tr>
            <?php /// CAMPOS FORAM REDUZIDOS PARA CABER NA IMPRESSÃO E NÃO PRECISAR REDIMENCIONAR TEXTOS E TAMANHOS, ENTÃO SÓ DIMINUI AQUI PARA A4 ?>
            <th>ID</th>
            <th>Data</th>
            <th>pH2</th>
            <th>Al</th>
            <th>Ca</th>
            <th>Mg</th>
            <th>HAl3</th>
            <th>Kmg3</th>
            <th>Fator</th>
            <th>PMehl</th>
            <th>PResin</th>
            <th>Cu</th>
            <th>Fe</th>
            <th>Mn</th>
            <th>Zn</th>
            <th>B</th>
            <th>Norm</th>
            <th>Massa</th>
            <th>VolG</th>
            <th>Dicr.</th>
            <th>TOC</th>
            <th>Lei1</th>
            <th>Temp1</th>
            <th>Lei2</th>
            <th>Temp2</th>



        </tr>
    </thead>

    <?php
    foreach ($solos as $res) {
        ?>   


        <tr>




            <td><div class="campo">
                    <?php echo $res->Id; ?>
                    <input name="Id" id="Id" type="hidden" value="<?php echo $res->Id; ?>" />
                </div></td>


            <td> <div class="campo">
                    <?php echo date("d/m/Y", strtotime($res->Data_cadastro)); ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Phcacl2; ?>
                </div></td>

            <td><div class="campo">
                    <?php echo $res->Al; ?>
                </div></td>

            <td><div class="campo">
                    <?php echo $res->Ca; ?>
                </div></td>


            <td><div class="campo">
                    <?php echo $res->Mg; ?>
                </div></td>


            <td><div class="campo">
                    <?php echo $res->Hal3; ?>
                </div></td>

            <td> <div class="campo">
                    <?php echo $res->Kmgdm3; ?>
                </div></td>


            <td> <div class="campo">
                    <?php echo $res->Fator; ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Pmehl; ?>
                </div></td>



            <td> <div class="campo">
                    <?php echo $res->Presin; ?>
                </div></td>

            <td> <div class="campo">
                    <?php echo $res->Cu; ?>
                </div></td>


            <td> <div class="campo">
                    <?php echo $res->Fe; ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Mn; ?>
                </div></td>


            <td>   <div class="campo">
                    <?php echo $res->Zn; ?>
                </div></td>


            <td> <div class="campo">
                    <?php echo $res->B; ?>
                </div></td>

            <td>  <div class="campo">
                    <?php echo $res->Normalidade; ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Massa; ?>
                </div></td>


            <td>   <div class="campo">
                    <?php echo $res->Vol_gasto; ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Dicromato; ?>
                </div></td>


            <td>   <div class="campo">
                    <?php echo $res->Toc; ?>
                </div></td>


            <td>   <div class="campo">
                    <?php echo $res->Leitura1; ?>
                </div></td>


            <td> <div class="campo">
                    <?php echo $res->Temp1; ?>
                </div></td>


            <td>   <div class="campo">
                    <?php echo $res->Leitura2; ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Temp2; ?>
                </div></td>

        </tr>

    <?php } ?> 

</table>
</body>
<?php
include '../../view/template/rodape.php';
?>