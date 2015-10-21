<?php

include_once '../../entidade/PMehlnSolo.php';


$dao = new PMehlnSolo();

if (isset($_POST) AND ( count($_POST) > 0)) {
    $fosforo = new PMehlnSolo();
    $fosforo->mapear($_POST);
    $id_fosforo = $dao->salvar($fosforo);
}

session_start();




exit;
?>
