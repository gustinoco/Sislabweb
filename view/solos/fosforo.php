<?php

$page_title = "SISLABWEB 1.0 - ";
include '../../view/template/cabecalho.php';
?>

<script>
    $(function () {

        // pegando o formulário quando o usuário clicar em "logar"
        $("#formulario").submit(function (evento) {
            // evitando que o evento faça refresh na página
            evento.preventDefault();

            // pegando todos os campos do formulário e montando um array de campos para enviar para o servidor
            var campos = $(this).serialize();

            $.ajax({
                data: campos, // dados que serão enviados para o servidor
                url: "digita_result_pesquisa.php", // url a buscar sem fazer refresh (ajax)
                type: "POST", // método de envio dos dados (GET,POST)
                dataType: "html", // como será recebida a resposta do servidor (html,json)
                success: function (data) { // função que tras a resposta quando tudo der certo
                    $("#reposta").html(data);
                },
                error: function () {
                    alert("problema ao carregar a solicitação");
                }
            });

        });

    });
</script>

<body>
    <div class="row">
        <div class="artsplantas">
            <br/><br/><br/>

            <form name="form" method="post" onSubmit="return confere()" enctype="multipart/form-data" action="salvar_fosforo.php">
                <fieldset>
                    
                    
                    <input type="file" name="arquivo" />
                    
                    
                    <select name="tipo_funcao">
                        <option value="exponencial">Expônencial</option>
                        <option value="tipo2">Tipo 2</option>
                        <option value="tipo3">Tipo 3</option>
                        <option value="Tipo4">Tipo 4</option>
                    </select>





                    <button class="btn-xs btn-success"type="submit" name="submit">Salvar</button>
                </fieldset>
            </form>

        </div>
    </div>

<?php
