<?php
include 'dbconnect.php';
$idsesion = mysql_real_escape_string($_POST['value']);
$query = mysql_query("
	SELECT `SesionProfesor`.`ID_Profesor` 
	FROM `u920472837_escuela`.`SesionProfesor` 
	WHERE `SesionProfesor`.`ID` = $idsesion
");

$result = mysql_result($query , 0 ,  0 );
echo "$result";

?>