<?php
include 'dbconnect.php';

$datos = mysql_real_escape_string($_POST['value']);
$alumnos = split('[;]', $datos);

$query = mysql_query("
	SELECT `Clase`.`ID` 
	FROM  `u920472837_escuela`.`Clase` 
	WHERE `Clase`.`ID_Profesor` = $alumnos[0]  AND `Clase`.`Nombre` = '$alumnos[1] '
");	

$n = mysql_num_rows ( $query );
if( $n != 0 )
	echo "NOMBRE";
else
{
	$query = mysql_query("
		INSERT INTO  `u920472837_escuela`.`Clase` ( `ID` , `Nombre` , `ID_Profesor` )
		VALUES ( NULL ,  '$alumnos[1]', $alumnos[0] );
	");	

	$query = mysql_query("
		SELECT `Clase`.`ID` 
		FROM  `u920472837_escuela`.`Clase` 
		WHERE `Clase`.`ID_Profesor` = $alumnos[0]  AND `Clase`.`Nombre` = '$alumnos[1] ' 
	");	

	$idclase = mysql_result($query , 0 , 0);

	for( $i = 2; $i < count( $alumnos ) ; $i++ )
	{
		list($pnombre,$snombre,$papellido,$sapellido) = split( '[,]', $alumnos[$i] );
		
		$query = mysql_query("
			INSERT INTO  `u920472837_escuela`.`Alumno` ( `ID` , `P_Nombre` , `S_Nombre` , `P_Apellido` , `S_Apellido` , `ID_Clase` )
			VALUES ( NULL ,  '$pnombre',  '$snombre',  '$papellido',  '$sapellido', $idclase  );
		");	
	}

	/*Verificar si se insertaron los alumnos*/
	$query = mysql_query("
			SELECT `Alumno`.`ID` FROM `u920472837_escuela`.`Alumno` WHERE  `Alumno`.`ID_Clase` = $idclase;
	");	

	$n = mysql_num_rows ( $query );
	if( $n == 0 )
		echo "NO";
	else
		echo "SI";
}
	
?>






