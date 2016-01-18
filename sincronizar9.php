<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha9 = "planilhas/$pesquisador/Planta/maquina3.xls";

function editar9($Id, $Ca, $Mg, $Cu, $Fe, $Mn, $Zn) {
    $sql = 'UPDATE planta SET 
        Ca = :Ca, 
        Mg = :Mg,
        Cu = :Cu,
        Fe = :Fe,
        Mn = :Mn,
        Zn = :Zn,              
        Data_cadastro = :Data_cadastro 
        WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Ca' => $Ca,
            ':Mg' => $Mg,
            ':Cu' => $Cu,
            ':Fe' => $Fe,
            ':Mn' => $Mn,
            ':Zn' => $Zn,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$read7 = excel_read_file($Planilha9);

for ($i = 2; $i <= $read7[0]; $i++) {
    (int) $Id = $read7[1][$i][1];
    $Ca = $read9[1][$i][2];
    $Mg = $read9[1][$i][3];
    $Cu = $read9[1][$i][4];
    $Fe = $read9[1][$i][5];
    $Mn = $read9[1][$i][6];
    $Zn= $read9[1][$i][7];
   
   
    editar9($Id, number_format($Ca, 2, ",", ""), number_format($Mg, 2, ",", ""), 
            number_format($Cu, 2, ",", ""), number_format($Fe, 2, ",", ""), 
            number_format($Mn, 2, ",", ""), number_format($Zn, 2, ",", ""));
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


header("Location: sincronizar10.php?pesquisador=" . $pesquisador);
exit;
