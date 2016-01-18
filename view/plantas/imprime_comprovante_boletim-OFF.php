<?php
//VERIFICAR A NECESSIDADE DESTE TIPO DE IMPRESSÃO. 
$page_title = 'SisLabWeb 1.0 - Cadastrar boletim de Solo';

require_once '../../view/restrito.php';
include '../../entidade/Cliente.php';
include '../../entidade/Sistema.php';
include '../../entidade/Cultura.php';
include '../../entidade/Solo.php';
include '../../entidade/BoletimSolo.php';

$editar = (int) $_GET['id'];
$dao = new Cliente();
$dao2 = new Solo();
$dao3 = new BoletimSolo();
$boletim = $dao3->lista_boletim_edicao($editar);
$cliente = $dao->listar_cliente_especifico((int) $boletim->Id_cliente);
$solos = $dao2->listar_solo_idboletim($editar);






/// desmenbrar como será o boletm
?>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../../../sislabweb/resource/css/bootstrap.css" >
<script src="../../../sislabweb/resource/js/jquery.js"></script>
</head>

<body onload="focus();print();focus();">
    
<center> <img class="img-responsive" src="../../../sislabweb/img/logo.png"></center>


<?php
echo $boletim->Id;    ?> <br><?php
echo $boletim->Data_entrada;    ?> <br><?php
echo $boletim->Valor;    ?> <br><?php
echo $boletim->Observacao;    ?> <br><?php
echo $boletim->Pesquisa;    ?> <br><?php
echo $boletim->Cultura;    ?> <br><?php
echo $boletim->Sistema;    ?> <br>
<br> <br>
    <?php

echo $cliente->Nome;    ?> <br><?php
echo $cliente->Celular;    ?> <br><?php
echo $cliente->Nome_propriedade;    ?> <br><?php
echo $cliente->Fone;    ?> <br>
    <br> <br><?php


foreach ($solos as $solo){
    echo $solo->Id;    ?> <br><?php
    echo $solo->Pesquisador;    ?> <br><?php
    echo $solo->Identificacao;    ?> <br><?php
    echo $solo->Rotina;    ?> <br><?php
    echo $solo->Mo;    ?> <br><?php
    echo $solo->Micro;    ?> <br><?php
    echo $solo->Textura;    ?> <br><br> <br><?php
    
    
}



?>
</body>

