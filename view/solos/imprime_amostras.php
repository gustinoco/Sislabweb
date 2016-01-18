<?php
include '../../entidade/Solo.php';
require_once '../../view/restrito.php';
$dao = new Solo();
$usuario = $_SESSION['usuarioNome'];
if (isset($_GET['id'])) {
    $solos = $dao->listar_solo_idboletim((int) $_GET['id']);
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
            <th>H+Al3</th>
            <th>K</th>
            <th>PMehl</th>
            <th>Cu</th>
            <th>Fe</th>
            <th>Mn</th>
            <th>Zn</th>         
            <th>Mo</th>
            <th>Areia</th>
            <th>Silte</th>
            <th>Argila</th>
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
                    <?php echo $res->K; ?>
                </div></td>


            


            <td>  <div class="campo">
                    <?php echo $res->Pmehl; ?>
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



            <td>  <div class="campo">
                    <?php echo $res->Materia_organica; ?>
                </div></td>


        

            <td> <div class="campo">
                    <?php echo $res->Areia; ?>
                </div></td>


            <td>   <div class="campo">
                    <?php echo $res->Silte; ?>
                </div></td>


            <td>  <div class="campo">
                    <?php echo $res->Argila; ?>
                </div></td>

        </tr>

    <?php } ?> 

</table>
</body>
<?php
include '../../view/template/rodape.php';
?>