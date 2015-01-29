<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$value = mysql_real_escape_string($_POST['value']);

$query = mysql_query("
	UPDATE  `u920472837_escuela`.`SesionProfesor` 
	SET  `Activa` =  '0' 
	WHERE  `SesionProfesor`.`ID_Profesor` = ( SELECT  `SesionProfesor`.`ID_Profesor` 
																		   FROM `u920472837_escuela`.`SesionProfesor` 
																		   WHERE `SesionProfesor`.`ID` = $value );");
$query = mysql_query("
	SELECT `SesionProfesor`.`ID`
	FROM `u920472837_escuela`.`SesionProfesor`
	WHERE  `Activa` = 1 AND `SesionProfesor`.`ID_Profesor` = ( SELECT  `SesionProfesor`.`ID_Profesor` 
																		                                FROM `u920472837_escuela`.`SesionProfesor` 
																		                                WHERE `SesionProfesor`.`ID` = $value );
");	

$n = mysql_num_rows ( $query );
if( $n != 0 )
	echo "NO";
else
	echo "SI";
?>