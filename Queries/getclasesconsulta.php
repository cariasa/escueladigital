<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$idprofesor = mysql_real_escape_string($_POST['value']);
$query = mysql_query("
	SELECT  `ID` ,  `Nombre`  
	FROM  `u920472837_escuela`.`Clase` 
	WHERE  `ID_Profesor` =  $idprofesor;
");
$n = mysql_num_rows ( $query );
if( $n == 0 )
	echo "NO";
else
{
	$result = "";

	for ($i = 0; $i < $n; $i++) 
	{
		if( $i != 0 )
			$result = "$result;"; 
		for ($j = 0; $j < 2; $j++) 
		{
			$name = mysql_result($query , $i , $j);	
			if( $j != 0 )
				$result = "$result,"; 
			$result = "$result$name"; 
		}	
	}

	echo "$result";
}
?>