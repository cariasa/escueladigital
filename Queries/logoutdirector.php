<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$value = mysql_real_escape_string($_POST['value']);

$query = mysql_query("
	UPDATE  `u920472837_escuela`.`SesionDirector` 
	SET  `Activa` =  '0' 
	WHERE  `SesionDirector`.`ID_Director` = ( SELECT  `SesionDirector`.`ID_Director` 
																		   FROM `u920472837_escuela`.`SesionDirector` 
																		   WHERE `SesionDirector`.`ID` = $value );");
$query = mysql_query("
	SELECT `SesionDirector`.`ID`
	FROM `u920472837_escuela`.`SesionDirector`
	WHERE  `Activa` = 1 AND `SesionDirector`.`ID_Director` = ( SELECT  `SesionDirector`.`ID_Director` 
																		                                FROM `u920472837_escuela`.`SesionDirector` 
																		                                WHERE `SesionDirector`.`ID` = $value );
");	

$n = mysql_num_rows ( $query );
if( $n != 0 )
	echo "NO";
else
	echo "SI";
?>