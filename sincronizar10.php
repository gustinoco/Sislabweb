<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha10 = "planilhas/$pesquisador/Planta/maquina4.xls";

function editar10($B) {
    $sql = 'UPDATE planta SET 
        B = :B, 
        Data_cadastro = :Data_cadastro 
        WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':B' => $B,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$read10 = excel_read_file($Planilha10);

for ($i = 2; $i <= $read10[0]; $i++) {
    (int) $Id = $read10[1][$i][1];
    $B = $read10[1][$i][2];
    editar10($Id, number_format($B, 2, ",", ""));
}

function excel_read_file($name) {
    GLOBAL $excel;
    $excel->read($name);
    $x = 1;

    while ($x <= $excel->sheets[0]['numRows']) {
        $y = 1;
        while ($y <= $excel->sheets[0]['numCols']) {
            $cell[$x][$y] = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';

            $y++;
        }
        $x++;
    }
    $arr = array($x, $cell);
    return ($arr);
}

session_start();
$_SESSION['sincronizar'] = 'Todos os arquivos foram importados com sucesso.';
header("Location: view/main.php?sincronizador=ok");
exit;
