<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$idalumno = mysql_real_escape_string($_POST['value']);

$query = mysql_query("
	UPDATE  `u920472837_escuela`.`Profesor` 
	SET `Profesor`.`Valido` = 0
    WHERE `Profesor`.`ID` = $idalumno;
");

	echo "SI";
?>