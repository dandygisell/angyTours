<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':

	$foliocatalogo = $_GET["foliocatalogo"];

			
			
	$sql = "SELECT `catalogo1`.`nombrehotel`, `catalogo4`.`descripcion`, `catalogo4`.`imagen` FROM `catalogo4` INNER JOIN `catalogo1` WHERE ((`catalogo1`.`foliocatalogo` = '$foliocatalogo') AND (`catalogo4`.`foliocatalogo` = '$foliocatalogo'))";
  
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