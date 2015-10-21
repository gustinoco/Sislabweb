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
                $mensagem1 = $_SESSION['sincronizar1'];
                $mensagem2 = $_SESSION['sincronizar2'];
                $mensagem3 = $_SESSION['sincronizar3'];
                $mensagem4 = $_SESSION['sincronizar4'];
                $mensagem5 = $_SESSION['sincronizar5'];
                ?>  
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $mensagem1 ?><br>
                <?php echo $mensagem2 ?> <br>
                <?php echo $mensagem3 ?><br>
                <?php echo $mensagem4 ?><br>
                <?php echo $mensagem5 ?></div>
                    <?php
                    unset($_SESSION['sincronizar1']);
                    unset($_SESSION['sincronizar2']);
                    unset($_SESSION['sincronizar3']);
                    unset($_SESSION['sincronizar4']);
                    unset($_SESSION['sincronizar5']);
                    
                }

                
                
include 'template/rodape.php'; 
?>