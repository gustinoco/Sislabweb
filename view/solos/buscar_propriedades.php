<?php
require_once './conf/conexao.php';
require_once 'view/restrito.php';
include 'entidade/Propriedade.php';


$cliente = $_GET['cliente'];


$dao = new Propriedade();
$listar_com_pesquisador = $dao->listar_propriedades_cliente($cliente);


?>
<select name="propriedade" id="propriedade">
    
<?php foreach($listar_com_pesquisador as $res){
	
?>
	<option  style="width: 900px;" class="form-control" value="<?php echo $res->Id?>"><?php echo $res->Nome?></option>
<?php }?>
</select>