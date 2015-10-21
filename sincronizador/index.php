<?php
require("reader.php");
require("connection.php");
$excel = new Spreadsheet_Excel_Reader();

function excel_read_file($name)
{
//$name=$name."xls";
$name='./uploaded_files/'.$name;
GLOBAL $excel;
$excel->read($name);
$x=1;

while($x<=$excel->sheets[0]['numRows']) {
// echo "\t<tr>\n";
/* if($x==3)
{
$x+=2;
} */
$y=1;
while($y<=$excel->sheets[0]['numCols']) {
$cell[$x][$y] = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';

$y++;
}
$x++;
}
$arr=array($x,$cell);
return ($arr);

}

$names="register.xls";
$convertt=excel_read_file($names);
?>