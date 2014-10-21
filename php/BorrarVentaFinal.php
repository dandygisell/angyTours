<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$cobrador = $_SESSION['id'];
$log = $_SESSION['tipo'];
if($_SESSION['logged'] == 'yes')
{

	$FolioVta = $_GET["folio"];
	$tipo = "Individual";




	$sql = "DELETE FROM `venta` WHERE FolioVta = '$FolioVta'";

	if (consultaSQL($sql,$conexion)) {

		$sql = "DELETE FROM `abono` WHERE FolioVta = '$FolioVta'";

		if (consultaSQL($sql,$conexion)) {

			$sql = "DELETE FROM `pagov` WHERE ((FolioVenta = '$FolioVta') and (Tipo = '$tipo'))";

			if (consultaSQL($sql,$conexion)) {

				echo '<script language="javascript">alert("La venta se ha borrado");
						window.history.go(-2);
						</script>'; 

			} else {
						echo mysql_error();
					}

					} else {
						echo mysql_error();

					}
	} else {
		echo mysql_error();

	}
	



	cerrar($conexion);
 
 
 }else{
	
	echo '<script language="javascript">alert("No se ha iniciado ninguna sesion");
		window.location.href="../index.html";
		</script>'; 
}
 ?>