<?php
$page_title = "SisLab Web 1.0";
require_once 'restrito.php';
include 'template/cabecalho.php';
?>





<div class="row">

    <div class="col-md-12">
        <br><br><br><br><br>
        <center>


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
            
            



            <h3>Olá <?php echo $_SESSION['usuarioNome']; ?>, bem-vindo ao SisLabWeb 1.0, seu último acesso foi em  <?php echo date("d/m/Y", strtotime($_SESSION['data_acesso']));?> ás <?php echo date("H:m:s", strtotime($_SESSION['data_acesso']));?></h3>

        </center>
    </div></div>


<br /><br /><br />
<?php
if($_SESSION['Permissao'] == "0"){
include 'menu_administrador.php';    

}
else if($_SESSION['Permissao'] == "1"){
    include'menu_pesquisador.php';
}


if ($_GET['sincronizador']) {
                $mensagem = $_SESSION['sincronizar'];
               
                ?>  
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $mensagem ?><br>
           
                    <?php
                    unset($_SESSION['sincronizar']);
                  echo '</div>';
                    
                }

                
                
include 'template/rodape.php'; 
?>