<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");

$id = mysql_real_escape_string($_POST['value']);
$query = mysql_query("SELECT * FROM  `u920472837_escuela`.`Profesor` WHERE  `Profesor`.`ID` = $id AND `Profesor`.`Valido` = 0 ");
$n = mysql_num_rows ( $query );
if( $n == 0 )
	echo "NO";
else
{
	$query = mysql_query("
		DELETE FROM  `u920472837_escuela`.`Profesor` WHERE  `Profesor`.`ID` = $id AND `Profesor`.`Valido` = 0;
	");	

	$query = mysql_query("SELECT * FROM  `u920472837_escuela`.`Profesor` WHERE  `Profesor`.`ID` = $id ");
	$n = mysql_num_rows ( $query );
	if( $n != 0 )
		echo "NO";
	else
		echo "SI";
}
?>




