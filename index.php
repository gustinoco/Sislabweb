<?php
$page_title = 'SisLabWeb 1.0 - Login';
include 'view/template/cabecalho.php';

?>

<div class="row">
    
        <br/><br/><br/>

        <div class="page-header">
            <center><h1>SisLabWeb - Login</h1></center>
        </div> 
        
        <form method="post" action="view/validacao.php">
                <center>
                    <label>Usuario:</label>
                    <input name="Usuario" id="txtUsuario" type="text" class="form-control well" style="width: 250px;">

                    <br />
                    
                    <label>Senha:</label>
                    <input name="Senha" id="txtSenha" type="password" class="form-control well"  style="width: 200px">
                </center>
            
                <br /><br />

                <button class="btn btn-default center-block" type="submit" style="width: 250px">Logar-se</button>

        </form>
        <?php 
         if (isset($_GET['erro'])) {
                $mensagem = 'Usuário e/ou senha inválidos';
                ?>  <br>
                <div class="alert alert-danger fade in " style="margin-left: 30%; margin-right: 30%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $mensagem; ?></div>
                    <?php
                    
                }
                
                ?>
        

    </div> 

<?php 
include 'view/template/rodape.php';
