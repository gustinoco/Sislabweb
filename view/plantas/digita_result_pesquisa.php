<?php
$page_title = "SISLABWEB 1.0 - Digita Resultados de Pesquisa Plantas";
include '../../view/template/cabecalho.php';
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
        display: block;
    }

    .campo select option {
        padding-right: 1em;
    }

    .campo input:focus, .campo select:focus, .campo textarea:focus {
        background: #FFC;
    }

</style>
<script type="text/javascript">
    function confere() {
        if (document.getElementById("Fator").value == "") {
            alert("Por favor, preencha o Fator.");
            return false;
        }
       
        return true;
    }



</script>
<body>
    <div class="container">
        <div class="row">
            <div class="artsplantas">
                <div class="page-header">
                    <br><br><br>
                    <center><h1>Digita Resultado Pesquisa</h1></center>
                </div>
                <form name="form" method="post" onSubmit="return confere()" enctype="multipart/form-data" action="salvar_planta.php">


                    <center>
                        <fieldset class="grupo">
                            <div class="campo">
                                <label for="cidade">Nº Lab</label>
                                <input type="text" id="nlab" name="nlab" style="width: 4em" value="" />
                            </div>

                            <div class="campo">
                                <label for="estado">Fator</label>
                                <input type="text" id="Fator" name="Fator" style="width: 5em" value="" />
                            </div>

                            <div class="campo">
                                <label for="estado">Vol. Gasto</label>
                                <input type="text" id="VolGasto" name="VolGasto" style="width: 7em" value="" />

                            </div>

                            <div class="campo">
                                <label for="estado">P</label>
                                <input type="text" id="P" name="P" style="width: 5em" value="" />

                            </div>


                            <div class="campo">
                                <label for="estado">K</label>
                                <input type="text" id="K" name="K" style="width: 5em" value="" />

                            </div>


                            <div class="campo">
                                <label for="estado">Ca</label>
                                <input type="text" id="Ca" name="Ca" style="width: 5em" value="" />

                            </div>

                            <div class="campo">
                                <label for="estado">Mg</label>
                                <input type="text" id="Mg" name="Mg" style="width: 7em" value="" />
                            </div>


                            <div class="campo">
                                <label for="estado">S</label>
                                <input type="text" id="S" name="S" style="width: 5em" value="" />
                            </div>


                            <div class="campo">
                                <label for="estado">Cu</label>
                                <input type="text" id="Cu" name="Cu" style="width: 6em" value="" />
                            </div>


                            <div class="campo">
                                <label for="estado">Fe (mg dm-3)</label>
                                <input type="text" id="Fe" name="Fe" style="width: 8em" value="" />
                            </div>

                            <div class="campo">
                                <label for="estado">Mn(mg dm-3)</label>
                                <input type="text" id="Mn" name="Mn" style="width: 8em" value="" />
                            </div>


                            <div class="campo">
                                <label for="estado">Zn (mg dm-3)</label>
                                <input type="text" id="Zn" name="Zn" style="width: 8em" value="" />
                            </div>


                            <div class="campo">
                                <label for="estado">B (mg dm-3)</label>
                                <input type="text" id="B" name="B" style="width: 8em" value="" />
                            </div>

                            <div class="campo">
                                <br>
                                <button class="btn-xs btn-success"type="submit" name="submit">Salvar</button>
                            </div>
                        </fieldset>              
                    </center>


            </div>

        </div>





        <?php
        include '../../view/template/rodape.php';
        ?>