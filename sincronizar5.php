<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha5 = "planilhas/$pesquisador/Solo/maquina5.xls";





$read5 = excel_read_file($Planilha5);
for ($i = 2; $i <= $read5[0]; $i++) {
    (int) $Id = $read5[1][$i][1];
    $Areia = $read5[1][$i][12];
    $Silte = $read5[1][$i][13];
    $Argila = $read5[1][$i][14];
    editar5($Id, number_format($Areia, 2, ",", ""), number_format($Silte, 2, ",", ""), number_format($Argila, 2, ",", ""), $pesquisador);
}

function editar5($Id, $Areia, $Silte, $Argila, $Pesquisador) {
    $sql = 'UPDATE solo SET 
        Areia = :Areia , Silte = :Silte, Argila = :Argila, Data_cadastro = :Data_cadastro WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Areia' => $Areia,
            ':Silte' => $Silte,
            ':Argila' => $Argila,
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

header("Location: sincronizar6.php?pesquisador=" . $pesquisador);
exit;
