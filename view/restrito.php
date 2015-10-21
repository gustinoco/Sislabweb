<?php 
if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['usuarioNome'])){
	session_destroy();
	header("Location: ../../../sislabweb/index.php"); 
	exit;
}
?>