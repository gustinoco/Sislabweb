<?php
//include '../../view/template/cabecalho.php';

require_once '../../conf/conexao.php';
require_once '../../view/restrito.php';
include '../../entidade/Propriedade.php';


$cliente = $_GET['cliente'];


$dao = new Propriedade();
$listar_com_pesquisador = $dao->listar_propriedades_cliente($cliente);


?>

 <div class="form-inline" id="PropriedadesAjax">
              <label>Selecione uma propriedade:</label>
            <select style="min-width:61.2%" name="Propriedade" id="Propriedade" class="form-control">    
                
               <?php foreach($listar_com_pesquisador as $res){
	
?>
	<option class="form-control" value="<?php echo $res->Id?>"><?php echo $res->Nome?></option>
<?php }?>
                    
                            
            </select>
            
        </div>
        
        
