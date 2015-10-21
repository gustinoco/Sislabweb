<center>
    <a href="formularios/form_cliente.php" class="btn btn-lg btn-warning" role="button">Menu Cliente</a>
    <a href="formularios/form_pesquisador.php" class="btn btn-lg btn-warning" role="button">Menu Pesquisador</a>


</center></br>


<center><div class="row">
        <div class="col-md-6">
            <h3><b>Opções para solos</b></h3>
            <br>

            <p><a href="solos/digita_result_externos.php" class="btn btn-lg btn-default" role="button">Todas amostras</a></p>

            <p><a href="solos/digita_result_pesquisa.php" class="btn btn-lg btn-default" role="button">Entrada manual</a></p>

            
            <hr>

            <p><a href="formularios/form_boletim_solo.php" class="btn btn-lg btn-default" role="button">Cadastrar Boletim</a></p>

            <p><a href="solos/livro_registro.php" class="btn btn-lg btn-default" role="button">Livro registro de boletins</a></p>

        </div>

        <div class="col-md-6">
            <h3><b>Opções para plantas</b></h3><br>

            <p><a href="plantas/digita_result_externos.php" class="btn btn-lg btn-default" role="button">Todas amostras</a></p>

            <p><a href="plantas/digita_result_pesquisa.php" class="btn btn-lg btn-default" role="button">Entrada manual</a></p>

            <hr>
<p><a href="formularios/form_boletim_planta.php" class="btn btn-lg btn-default" role="button">Cadastrar Boletim</a></p>

            <p><a href="plantas/livro_registro.php" class="btn btn-lg btn-default" role="button">Livro de Registro de boletins</a></p>
            
        </div>

        <hr>

        <div class="col-md-12">
            <hr>
            <p><a href="../sincronizar.php?pesquisador=<?php echo $_SESSION['usuarioNome'];?>" class="btn btn-lg btn-success" role="button">Sincronizar servidor</a></p>
        </div>
    </div> </center>