<?php 
require_once 'Conexion.php';

$conexion=conectarse();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'POST':

	if (isset($_POST["confirmadoPor"])) {


		$sql = "UPDATE `ventagrupo` SET 
		`claveConfirmacion`='".$_POST["claveConfirmacion"]."',
		`confirmadoPor`='".$_POST["confirmadoPor"]."' 
		WHERE FolioGrupo = '".$_POST["FolioGrupo"]."'";

		
		$resultado = mysql_query($sql) or die(mysql_error());	





		
	} else {

		$menor1 = $_POST["Menor1"];
		$menor2 = $_POST["Menor2"];

		$nombre = $menor1." / ".$menor2;

	$sql = "INSERT INTO `cuponesgrupo` (`FolioCupon`, `FolioGrupoC`, `NumeroHab`, `NombreTitular`, `NombreA`, `Menores`, `Observaciones`, `TipoHab`,`cantAdultos`, `catMenores`, `EdadesMenores`) 
	VALUES (NULL,'".$_POST["FolioGrupo"]."','".$_POST["numeroH"]."','".$_POST["NombreT"]."','".$_POST["NombreA"]."','$nombre','".$_POST["Obs"]."','".$_POST["TipoHab"]."','".$_POST["cantAdultos"]."','".$_POST["cantMenores"]."','".$_POST["EdadesMenores"]."')";
	$resultado = mysql_query($sql) or die(mysql_error());
	}
	
	break;

	
	case 'GET':

		if (isset($_GET["eliminar"])) {


			$sql = "DELETE FROM cuponesgrupo WHERE FolioGrupoC = '".$_GET["FolioGrupo"]."' AND NumeroHab = '".$_GET["Numero"]."'";

			$query = mysql_query($sql);

			
			# code...
		}
		
	

		$sql = "SELECT NumeroHab as Numero,
		 NombreTitular as NombreTitular,
		 NombreA as Acompa,
		 Menores as Menores,
		 Observaciones as Observaciones,
		 TipoHab as Tipo
		 FROM `cuponesgrupo` WHERE FolioGrupoC = ".(int)$_GET["FolioGrupo"]."";	
		

		 $validar = mysql_query($sql) or die(mysql_error());
	



				$result=mysql_query($sql);
				

					while ($row=mysql_fetch_assoc($result)) {
					$data[]=$row;
						}
					echo json_encode($data);

					


					
		break;
	
	default:
		# code...
		break;
}
cerrar($conexion);
 ?>