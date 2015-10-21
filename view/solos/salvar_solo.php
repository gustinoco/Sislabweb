<?php

include_once '../../entidade/Solo.php';



$solo = new Solo();



if (isset($_GET['deletar'])) {
    $idSolo = (int) $_GET['deletar'];
    $idBoletim = (int) $_GET['boletim'];
    if ($idBoletim > 0) {
        $solo->deletar($idSolo);
    }
    else {
                $solo->deletar($idSolo);

    }





    session_start();
    $_SESSION['mensagem'] = 'Amostra de solo <strong>' . $idSolo . '</strong> deletada com sucesso.';
    header('Location: ../../view/main.php');
    exit;
}

if (isset($_POST) AND ( count($_POST) > 0)) {
    $solo->mapear($_POST);

    if ($solo->Id > 0) {
        $solo->editar($solo);
    } else {
        $id_solo = $solo->salvar($solo);
    }
}

session_start();




if ($solo->Id > 0) {
    $_SESSION['mensagem'] = '<h3>Solo número <b>' . $solo->Id . '</b> alteado com sucesso !!!</h3>';
    if($_session['ae']){
    header('Location: ../../view/solos/digita_result_externos.php?id='. $variavel_confirmacao_editar);
    exit;    
    }
    else{
    header('Location: ../../view/solos/digita_result_externos.php');
    exit;
    }
    
} else {

    $_SESSION['mensagem'] = 'Solo inserido com sucesso !!!';
    header('Location: ../../view/main.php');
    exit;
}
?>
