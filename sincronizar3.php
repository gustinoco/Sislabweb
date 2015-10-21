<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha3 = "planilhas/$pesquisador/maquina3.xls";





$read3 = excel_read_file($Planilha3);
for ($i = 2; $i <= $read3[0]; $i++) {
    (int) $Id = $read3[1][$i][1];
    $Ca = $read3[1][$i][2];
    $Mg = $read3[1][$i][3];
    $Hal3 = $read3[1][$i][4];
    $Kmgdm3 = $read3[1][$i][5];



    editar3($Id, $Ca, $Mg, $Hal3, $Kmgdm3, $pesquisador);
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

function editar3($Id, $Ca, $Mg, $Hal3, $Kmgdm3, $Pesquisador) {
    $sql = 'UPDATE SOLO SET 
        Ca = :Ca , Mg = :Mg, Hal3 = :Hal3, Kmgdm3 = :Kmgdm3, Data_cadastro = :Data_cadastro, Pesquisador = :Pesquisador WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Ca' => $Ca,
            ':Mg' => $Mg,
            ':Hal3' => $Hal3,
            ':Kmgdm3' => $Kmgdm3,
            ':Pesquisador' => $Pesquisador,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
session_start();
$_SESSION['sincronizar3'] = 'Arquivo 3 foi importado com sucesso.';
header("Location: sincronizar4.php?pesquisador=".$pesquisador);
exit;