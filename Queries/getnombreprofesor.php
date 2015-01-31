<?php
include 'dbconnect.php';

$value = mysql_real_escape_string($_POST['value']);

$query = mysql_query("SELECT  `u920472837_escuela`.`Profesor`.`P_Nombre` ,  `u920472837_escuela`.`Profesor`.`P_Apellido` 
FROM  `u920472837_escuela`.`SesionProfesor` ,  `u920472837_escuela`.`Profesor` 
WHERE  `u920472837_escuela`.`SesionProfesor`.`ID_Profesor` =  `u920472837_escuela`.`Profesor`.`ID` 
AND  `u920472837_escuela`.`SesionProfesor`.`Activa` =1
AND  `u920472837_escuela`.`SesionProfesor`.`ID` = $value");
$n = mysql_num_rows ( $query );
if( $n == 0 )
	echo "NO";
else
{
	$name = mysql_result($query , 0 , 0);
	$lastname = mysql_result($query , 0 , 1);
	echo "$name $lastname";
}

?>