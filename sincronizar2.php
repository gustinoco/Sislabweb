<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha2 = "planilhas/$pesquisador/maquina2.xls";





$read2 = excel_read_file($Planilha2);
for ($i = 2; $i <= $read2[0]; $i++) {
    (int) $Id = $read2[1][$i][1];
    $pHCaCl2 = $read2[1][$i][2];
    $Al = $read2[1][$i][3];



    editar2($Id, $pHCaCl2, $Al, $pesquisador);
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

function editar2($Id, $pHCaCl2, $Al, $Pesquisador) {
    $sql = 'UPDATE SOLO SET 
        pHCaCl2 = :pHCaCl2 , Al = :Al, Data_cadastro = :Data_cadastro, Pesquisador = :Pesquisador WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':pHCaCl2' => $pHCaCl2,
            ':Al' => $Al,
            ':Pesquisador' => $Pesquisador,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
session_start();
$_SESSION['sincronizar2'] = 'Arquivo 2 foi importado com sucesso.';
header("Location: sincronizar3.php?pesquisador=".$pesquisador);
exit;