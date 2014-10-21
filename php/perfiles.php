<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':

	if (isset($_GET["id"])) {

		$sql= "SELECT * FROM usuarios WHERE `IdUsuario` = ".$_GET["id"]."";		
	}
				$result=mysql_query($sql) or die(mysql_error());
				
					while ($row=mysql_fetch_assoc($result)) {
					$data[]=$row;
						}
					echo json_encode($data);	
				
				
				
					
	break;
	case 'POST':

	if (isset($_POST["nombre"])) {

		$sql = "UPDATE `usuarios` SET 
		
		`NombreIdUsuario`='".$_POST["usuario"]."',
		`Correo`='".$_POST["correo"]."',
		`Nombre`='".$_POST["nombre"]."',
		`Contrasena`='".$_POST["pass"]."',
		`Telefono`='".$_POST["telefono"]."' WHERE IdUsuario = '".$_POST["usr"]."'";
	}

	if (mysql_query($sql)) {

		echo "Datos agregados correctamente";
	}else 
	{
		mysql_error();
	}


	break;
	default:
		break;
}
cerrar($conexion);
 ?>