<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");

$query = mysql_query("SELECT  `Nombre` FROM  `u920472837_escuela`.`Departamento` ");

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