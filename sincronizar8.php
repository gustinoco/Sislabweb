
<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha8 = "planilhas/$pesquisador/Planta/maquina2.xls";

function editar8($Id, $P, $K, $S) {
    $sql = 'UPDATE planta SET 
        P = :P, 
        K = :K,
        S = :S, 
        Data_cadastro = :Data_cadastro 
        WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':P' => $P,
            ':K' => $K,
            ':S' => $S,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$read8 = excel_read_file($Planilha8);

for ($i = 2; $i <= $read8[0]; $i++) {
    (int) $Id = $read8[1][$i][1];
    $P = $read8[1][$i][2];
    $K = $read8[1][$i][3];
    $S = $read8[1][$i][4];
    
    editar8($Id, number_format($P, 2, ",", ""), number_format($K, 2, ",", ""), 
            number_format($S, 2, ",", ""));
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



header("Location: sincronizar9.php?pesquisador=" . $pesquisador);
exit;

