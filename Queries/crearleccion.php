<?php
include 'dbconnect.php';

$datos = mysql_real_escape_string($_POST['value']);
$alumnos = split('[;]', $datos);

$query = mysql_query("
		SELECT  `ID` 
		FROM  `u920472837_escuela`.`Leccion` 
		WHERE  `Leccion` .`NLeccion` = $alumnos[2]  AND `ID_Unidad` = ( SELECT  `ID` 
																												FROM  `u920472837_escuela`.`Unidad` 
																												WHERE  `NUnidad` = $alumnos[3]  )
	");
$idleccion = mysql_result($query , 0 , 0);

for( $i = 4; $i < count( $alumnos ) ; $i++ )
{
	list($pnombre,$snombre,$papellido,$sapellido,$codigo) = split( '[,]', $alumnos[$i] );
	$query = mysql_query("
		INSERT INTO  `u920472837_escuela`.`Prueba` ( `ID` , `Codigo` , `Fecha` , `Penalizacion` , `Puntuacion` , `Correctas` , `Incorrectas` , `Ayudas` , `Valido` , `ID_Alumno` , `ID_Leccion` )
		VALUES ( NULL ,  '$codigo',  curDate() , $alumnos[0]  ,  0 ,  0 ,  0 ,  0 ,  1 ,  ( SELECT  `ID` 
																																			  FROM  `u920472837_escuela`.`Alumno` 
																																			  WHERE  `P_Nombre` =  '$pnombre' AND  
																																			                   `S_Nombre` =  '$snombre' AND  
																																							   `P_Apellido` =  '$papellido' AND  
																																							   `S_Apellido` =  '$sapellido' AND  
																																							   `ID_Clase` = $alumnos[1] 
		) ,  $idleccion );
	");	
}

echo "SI";
	
?>






