<?php

include_once '../../entidade/Planta.php';


$dao = new Planta();

if (isset($_POST) AND ( count($_POST) > 0)) {
    $planta = new Planta();
    $planta->mapear($_POST);

    if ($planta->id > 0) {
        $dao->editar($planta);
    } else {
        $id_planta = $dao->salvar($planta);
    }
}

session_start();
$_SESSION['mensagem'] = 'Planta inserida com sucesso !!!';


header('Location: ../../view/main.php');
exit;
?>
