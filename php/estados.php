<?php 
require_once 'Conexion.php';

$conexion=conectarse();

sleep(3);

switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':

			if (isset($_GET["foliocatalogo"])) {
				$sql="SELECT * FROM catalogo1 WHERE idEstado=".$_GET["foliocatalogo"]."";
			} else {
				$sql="SELECT * FROM hotelestado ORDER BY estado ASC";
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