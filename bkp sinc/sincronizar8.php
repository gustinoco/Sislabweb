
<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha8 = "planilhas/$pesquisador/Planta/maquina1.xls";

function editar7($Id, $N, $P, $K, $Ca, $Mg, $S, $Cu, $B) {
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
    $P = $read7[1][$i][3];
    $K = $read7[1][$i][4];
    $Ca = $read7[1][$i][5];
    $Mg = $read7[1][$i][6];
    $S = $read7[1][$i][7];
    $Cu = $read7[1][$i][8];
    $Fe = $read7[1][$i][9];
    $Mn = $read7[1][$i][10];
    $Zn = $read7[1][$i][11];
    $B = $read7[1][$i][12];
    editar7($Id, number_format($N, 2, ",", ""), number_format($P, 2, ",", ""), 
            number_format($K, 2, ",", ""), number_format($Ca, 2, ",", ""), 
            number_format($Mg, 2, ",", ""), number_format($S, 2, ",", ""),
            number_format($Cu, 2, ",", ""), number_format($B, 2, ",", ""));
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
