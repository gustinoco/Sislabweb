<?php

include_once '../../entidade/BoletimPlanta.php';
include_once '../../entidade/Planta.php';
$dao = new BoletimPlanta();
$dao4 = new Planta();



//recebe ID do boletim para deletar ele, caso exista solos os IDS do boletim na tabela de solos serão mudadas para Nulo.
//Exibe mensagem de confirmação de sucesso na pagina de registro dos boletins.
if (isset($_GET['deletar'])) {
    $idBoletim = (int) $_GET['deletar'];
    $verifica = $dao4->listar_planta_idboletim($idBoletim);
    foreach ($verifica as $res) {
        $dao4->deslincar_boletim_amostra($res->Id);
        $solos_com_id.=$res->Id . ", ";
    }

    $dao->deletar($idBoletim);
    session_start();
    if ($solos_com_id > 0) {
        $_SESSION['mensagem_erro'] = 'Boletim  <strong>' . $idBoletim . '</strong> deletado com sucesso.' . 'E amostras de plantas: <strong>' . $solos_com_id . '</strong> foram deslicadas deste boletim';
        header('Location: ../../view/plantas/livro_registro.php');
    } else {

        $_SESSION['mensagem_erro'] = 'Boletim  <strong>' . $idBoletim . '</strong> deletado com sucesso.';
        header('Location: ../../view/plantas/livro_registro.php');
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
    $boletim = new BoletimPlanta();
    $boletim->mapear($_POST);

    if ($boletim->Id > 0) {
        $dao->editar($boletim);
        $id_planta = $boletim->Id;
    } else {
        $id_planta = $dao->salvar($boletim); //salva o boletim com os dados principais.
        
        //faz as inserções das amostras no boletim de acordo com campos inseridos 
        (int) $intervalor1 = $_POST["Intervalo1"];
        (int) $intervalor2 = $_POST["Intervalo2"];
        $identificacao = $_POST["Identificacao"];
        $aux = 0;

        if (strcmp($_POST['Macro'], "true") == 0) {
            $_POST["Macro"] = 1;
        } else {
            $_POST["Macro"] = 0;
        }

 

        if (strcmp($_POST['Micro'], "true") == 0) {
            $_POST["Micro"] = 1;
        } else {
            $_POST["Micro"] = 0;
        }

        if (strcmp($_POST['Somente_n'], "true") == 0) {
            $_POST["Somente_n"] = 1;
        } else {
            $_POST["Somente_n"] = 0;
        }
        if ($intervalor1 == 0) {
            
        } else {
            for ($i = $intervalor1; $i <= $intervalor2; $i++) {
                $aux++;
                $dao4->salvar_nulo($i, $_POST['Pesquisador'], $id_planta, $aux . "-" . $identificacao, $_POST["Macro"], $_POST["Micro"], $_POST["Somente_n"]);
            }
        }
    }
}

//Faz a leitura das amostras inseridas e edita as amostras dos campos que são mostrados e vinculados ao IDBOLETIM retornado 
//da ultima inserção pelo lastInsertId
if (isset($_POST["myInputs"])) {
    $listas = $_POST["myInputs"];
    foreach ($listas as $res) {
        if (strcmp($res['Macro'], "true") == 0) {
            $res["Macro"] = 1;
        } else {
            $res["Macro"] = 0;
        }

       
        if (strcmp($res['Micro'], "true") == 0) {
            $res["Micro"] = 1;
        } else {
            $res["Micro"] = 0;
        }

        if (strcmp($res['Somente_n'], "true") == 0) {
            $res["Somente_n"] = 1;
        } else {
            $res["Somente_n"] = 0;
        }

        $res = (object) $res;
        $dao4->mapear($res);
        $dao4->salvar_boletins($dao4, $id_planta);
    }
}





if ($boletim->Id > 0) {
    session_start();

    $_SESSION['mensagem'] = 'O Boletim de número <strong>' . $id_planta . '</strong> foi alterado com sucesso. ';
    header("Location: ../../view/plantas/livro_registro.php");
    exit;
} else {
    session_start();

    $_SESSION['mensagem'] = 'O Boletim de número <strong>' . $id_planta . '</strong> foi inserido com sucesso. ';
    header("Location: ../../view/plantas/livro_registro.php");
    exit;
}
exit;
?>