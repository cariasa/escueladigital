<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$idalumno = mysql_real_escape_string($_POST['value']);

$query = mysql_query("
	DELETE FROM  `u920472837_escuela`.`Alumno` 
	WHERE `Alumno`.`ID` =  $idalumno;
");

	echo "SI";
?>