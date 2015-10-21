<?php

include_once '../../entidade/Pesquisador.php';
include_once '../../entidade/BoletimSolo.php';


$dao = new Pesquisador();
$dao_solos = new BoletimSolo();

if (isset($_GET['deletar'])) {
    $idPesquisador = (int) $_GET['deletar'];
    
    $verifica = $dao_solos->verifica_boletim($idPesquisador);
    if ($verifica == null) {
        $dao->deletar($idPesquisador);
        session_start();
        $_SESSION['mensagem'] = 'Pesquisador  <strong>' . $idPesquisador . '</strong> deletado com sucesso.';
        header('Location: ../../view/formularios/form_pesquisador.php#menu2');
        exit;
    } else {
        session_start();
        $boletins_com_id = "";
        foreach($verifica as $res){
            $boletins_com_id.=$res->Id.", ";
        }
        $_SESSION['mensagem_erro'] = 'Não foi possível deletar o pesquisador pois consta boletins em nome do mesmo são eles:  <strong>'.$boletins_com_id . '</strong>';
        header('Location: ../../view/formularios/form_pesquisador.php#menu2');
        exit;
    }
}


if (isset($_POST) AND ( count($_POST) > 0)) {
   if (strcasecmp($_POST["Permissao"], "true") == 0) {
    $_POST["Permissao"] = 0;
} else {
    $_POST["Permissao"] = 1;
}
   
    $pesquisador = new Pesquisador();
    $pesquisador->mapear($_POST);

    $pesquisador->Id = (int) $pesquisador->Id;
    if ($pesquisador->Id > 0) {
        $dao->editar($pesquisador);
    } else {
        $id_autor = $dao->salvar($pesquisador);
    }
}


if ($pesquisador->Id > 0) {
    session_start();
    $_SESSION['mensagem'] = 'O pesquisador foi salvo com sucesso. ';
    header("Location: ../../view/formularios/form_pesquisador.php#menu2");
    exit;
} else {
    session_start();
    $_SESSION['mensagem'] = 'O pesquisador foi inserido com sucesso. ';
    header("Location: ../../view/formularios/form_pesquisador.php#menu2");
    exit;
}
exit;
?>