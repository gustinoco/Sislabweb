<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha4 = "planilhas/$pesquisador/maquina4.xls";





$read4 = excel_read_file($Planilha4);
for ($i = 2; $i <= $read4[0]; $i++) {
    (int) $Id = $read4[1][$i][1];
    $Fator = $read4[1][$i][2];
    $Presin = $read4[1][$i][3];
    $Normalidade = $read4[1][$i][4];
    $Massa = $read4[1][$i][5];
    $Vol_gasto = $read4[1][$i][6];



    editar4($Id, $Fator, $Presin, $Normalidade, $Massa, $Vol_gasto, $pesquisador);
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

function editar4($Id, $Fator, $Presin, $Normalidade, $Massa, $Vol_gasto, $Pesquisador) {
    $sql = 'UPDATE SOLO SET 
        Fator = :Fator, Presin = :Presin, Normalidade = :Normalidade, Massa = :Massa, Vol_gasto = :Vol_gasto, Data_cadastro = :Data_cadastro, Pesquisador = :Pesquisador WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Fator' => $Fator,
            ':Presin' => $Presin,
            ':Normalidade' => $Normalidade,
            ':Massa' => $Massa,
            ':Vol_gasto' => $Vol_gasto,
            ':Pesquisador' => $Pesquisador,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
session_start();
$_SESSION['sincronizar4'] = 'Arquivo 4 foi importado com sucesso.';
header("Location: sincronizar5.php?pesquisador=".$pesquisador);
exit;