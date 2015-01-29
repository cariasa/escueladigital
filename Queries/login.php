<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");

$value = mysql_real_escape_string($_POST['value']);

list($correo,  $password ) = split('[,]', $value);
$query = mysql_query(
	"SELECT  `ID` FROM  `u920472837_escuela`.`Director` 
    WHERE  `E_mail_Director` = '$correo' AND  `Password` =  '$password' AND `Valido` = 1"
);

$n = mysql_num_rows ( $query );

if( $n == 0 )
{
	$query = mysql_query("
		SELECT `ID` FROM  `u920472837_escuela`.`Profesor`
		WHERE  `Password` =  '$password' AND  `E_mail` =  '$correo' AND `Valido` = 1 "
	);
	$n = mysql_num_rows ( $query );
	if( $n == 0 )
		echo "NO";
	else
	{
		$query = mysql_query("
			SELECT `u920472837_escuela`.`SesionProfesor`.`ID` 
			FROM  `u920472837_escuela`.`SesionProfesor` 
			WHERE  `Activa` = 1 AND `ID_Profesor` = ( SELECT `u920472837_escuela`.`Profesor`.`ID` 
																					FROM `u920472837_escuela`.`Profesor` 
								                                                    WHERE  `E_mail` = '$correo' AND  `Password` =  '$password' )");
		$n = mysql_num_rows ( $query );
		if( $n == 0 )
		{
			$query = mysql_query("
				INSERT INTO  `u920472837_escuela`.`SesionProfesor` ( `ID` , `ID_Profesor` , `Activa` ,`Fecha` ) 
				VALUES ( NULL ,  ( SELECT  `ID`
												FROM  `u920472837_escuela`.`Profesor` 
												WHERE  `E_mail` = '$correo' 
							AND  `Password` =  '$password'),  '1',  curDate() );");
			$query = mysql_query("
				SELECT `u920472837_escuela`.`SesionProfesor`.`ID` 
				FROM  `u920472837_escuela`.`SesionProfesor` 
				WHERE  `Activa` = 1 AND `ID_Profesor` = ( SELECT `u920472837_escuela`.`Profesor`.`ID` 
																						FROM `u920472837_escuela`.`Profesor` 
																						WHERE  `E_mail` = '$correo' AND  `Password` =  '$password' )");
			$codigo = mysql_result($query , 0 , 0);
			echo "RROFESOR$codigo";
		}
		else
		{
			$codigo = mysql_result($query , 0 , 0);
			echo "RROFESOR$codigo";
		}
	}
}
else
{
	$query = mysql_query("
		SELECT `u920472837_escuela`.`SesionDirector`.`ID` 
		FROM  `u920472837_escuela`.`SesionDirector` 
		WHERE  `Activa` = 1 AND `ID_Director` = ( SELECT `u920472837_escuela`.`Director`.`ID` 
		                                                                        FROM `u920472837_escuela`.`Director` 
																				WHERE  `E_mail_Director` = '$correo' AND  `Password` =  '$password' )");
	$n = mysql_num_rows ( $query );
	if( $n == 0 )
	{								
		$query = mysql_query("
			INSERT INTO  `u920472837_escuela`.`SesionDirector` ( `ID` , `ID_Director` , `Activa` ,`Fecha` ) 
			VALUES ( NULL ,  ( SELECT  `ID` 
											FROM  `u920472837_escuela`.`Director` 
											WHERE  `E_mail_Director` = '$correo'  AND  `Password` =  '$password'),  '1', curDate() );");
		$query = mysql_query("
			SELECT `u920472837_escuela`.`SesionDirector`.`ID` 
			FROM  `u920472837_escuela`.`SesionDirector` 
			WHERE  `Activa` = 1 AND `ID_Director` = ( SELECT `u920472837_escuela`.`Director`.`ID` 
																					FROM `u920472837_escuela`.`Director` 
																					WHERE  `E_mail_Director` = '$correo' AND  `Password` =  '$password' )");
		$codigo = mysql_result($query , 0 , 0);
		echo "DIRECTOR$codigo";
	}
	else
	{
		$codigo = mysql_result($query , 0 , 0);
		echo "DIRECTOR$codigo";
	}
}

?>




