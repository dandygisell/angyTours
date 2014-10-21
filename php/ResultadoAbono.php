<?php
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$IdUsuario =$_SESSION["id"];

if(isset($_POST["cliente"]))
{
	$cliente =$_POST["cliente"];
	$idViajero =$_POST["id"];
	
   $sql = "SELECT * FROM `venta` WHERE idViajero = '$idViajero'";
$resultado= @mysql_query($sql) or die(mysql_error());


		if (consultaSQL($sql,$conexion))
		{			
			$tabla = consultaArray ($sql,$conexion);
			echo "Historial de pagos";
			echo recorrerTabla($tabla);	

		}
		else 
		{
			header("abonar.php");		
		}


}	
cerrar($conexion);

?>