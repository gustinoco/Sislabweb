<?php

include_once 'conf/conexao.php';
include_once 'entidade/Solo.php';

require('reader.php');
$excel = new Spreadsheet_Excel_Reader();


$pesquisador = $_GET['pesquisador'];


$Planilha1 = "planilhas/$pesquisador/maquina1.xls";


$read1 = excel_read_file($Planilha1);


for ($i = 2; $i <= $read1[0]; $i++) {
    $Id = $read1[1][$i][1];
    $Cu = $read1[1][$i][2];
    $Fe = $read1[1][$i][3];
    $Mn = $read1[1][$i][4];
    $Zn = $read1[1][$i][5];
    $B = $read1[1][$i][6];




    editar1($Id, $Cu, $Fe, $Mn, $Zn, $B, $pesquisador);
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

function editar1($Id, $Cu, $Fe, $Mn, $Zn, $B, $Pesquisador) {
    $sql = 'UPDATE SOLO SET 
        Cu = :Cu ,Fe = :Fe, Mn = :Mn, Zn = :Zn, B = :B, Data_cadastro = :Data_cadastro, Pesquisador = :Pesquisador WHERE Id = :Id';
    try {
        $conn = getConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':Cu' => $Cu,
            ':Fe' => $Fe,
            ':Mn' => $Mn,
            ':Zn' => $Zn,
            ':B' => $B,
            ':Pesquisador' => $Pesquisador,
            ':Data_cadastro' => date("Y-m-d H:i:s"),
            ':Id' => (int) $Id
        ));
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

session_start();
$_SESSION['sincronizar1'] = 'Arquivo 1 foi importado com sucesso.';
header("Location: sincronizar2.php?pesquisador=" . $pesquisador);
exit;
