<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha7 = "planilhas/$pesquisador/Planta/maquina1.xls";

function editar7($Id, $N, $C) {
    $sql = 'UPDATE planta SET 
        N = :N, 
        C = :C, 
        Data_cadastro = :Data_cadastro 
        WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':N' => $N,
            ':C' => $C,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$read7 = excel_read_file($Planilha7);

for ($i = 2; $i <= $read7[0]; $i++) {
    (int) $Id = $read7[1][$i][1];
    $N = $read7[1][$i][2];
    $C = $read7[1][$i][3];
    
    editar7($Id, number_format($N, 2, ",", ""), number_format($C, 2, ",", "") );
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

header("Location: sincronizar8.php?pesquisador=" . $pesquisador);
exit;
