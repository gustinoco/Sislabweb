<?php

// Evita que usuários acesse este arquivo diretamente
//if (!defined('ABSPATH')) exit;
//Constantes para conexão
define("PORT", "3307");
define("DB", "sislabweb");
define("END", "localhost");
define("USER", "root");
define("PASS", "embrapa");




//Conexão com o servidor
function getConexao() {
    $conn = new PDO('mysql:host=' . END . ';port=' . PORT . ';dbname=' . DB . ';charset=utf8', USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
    
}

function tratar_entrada($entrada) {
    return mysql_escape_string($entrada);
}

?>