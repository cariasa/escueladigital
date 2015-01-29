<?php
mysql_connect("mysql.freehostingnoads.net" , "u920472837_admin" , "kouta07anjira17");
$value = mysql_real_escape_string($_POST['value']);

list( $emaildir, $celular, $pass,  $numid, $pnombre,
      $snombre, $papellido, $sapellido , $idsesion) = split('[,]', $value);
$query = mysql_query("
	SELECT `u920472837_escuela`.`Profesor`.`ID`
	FROM `u920472837_escuela`.`Profesor` 
	WHERE `u920472837_escuela`.`Profesor`.`E_mail` = '$emaildir'
");	

$n = mysql_num_rows ( $query );
if( $n != 0 )
{
	echo "CORREO"; //usuario ya existe
}
else
{ 	  

	$query = mysql_query("
		SELECT `u920472837_escuela`.`Director`.`ID` 
		FROM `u920472837_escuela`.`Director` 
		WHERE `u920472837_escuela`.`Director`.`E_mail_Director` = '$emaildir'
	");	
	$n = mysql_num_rows ( $query );
	if( $n != 0 )
	{
		echo "CORREO"; //usuario ya existe
	}
	else
	{
		$query = mysql_query("
			INSERT INTO `u920472837_escuela`.`Profesor` 
				( `ID` ,`Password` ,`Numero_Id` ,`P_Nombre` ,`S_Nombre` ,`P_Apellido` ,`S_Apellido` ,
				  `E_mail` ,`Celular` ,`ID_Director` , `Valido` )
			VALUES ( NULL ,  '$pass',  '$numid',  '$pnombre',  '$snombre',  '$papellido',  '$sapellido',  
					 '$emaildir',  '$celular',  ( SELECT  `ID_Director` 
												  FROM  `u920472837_escuela`.`SesionDirector` 
												  WHERE  `ID` = $idsesion AND  `Activa` =1 ) , 0);
		");
		$query = mysql_query("
			SELECT `u920472837_escuela`.`Profesor`.`ID`
			FROM `u920472837_escuela`.`Profesor` 
			WHERE `u920472837_escuela`.`Profesor`.`E_mail` = '$emaildir'
		");	
		$n = mysql_num_rows ( $query );
		if( $n != 0 )
		{
			/*Enviar el correo al profesor*/
			$id = mysql_result($query , 0 , 0);
			$subject = "Escuela Digital de Honduras";
			$body = "¡Bienvenido a Escuela Digital!\n Su correo electrónico se ha registrado al sistema, para confirmar su suscripción porfavor ingrese al siguiente link: \n\n   http://kotarosproject.t15.org/cp.html?id=$id \n\n Si usted no se ha registrado a este sistema porfavor cancele la suscripción ingresando al siguiente link: \n\n http://kotarosproject.t15.org/np.html?id=$id";
			mail($emaildir, $subject, $body); 
			echo "SI"; 
		}
		else
			echo "NO";//error de datos
	}
}
?>









