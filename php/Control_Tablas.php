<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'POST':

	if (isset($_POST["Abono"])) {

		$sql= "SELECT FolioVta as Folio, CantidadTotal as Importe,FechaCompra as Fecha, Estatus as Estatus,Saldo as Saldo FROM venta WHERE idViajero = '".$_POST["idViajero"]."' AND `Estatus`='Abierta' ";
	} 
	if (isset($_POST["AbonoGrupo"])) {

		$sql= "SELECT FolioGrupo as Folio, CostoTotal as Importe,FechaCompra as Fecha, Estatus as Estatus,Saldo as Saldo FROM ventagrupo WHERE idViajero = '".$_POST["idViajero"]."' AND `Estatus`='Abierta'";		
	} 
	if (isset($_POST["addCupon"])) {

		$sql= "SELECT FolioGrupo as Folio, CostoTotal as Importe,FechaCompra as Fecha, Estatus as Estatus,Saldo as Saldo FROM ventagrupo WHERE idViajero = '".$_POST["idViajero"]."' AND `Estatus`='Cerrada'";	
	} 
	if (isset($_POST["busqueda_cupon"])) {

		$sql= "SELECT FolioVta as Folio, CantidadTotal as Importe,FechaCompra as Fecha, Estatus as Estatus,Saldo as Saldo FROM venta WHERE idViajero = '".$_POST["idViajero"]."' AND `Estatus`='Cerrada'";		
	}


				$result=mysql_query($sql) or die(mysql_error());
				$validar=mysql_num_rows($result);

				if ($validar != 0) {

					while ($row=mysql_fetch_assoc($result)) {
					$data[]=$row;
						}
					echo json_encode($data);
				
				} else {

					$data[] = array("Folio"=>"",'Importe'=>"",'Fecha'=>"",'Estatus'=>"",'Saldo'=>"No tiene Ventas diponibles",'Accion'=>"");


					
					echo json_encode($data);
					
				}			
					
		break;
	
	default:
		break;
}
cerrar($conexion);
 ?>