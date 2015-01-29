<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$value = mysql_real_escape_string($_POST['value']);
$query = mysql_query("SELECT  `u920472837_escuela`.`Distrito`.`Nombre` 
FROM  `u920472837_escuela`.`Distrito` 
WHERE  `u920472837_escuela`.`Distrito`.`ID_Departamento` = (
SELECT  `u920472837_escuela`.`Departamento`.`ID` 
FROM  `u920472837_escuela`.`Departamento` 
WHERE  `Departamento`.`Nombre` =  '$value'
)");

$n = mysql_num_rows ( $query );
$result = "";

for ($i = 0; $i < $n; $i++) {
	$name = mysql_result($query , $i , 0);
	if( $i == 0 )
		$result =  "$name";
	else
		$result = "$result,$name";
}

echo "$result";

?>

