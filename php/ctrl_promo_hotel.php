<?php 
require_once 'Conexion.php';

$conexion=conectarse();


switch ($_SERVER['REQUEST_METHOD']) {
	
	case 'GET':

	
  if (isset($_GET["promo"])) {  
                
                $sql = "SELECT foliopromo as Folio, nombre as Nombre, fechainiciop as FechaI, fechafinalp as FechaF, precio as Precio  FROM promociones";

                
                  }
                  if (isset($_GET["hotel"])) {
 
  
                $sql = "SELECT  foliocatalogo as Folio,nombrehotel as Nombre, `hotelestado`.`estado` as Estado FROM `catalogo1` LEFT JOIN hotelestado ON `catalogo1`.`idEstado` = `hotelestado`.`FolioEstado`";
                }
                             
                $result=mysql_query($sql,$conexion);
				$validar=mysql_num_rows($result);

				if ($validar != 0) {

					while ($row=mysql_fetch_assoc($result)) {
					$data[]=$row;
						}
					echo json_encode($data);
				} else {

					$data[] = array("Folio"=>"",'Nombre'=>"No hay datos registrados",'Accion'=>"");

					echo json_encode($data);
				}				
					
		break;
	
	default:
		break;
}
cerrar($conexion);
 ?>
