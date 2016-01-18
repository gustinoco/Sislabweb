<?php
$page_title = "SISLABWEB 1.0 - Digita Resultados de Pesquisa";
include '../../view/template/cabecalho.php';
include '../../entidade/Planta.php';
require_once '../../view/restrito.php';

$dao = new Planta();
$ultimoId = $dao->lista_ultimo_id();


?>


</div>
<style>

    * {
        margin: 0;
        padding: 0;
    }

    fieldset {
        border: 0;
    }

    body, input, select, textarea, button {
        font-family: sans-serif;
        font-size: 1em;
    }

    .grupo:before, .grupo:after {
        content: " ";
        display: table;
    }

    .grupo:after {
        clear: both;
    }
    .campo {
            margin-bottom: 1em;
    }
     
    .campo label {
            margin-bottom: 0.2em;
            color: #666;
            display: block;
    }

    fieldset.grupo .campo {
        float:  left;
        margin-right: 1em;
    }
    .campo input[type="text"],
    .campo input[type="email"],
    .campo input[type="url"],
    .campo input[type="tel"],
    .campo select,
    .campo textarea {
        padding: 0.2em;
        border: 1px solid #CCC;
        box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
        display:  block;
    }

    .campo select option {
        padding-right: 1em;
    }

    .campo input:focus, .campo select:focus, .campo textarea:focus {
        background: #FFC;
    }

</style>

<body>
    <div class="container-fluid">
        <div class="row">
            
                <div class="page-header">
                    <br><br><br>
                    <center><h1>Entrada manual de dados</h1></center>
                </div>
                <form name="form" method="post" enctype="multipart/form-data" action="salvar_planta.php">
                    <center>
                        <fieldset class="grupo">
                            <div class="campo">
                                <label>Nº Lab</label>
                                <input  type="text" id="nlab" name="nlab"  value="<?php echo $ultimoId['MaximoId'] + 1; ?>" readonly="readonly" />
                            </div>

                            <div class="campo">
                                <label>Pesquisador</label>
                                <input hidden id="Pesquisador" name="Pesquisador" style="width: 8em" value="<?php echo $_SESSION['usuarioNome']; ?>" />
                                <br><label class="breadcrumb"><?php echo $_SESSION['usuarioNome'];?></label>
                            </div>

                            <div class="campo">
                                <label>C</label>
                                <input type="text" id="C" name="C" style="width: 5em" value="" />
                            </div>
                            
                            <div class="campo">
                                <label>N</label>
                                <input type="text" id="N" name="N" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>P</label>
                                <input type="text" id="P" name="P" style="width: 5em" value="" />
                            </div>
                            
                              <div class="campo">
                                <label>K</label>
                                <input type="text" id="K" name="K" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>Ca</label>
                                <input type="text" id="Ca" name="Ca" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>Mg</label>
                                <input type="text" id="Mg" name="Mg" style="width: 5em" value="" />
                            </div>

                            

                            <div class="campo">
                                <label>S</label>
                                <input type="text" id="S" name="S" style="width: 6em" value="" />
                            </div>

                            <div class="campo">
                                <label>Cu</label>
                                <input type="text" id="Cu" name="Cu" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>Fe</label>
                                <input type="text" id="Fe" name="Fe" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>Mn</label>
                                <input type="text" id="Mn" name="Mn" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>Zn</label>
                                <input type="text" id="Zn" name="Zn" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label>B</label>
                                <input type="text" id="B" name="B" style="width: 5em" value="" />
                            </div>

                                                 
                            <div class="campo">
                                <br>
                                <button class="btn-xs btn-success" type="submit" name="submit">Salvar</button>
                            </div>
                        </fieldset>              
                    </center>
                </form>
            </div>

        <?php
include '../../view/template/rodape.php';
