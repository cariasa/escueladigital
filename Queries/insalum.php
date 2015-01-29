<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$datos = mysql_real_escape_string($_POST['value']);
list( $idclase, $pnombre,  $snombre, $papellido, $sapellido ) = split('[,]', $datos);

$query = mysql_query("
	SELECT * 
	FROM `u920472837_escuela`.`Alumno`;
");
$n1 = mysql_num_rows ( $query );

$query = mysql_query("
	INSERT INTO  `u920472837_escuela`.`Alumno` ( `ID` , `P_Nombre` , `S_Nombre` , `P_Apellido` , `S_Apellido` , `ID_Clase` )
	VALUES ( NULL ,  '$pnombre',  '$snombre',  '$papellido',  '$sapellido',  $idclase );
");

$query = mysql_query("
	SELECT * 
	FROM `u920472837_escuela`.`Alumno`;
");
$n2 = mysql_num_rows ( $query );

if( $n1 == $n2 )
	echo "NO";
else
	echo "SI";
?>