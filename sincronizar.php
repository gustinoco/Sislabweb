<?php

include_once 'conf/conexao.php';
include_once 'entidade/Solo.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();


$pesquisador = $_GET['pesquisador'];


$Planilha1 = "planilhas/$pesquisador/Solo/maquina1.xls";


$read1 = excel_read_file($Planilha1);


for ($i = 2; $i <= $read1[0]; $i++) {
    $Id = $read1[1][$i][1];
    $Al = $read1[1][$i][2];
    $K = $read1[1][$i][3];
    editar1($Id, number_format($Al, 2, ",", ""), number_format($K, 2, ",", ""), $pesquisador);
}

function editar1($Id, $Al, $K, $Pesquisador) {
    $sql = 'UPDATE solo SET 
        Al = :Al ,K = :K, Data_cadastro = :Data_cadastro WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Al' => $Al,
            ':K' => $K,
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


header("Location: sincronizar2.php?pesquisador=" . $pesquisador);
exit;
