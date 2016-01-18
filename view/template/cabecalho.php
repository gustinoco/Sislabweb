<?php
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>

        <!-- Bootstrap e estilos extras CSS -->
        <link rel="stylesheet" href="../../../sislabweb/resource/css/bootstrap.css" >
        <link rel="stylesheet" href="../../../sislabweb/resource/css/datatables.css" >
        <link rel="stylesheet" href="../../../sislabweb/resource/css/bootstrap-datepicker3.css" >
        <link rel="stylesheet" href="../../../sislabweb/resource/css/font-awesome.min.css" >
        <!-- Fim importação de estilos -->

        <!-- JQUERY e Javascripts -->
        <script src="../../../sislabweb/resource/js/jquery.js"></script>
        <script src="../../../sislabweb/resource/js/funcoes.js"></script> 
        <script src="../../../sislabweb/resource/js/bootbox.js"></script> 
        <script src="../../../sislabweb/resource/js/bootstrap-datepicker.min.js"></script> 
        <script src="../../../sislabweb/resource/js/jquery.mask.js"></script>
        <script src="../../../sislabweb/resource/js/jquery.cascade-select.js"></script>
        <script src="../../../sislabweb/resource/js/datatables.js"></script>
        <script src="../../../sislabweb/resource/js/login.js"></script>
        <script src="../../../sislabweb/resource/js/bootstrap.js"></script>
        <!-- fim Importacao Jquery e Js's -->
    </head>
    
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"  aria-controls="navbar">
                    <span class="sr-only">Navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SisLab Web</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../../../sislabweb/view/main.php">Home</a></li>
                    <li><a href="../../../sislabweb/sobre.php">Sobre</a></li>
                    <li><a href="../../../sislabweb/contato.php">Contato</a></li>
                    <li><a href="../../../sislabweb/documentacao/index.html">Documentação</a></li>
                    <li><a class="btn btn-danger" href="../../../sislabweb/logout.php">Logout</a></li>
                    <?php /*  DROPDOWN OCULTO
                     *  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li class="dropdown-header">Nav header</li>
                      <li><a href="#">Separated link</a></li>
                      <li><a href="#">One more separated link</a></li>
                      </ul>
                      </li>
                     * 
                     */ ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <body>
        <div class="container">