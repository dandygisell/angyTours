<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':

	if (isset($_GET["Pendiente"])) {

		$sql= "SELECT FolioVta as Folio, cantidadTotal as Importe,FechaCompra as Fecha,`usuarios`.`nombre` as Vendedor,`cliente`.`nombre` as Cliente FROM venta LEFT JOIN usuarios ON (`venta`.`idUsuario` = `usuarios`.`idUsuario`) left join cliente on (`venta`.`idViajero`=`cliente`.`idViajero`)
		where EstatusP = 'Pendiente' ORDER BY FechaCompra DESC LIMIT 0, 30";
	} 

	if (isset($_GET["Cerrado"])) {

		$sql= "SELECT FolioVta as Folio, cantidadTotal as Importe,FechaCompra as Fecha,`usuarios`.`nombre` as Vendedor,`cliente`.`nombre` as Cliente FROM venta LEFT JOIN usuarios ON (`venta`.`idUsuario` = `usuarios`.`idUsuario`) left join cliente on (`venta`.`idViajero`=`cliente`.`idViajero`)
		where EstatusP = 'Cerrado' ORDER BY FechaCompra DESC LIMIT 0, 30";
	}
	if (isset($_GET["Pendiente_Grupo"])) {

		$sql= "SELECT FolioGrupo as Folio, CostoTotal as Importe, FechaCompra as Fecha,`usuarios`.`nombre` as Vendedor,`cliente`.`nombre` as Cliente FROM ventagrupo LEFT JOIN usuarios ON (`ventagrupo`.`IdUsuario` = `usuarios`.`idUsuario`) left join cliente on (`ventagrupo`.`idViajero`=`cliente`.`idViajero`)
		where EstatusP = 'Pendiente' ORDER BY FechaCompra DESC LIMIT 0, 30";
	}
	if (isset($_GET["Cerrado_Grupo"])) {

		$sql= "SELECT FolioGrupo as Folio, CostoTotal as Importe,FechaCompra as Fecha,`usuarios`.`nombre` as Vendedor,`cliente`.`nombre` as Cliente FROM ventagrupo LEFT JOIN usuarios ON (`ventagrupo`.`IdUsuario` = `usuarios`.`idUsuario`) left join cliente on (`ventagrupo`.`idViajero`=`cliente`.`idViajero`)
		where EstatusP = 'Cerrado' ORDER BY FechaCompra DESC LIMIT 0, 30";
	}
	if (isset($_GET["Egreso"])) {

		$sql= "SELECT 
		FolioPago as Folio,
		CantPago as Importe,
		FechaExpedicion as Fecha,
		`usuarios`.`Nombre` as Vendedor,
		`cliente`.`Nombre` as Cliente,
		`pagov`.`Tipo`,
		 neto
		FROM pagov
		LEFT JOIN venta ON (`pagov`.`FolioVenta` = `venta`.`FolioVta`) 
		LEFT JOIN usuarios ON (`venta`.`IdUsuario` = `usuarios`.`idUsuario`) 
		left join cliente on (`venta`.`idViajero`=`cliente`.`idViajero`)
		ORDER BY FechaCompra DESC LIMIT 0, 30";
	}
	
	
$result=mysql_query($sql);
				$validar=mysql_num_rows($result);

				if ($validar != 0) {

					while ($row=mysql_fetch_assoc($result)) {
					$data[]=$row;
						}
					echo json_encode($data);
				} else {

					$data[] = array("Folio"=>"",'Importe'=>"",'Fecha'=>"",'Vendedor'=>"",'Cliente'=>"No hay Ventas diponibles",'Accion'=>"");


					echo json_encode($data);
					
		}
	
		break;
	
	default:
		break;
}
cerrar($conexion);
 ?>