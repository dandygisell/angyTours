<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':

	if (isset($_GET["Pendiente"])) {

		$sql = "SELECT * FROM Venta WHERE EstatusP = 'Pendiente'";
	} 
	if (isset($_GET["Cerrado"])) {

		$sql = "SELECT * FROM Venta WHERE EstatusP = 'Cerrado'";
	} 
	if (isset($_GET["Ingreso"])) {

		$sql = "SELECT * FROM Venta,ventagrupo";
	} 
	if (isset($_GET["Egreso"])) {

		$sql = "SELECT * FROM pagov";
	} 	

				$result=mysql_query($sql);

				while ($row=mysql_fetch_assoc($result)) {

					$data[]=$row;
					
				}
				echo json_encode($data);

				
					
		break;
	
	default:
		break;
}
cerrar($conexion);
 ?>