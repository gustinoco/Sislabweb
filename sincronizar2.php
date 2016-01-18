<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha2 = "planilhas/$pesquisador/Solo/maquina2.xls";





$read2 = excel_read_file($Planilha2);
for ($i = 2; $i <= $read2[0]; $i++) {
    (int) $Id = $read2[1][$i][1];
    $Phcacl2 = $read2[1][$i][2];
    
    $Hal3 = $read2[1][$i][4];



    editar2($Id, number_format($Phcacl2, 2, ",", ""),number_format($Hal3, 2, ",", ""), $pesquisador);
}

function editar2($Id, $Phcacl2, $Hal3, $Pesquisador) {
    $sql = 'UPDATE solo SET 
        Phcacl2 = :Phcacl2, Hal3 = :Hal3, Data_cadastro = :Data_cadastro WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Phcacl2' => $Phcacl2,
            ':Hal3' => $Hal3,
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

header("Location: sincronizar3.php?pesquisador=" . $pesquisador);
exit;
