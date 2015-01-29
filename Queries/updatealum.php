<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$datos = mysql_real_escape_string($_POST['value']);
list( $idalumno, $pnombre,  $snombre, $papellido, $sapellido ) = split('[,]', $datos);

$query = mysql_query("
	UPDATE  `u920472837_escuela`.`Alumno` 
	SET  `P_Nombre` = '$pnombre',  
	          `S_Nombre` = '$snombre' ,
			  `P_Apellido` = '$papellido', 
			  `S_Apellido` = '$sapellido' 
	WHERE `Alumno`.`ID` =  $idalumno;
");

	echo "SI";
?>