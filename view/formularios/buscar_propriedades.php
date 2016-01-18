<?php
/**
 * Arquivo que faz a busca da propriedade de acordo com o cliente para o select no formuláriod e boletim.
 * @package view
 * @subpackage formularios
 * @since 1.0
 *  
 */
//Includes necessários
require_once '../../conf/conexao.php';
require_once '../../view/restrito.php';
include '../../entidade/Propriedade.php';





$dao = new Propriedade(); //Instancia o objeto Propriedade
$propriedades_cliente = $dao->listar_propriedades_cliente($_GET['cliente']);  //Busca no Banco de dados as propriedades do cliente selecionado pelo ID do navegador.
?>

<div class="form-inline" id="PropriedadesAjax">
    <label>Selecione uma propriedade:</label>
    <select style="min-width:61.2%" name="Propriedade" id="Propriedade" class="form-control">    

        <?php
//Faz um loop em todos o objeto e cria as options do html com as propriedades. Value ID quando for selecionado e exibe o nome da propriedade
        foreach ($propriedades_cliente as $res) {
            ?>
            <option class="form-control" value="<?php echo $res->Id ?>"><?php echo $res->Nome ?></option>
        <?php } ?>


    </select>

</div>