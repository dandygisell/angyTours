<?php
require_once 'Conexion.php';

$conexion = conectarse();

switch ($_SERVER['REQUEST_METHOD'])
{
	case 'GET':

	$sql = "SELECT folioVoucher as Folio, concepto as Concepto, fechaSalida as FechaSalida, fechaRetorno as FechaRetorno,
	total as Monto, descripcion as Descripcion, imagen as Imagen  FROM `voucher`";


				$result=mysql_query($sql,$conexion);
				$validar=mysql_num_rows($result);

				if ($validar != 0) {

					while ($row=mysql_fetch_assoc($result)) {
					$data[]=$row;
						}
					echo json_encode($data);
				
				} else {

					$data[] = array("Folio"=>"",'Importe'=>"",'Fecha'=>"",'Estatus'=>"",'Descripcion'=>"No existen Vouchers",'Accion'=>"");


					
					echo json_encode($data);
					
				}	

		break;
}
cerrar($conexion);
?>