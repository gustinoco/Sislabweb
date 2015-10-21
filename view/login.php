<?php
$page_title = 'SisLabWeb 1.0 - Login';
include __DIR__.'/template/cabecalho.php';
?>

<div class="row">
    <div class="menu2">
        <br/><br/><br/>

        <div class="page-header">

            <center><h1>SisLabWeb - Login</h1></center>

        </div> 
        <form class="form-signin" name="form1" method="post" action="./validacao.php">
            
            <center>
            <div class="form-group">
                <label for="txtUsuario">Usuario:</label><p>
            <input name="myusername" id="myusername" type="text" class="form-control" style="width: 250px;">
            </div>
             
                <br><div class="form-group">
                 <label for="txtSenha">Senha:</label><p>
            <input name="mypassword" id="mypassword" type="password" class="form-control"  style="width: 200px">
             </div></center>
           <br>
            <button name="Submit" id="submit" class="btn btn-default center-block" type="submit" style="width: 250px">Logar-se</button>

     
        </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>
    