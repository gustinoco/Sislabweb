<?php
$connect=mysql_connect("localhost:3307","root","embrapa");
if (!$connect) {
die('Could not connect: ' . mysql_error());
}
$db_selected=mysql_select_db('sislabweb',$connect);
if (!$db_selected) {
die ('Can\’t use foo : ' . mysql_error());
}
?>