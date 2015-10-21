<?php

include_once 'conf/conexao.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();



$pesquisador = $_GET['pesquisador'];
$Planilha5 = "planilhas/$pesquisador/maquina5.xls";





$read5 = excel_read_file($Planilha5);
for ($i = 2; $i <= $read5[0]; $i++) {
    (int) $Id = $read5[1][$i][1];
    $Dicromato = $read5[1][$i][2];
    $Toc = $read5[1][$i][3];
    $Leitura1 = $read5[1][$i][4];
    $Temp1 = $read5[1][$i][5];
    $Leitura2 = $read5[1][$i][6];
    $Temp2 = $read5[1][$i][7];
    $Pmehl = $read5[1][$i][8];




    editar5($Id, $Dicromato, $Toc, $Leitura1, $Temp1, $Leitura2, $Temp2, $Pmehl, $pesquisador);
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

function editar5($Id, $Dicromato, $Toc, $Leitura1, $Temp1, $Leitura2, $Temp2, $Pmehl, $Pesquisador) {
    $sql = 'UPDATE SOLO SET 
        Dicromato = :Dicromato , Toc = :Toc, Leitura1 = :Leitura1 , Temp1 = :Temp1, Leitura2 = :Leitura2 , Temp2 = :Temp2, Pmehl = :Pmehl, Data_cadastro = :Data_cadastro, Pesquisador = :Pesquisador WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Dicromato' => $Dicromato,
            ':Toc' => $Toc,
            ':Leitura1' => $Leitura1,
            ':Temp1' => $Temp1,
            ':Leitura2' => $Leitura2,
            ':Temp2' => $Temp2,
            ':Pmehl' => $Pmehl,
            ':Pesquisador' => $Pesquisador,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
session_start();
$_SESSION['sincronizar5'] = 'Arquivo 5 foi importado com sucesso.';
header("Location: view/main.php?sincronizador=ok");
exit;
