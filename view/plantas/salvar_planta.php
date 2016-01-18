<?php

include_once '../../entidade/Planta.php';



$planta = new Planta();



if (isset($_GET['deletar'])) {
    $idPlanta = (int) $_GET['deletar'];
    $idBoletim = (int) $_GET['boletim'];
    if ($idBoletim > 0) {
        $planta->deletar($idPlanta);
    }
    else {
                $planta->deletar($idPlanta);

    }





    session_start();
    $_SESSION['mensagem'] = 'Amostra de planta <strong>' . $idPlanta . '</strong> deletada com sucesso.';
    header('Location: ../../view/main.php');
    exit;
}

if (isset($_POST) AND ( count($_POST) > 0)) {
    $planta->mapear($_POST);

    if ($planta->Id > 0) {
        $planta->editar($planta);
    } else {
        $id_solo = $planta->salvar($planta);
    }
}

session_start();




if ($planta->Id > 0) {
    $_SESSION['mensagem'] = '<h3>Planta número <b>' . $planta->Id . '</b> alteado com sucesso !!!</h3>';
    if($_session['ae']){
    header('Location: ../../view/plantas/digita_result_externos.php?id='. $variavel_confirmacao_editar);
    exit;    
    }
    else{
    header('Location: ../../view/plantas/digita_result_externos.php');
    exit;
    }
    
} else {

    $_SESSION['mensagem'] = 'Planta inserida com sucesso !!!';
    header('Location: ../../view/main.php');
    exit;
}
?>
