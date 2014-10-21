<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':
	
		$sql = "SELECT * FROM promociones";

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