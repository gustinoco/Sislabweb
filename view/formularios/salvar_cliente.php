<?php

include_once '../../entidade/Cliente.php';
include_once '../../entidade/BoletimSolo.php';
include_once '../../entidade/Propriedade.php';


$dao = new Cliente();
$dao_solos = new BoletimSolo();
$daoPropriedade = new Propriedade();

if (isset($_GET['deletar'])) {
    $idCliente = (int) $_GET['deletar'];

    $verifica = $dao_solos->verifica_boletim($idCliente);
    if ($verifica == null) {
        $dao->deletar($idCliente);
        session_start();
        $_SESSION['mensagem'] = 'Cliente  <strong>' . $idCliente . '</strong> deletado com sucesso.';
        header('Location: ../../view/formularios/form_cliente.php#menu2');
        exit;
    } else {
        session_start();
        $boletins_com_id = "";
        foreach ($verifica as $res) {
            $boletins_com_id.=$res->Id . ", ";
        }
        $_SESSION['mensagem_erro'] = 'Não foi possível deletar o cliente pois consta boletins em nome do mesmo são eles:  <strong>' . $boletins_com_id . '</strong>';
        header('Location: ../../view/formularios/form_cliente.php#menu2');
        exit;
    }
}

if (isset($_POST) AND ( count($_POST) > 0)) {
    $cliente = new Cliente();
    $cliente->mapear($_POST);
    if ($cliente->Id > 0) {
        $dao->editar($cliente);
        $listas = $_POST["myInputs"];
    foreach ($listas as $res) {
        $res = (object) $res;
        $daoPropriedade->mapear($res);
        if ($res->Id > 0) {
            $daoPropriedade->editar($daoPropriedade);
        } else {

            $daoPropriedade->salvar_propriedades($daoPropriedade, $cliente->Id);
        }
    }
    } else {
        $id_autor = $dao->salvar($cliente);
        $listas = $_POST["myInputs"];
    foreach ($listas as $res) {
        $res = (object) $res;
        $daoPropriedade->mapear($res);
        if ($res->Id > 0) {
            $daoPropriedade->editar($daoPropriedade);
        } else {

            $daoPropriedade->salvar_propriedades($daoPropriedade, $id_autor);
        }
    }
        
        
        
    }
}




if ($cliente->Id > 0) {
    session_start();
    $_SESSION['mensagem'] = 'O cliente foi salvo com sucesso. ';
    header("Location: ../../view/formularios/form_cliente.php#menu2");
    exit;
} else {
    session_start();
    $_SESSION['mensagem'] = 'O cliente foi inserido com sucesso. ';
    header("Location: ../../view/formularios/form_cliente.php#menu2");
    exit;
}
exit;
?>