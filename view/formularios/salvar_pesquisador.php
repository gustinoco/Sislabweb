<?php

include_once '../../entidade/Pesquisador.php';
include_once '../../entidade/BoletimSolo.php';


$dao = new Pesquisador();
$dao_solos = new BoletimSolo();
//Este isset é feito caso seja feita a chamada para deleta-lô, se existir boletins com o mesmo, é exibida a mensagem e os boletins que estão cadastrados no nome do mesmo.
//Caso não exista boletim é executado o excluimento do pesquisador.
if (isset($_GET['deletar'])) {
    $pesquisador_delete = $_GET['deletar'];
    $verifica = $dao_solos->lista_boletim_pesquisador($pesquisador_delete);
    if ($verifica == null) {
        $dao->deletar($pesquisador_delete);
        session_start();
        $_SESSION['mensagem'] = 'Pesquisador  <strong>' . $pesquisador_delete . '</strong> deletado com sucesso.';
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

//Verifica o checkbox da Permissao para admnistrador, caso seja 0 = Administrador, caso seje 1 = Pesquisador usuário.
//Também mapeia o objeto do _POST e faz o salvamento ou a edição do mesmo.
if (isset($_POST) AND ( count($_POST) > 0)) {
   if (strcasecmp($_POST["Permissao"], "true") == 0) {
    $_POST["Permissao"] = 0;
} else {
    $_POST["Permissao"] = 1;
}
     $pesquisador = new Pesquisador();
    $pesquisador->mapear($_POST);

    
    if ($pesquisador->Id > 0) {
        $dao->editar($pesquisador);
    } else {
        $id_autor = $dao->salvar($pesquisador);
    }
}

//Aqui é para mandar a mensagem e voltar se foi editado ou se foi incluso no sistema.
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