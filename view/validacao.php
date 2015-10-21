<?php

include_once '../entidade/Pesquisador.php';
include __DIR__ . '/../conf/conexao.php';


/** CRIA UMA SESSÃO */
if (!isset($_SESSION)) {
    session_start();
}


/* * VERIFICA SE HOUVE POST E SE O USUARIO OU A SENHA É(SÃO) VAZIOS */
if (!empty($_POST) AND ( empty($_POST['Usuario']) OR empty($_POST['Senha']))) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

/** TRATA ENTRADA DE DADOS */
$daoPesquisador = new Pesquisador();
$usuario = $daoPesquisador->login($_POST['Usuario'], $_POST['Senha']);

//verifica se existe login
if (!$usuario->Login) {
    session_destroy();
    header("Location: ../index.php?erro=erro");

    exit;
    
}


if($usuario->Login){
    
    session_start();


/** SALVA USUARIO NA SESSÃO */

$_SESSION['usuarioNome'] = $usuario->Login;
$_SESSION['data_acesso'] = $usuario->Data_ultimo_acesso;
$_SESSION['Permissao'] = $usuario->Permissao;


/** REDIRECIONA USUARIO PARA PAGINA RESTRITA */
header("Location: ../view/main.php");
exit;
    
}
?>