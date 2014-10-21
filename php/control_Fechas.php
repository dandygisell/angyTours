<?php 
require_once 'Conexion.php';

$conexion=conectarse();

	$fecha = $_POST["fecha"];
	$fechaFinal = $_POST["fechaFinal"];

switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'POST':



	if (isset($_POST["calcular"])) {


		$validar = "SELECT * FROM venta WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
		$re = mysql_query($validar);
		$r2 = mysql_num_rows($re);
		if ($r2 != 0){

			$sql = "SELECT SUM(CantidadTotal) AS Ventas FROM venta WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
		} else {


			$data[] = array('Ventas' =>"No hay datos para la cunsulta" , );
			echo json_encode($data);

			break;
		}
	}	

	if (isset($_POST["calcularG"])) {

		$validar = "SELECT * FROM ventagrupo WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
		$re = mysql_query($validar);
		$r2 = mysql_num_rows($re);
		if ($r2 != 0){

		$sql = "SELECT SUM(CostoTotal) AS Ventas FROM ventagrupo WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
			
		} else {

			$data[] = array('Ventas' =>"No hay datos para la cunsulta" , );
			echo json_encode($data);
			break;
			
		}

		
	}
	if (isset($_POST["calcularE"])) {

		$validar = "SELECT * FROM pagov WHERE `FechaExpedicion` BETWEEN '$fecha' AND '$fechaFinal'";
		$re = mysql_query($validar);
		$r2 = mysql_num_rows($re);
		if ($r2 != 0){

	$sql = "SELECT SUM(neto) AS Ventas FROM pagov WHERE `FechaExpedicion` BETWEEN '$fecha' AND '$fechaFinal'";
			
		} else {

			$data[] = array('Ventas' =>"No hay datos para la cunsulta" , );
			echo json_encode($data);
			break;
			
		}
	}

				$result=mysql_query($sql);


				

				while ($row=mysql_fetch_assoc($result)) {


					$data[]= $row;

					echo json_encode($data);

					
				}

				
		break;
	
	default:
		break;
}
cerrar($conexion);
 ?>