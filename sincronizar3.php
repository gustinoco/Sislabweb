<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha3 = "planilhas/$pesquisador/Solo/maquina3.xls";





$read3 = excel_read_file($Planilha3);
for ($i = 2; $i <= $read3[0]; $i++) {
    (int) $Id = $read3[1][$i][1];
    $Pmehl = $read3[1][$i][2];




    editar3($Id, number_format($Pmehl, 2, ",", ""), $pesquisador);
}

function editar3($Id, $Pmehl, $Pesquisador) {
    $sql = 'UPDATE solo SET 
        Pmehl = :Pmehl, Data_cadastro = :Data_cadastro WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Pmehl' => $Pmehl,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
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

header("Location: sincronizar4.php?pesquisador=" . $pesquisador);
exit;
