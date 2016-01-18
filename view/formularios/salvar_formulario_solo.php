<?php

include_once '../../entidade/BoletimSolo.php';
include_once '../../entidade/Solo.php';
$dao = new BoletimSolo();
$dao4 = new Solo();



//recebe ID do boletim para deletar ele, caso exista solos os IDS do boletim na tabela de solos serão mudadas para Nulo.
//Exibe mensagem de confirmação de sucesso na pagina de registro dos boletins.
if (isset($_GET['deletar'])) {
    $idBoletim = (int) $_GET['deletar'];
    $verifica = $dao4->listar_solo_idboletim($idBoletim);
    foreach ($verifica as $res) {
        $dao4->deslincar_boletim_amostra($res->Id);
        $solos_com_id.=$res->Id . ", ";
    }

    $dao->deletar($idBoletim);
    session_start();
    if ($solos_com_id > 0) {
        $_SESSION['mensagem_erro'] = 'Boletim  <strong>' . $idBoletim . '</strong> deletado com sucesso.' . 'E amostras de solos: <strong>' . $solos_com_id . '</strong> foram deslicadas deste boletim';
        header('Location: ../../view/solos/livro_registro.php');
    } else {

        $_SESSION['mensagem_erro'] = 'Boletim  <strong>' . $idBoletim . '</strong> deletado com sucesso.';
        header('Location: ../../view/solos/livro_registro.php');
    }

    exit;
}
//fim metodo de exclusão de boltim


//converte checkbox pesquisa para true ou false (0 ou 1)
if (strcasecmp($_POST["Pesquisa"], "true") == 0) {
    $_POST["Pesquisa"] = 1;
} else {
    $POST["Pesquisa"] = 0;
}
//fim deletação







//Pega campos em comun do boletim e adiciona.

if (isset($_POST) AND ( count($_POST) > 0)) {
    $boletim = new BoletimSolo();
    $boletim->mapear($_POST);

    if ($boletim->Id > 0) {
        $dao->editar($boletim);
        $id_solo = $boletim->Id;
    } else {
        $id_solo = $dao->salvar($boletim); //salva o boletim com os dados principais.
        
        //faz as inserções das amostras no boletim de acordo com campos inseridos 
        (int) $intervalor1 = $_POST["Intervalo1"];
        (int) $intervalor2 = $_POST["Intervalo2"];
        $identificacao = $_POST["Identificacao"];
        $aux = 0;

        if (strcmp($_POST['Rotina'], "true") == 0) {
            $_POST["Rotina"] = 1;
        } else {
            $_POST["Rotina"] = 0;
        }

        if (strcmp($_POST['Mo'], "true") == 0) {
            $_POST["Mo"] = 1;
        } else {
            $_POST["Mo"] = 0;
        }

        if (strcmp($_POST['Micro'], "true") == 0) {
            $_POST["Micro"] = 1;
        } else {
            $_POST["Micro"] = 0;
        }

        if (strcmp($_POST['Textura'], "true") == 0) {
            $_POST["Textura"] = 1;
        } else {
            $_POST["Textura"] = 0;
        }
        if ($intervalor1 == 0) {
            
        } else {
            for ($i = $intervalor1; $i <= $intervalor2; $i++) {
                $aux++;
                $dao4->salvar_nulo($i, $_POST['Pesquisador'], $id_solo, $aux . "-" . $identificacao, $_POST["Rotina"], $_POST["Mo"], $_POST["Micro"], $_POST["Textura"]);
            }
        }
    }
}

//Faz a leitura das amostras inseridas e edita as amostras dos campos que são mostrados e vinculados ao IDBOLETIM retornado 
//da ultima inserção pelo lastInsertId
if (isset($_POST["myInputs"])) {
    $listas = $_POST["myInputs"];
    foreach ($listas as $res) {
        if (strcmp($res['Rotina'], "true") == 0) {
            $res["Rotina"] = 1;
        } else {
            $res["Rotina"] = 0;
        }

        if (strcmp($res['Mo'], "true") == 0) {
            $res["Mo"] = 1;
        } else {
            $res["Mo"] = 0;
        }

        if (strcmp($res['Micro'], "true") == 0) {
            $res["Micro"] = 1;
        } else {
            $res["Micro"] = 0;
        }

        if (strcmp($res['Textura'], "true") == 0) {
            $res["Textura"] = 1;
        } else {
            $res["Textura"] = 0;
        }

        $res = (object) $res;
        $dao4->mapear($res);
        $dao4->salvar_boletins($dao4, $id_solo);
    }
}





if ($boletim->Id > 0) {
    session_start();

    $_SESSION['mensagem'] = 'O Boletim de número <strong>' . $id_solo . '</strong> foi alterado com sucesso. ';
    header("Location: ../../view/solos/livro_registro.php");
    exit;
} else {
    session_start();

    $_SESSION['mensagem'] = 'O Boletim de número <strong>' . $id_solo . '</strong> foi inserido com sucesso. ';
    header("Location: ../../view/solos/livro_registro.php");
    exit;
}
exit;
?>