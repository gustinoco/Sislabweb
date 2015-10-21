<?php 

require_once '../restrito.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/dao/PragaDAO.class.php';

include '../salvaFoto.php';
define("DIR_FOTOS", $_SERVER['DOCUMENT_ROOT']."/resource/img/fotos/");

$daoP = new PragaDAO();

if(isset($_POST) AND (count($_POST)>0)){
	$praga = new Praga();
	$praga->mapear($_POST);

	if($praga->id > 0){
		$daoP->editar($praga);
		salvarFotos($_FILES,$praga->id);
	}else{
		$id_praga =	$daoP->salvar($praga);
		//salvar fotos 
		salvarFotos($_FILES,$id_praga);
	}

}
header('Location: ../consultar/praga.php');
exit;
?>