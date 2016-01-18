<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha6 = "planilhas/$pesquisador/Solo/maquina6.xls";


function editar6($Id, $Mo, $pesquisador) {
    $sql = 'UPDATE solo SET 
        Materia_organica = :Materia_organica , Data_cadastro = :Data_cadastro WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Materia_organica' => $Mo,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



$read6 = excel_read_file($Planilha6);
for ($i = 2; $i <= $read6[0]; $i++) {
    (int) $Id = $read6[1][$i][1];
    $Mo = $read6[1][$i][2];


    editar6($Id, number_format($Mo, 2, ",", ""), $pesquisador);
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


header("Location: sincronizar7.php?pesquisador=" . $pesquisador);
exit;