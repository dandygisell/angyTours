<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
if(isset($_POST["concepto"]))
{
	$concepto = $_POST["concepto"];
	$FechaSalida = $_POST["FechaSalida"];
	$FechaRetorno = $_POST["FechaRetorno"];
	$totalVta = $_POST["total"];
	$descripcion = $_POST["descripcion"];
	$rutaservidor="imgvoucher"; //aqui es el nombre de la carpeta donde se guardara la imgen
	$rutatemporal=$_FILES['voucher']['tmp_name'];//imagen es el name del formulario
	$nombreimg=$_FILES['voucher']['name'];//recuperarmos nombre de imagen
	$rutadestino="../".$rutaservidor.'/'.$nombreimg;//concatenamos la ruta donde estara la imagen
	$rutareal = $rutaservidor.'/'.$nombreimg;
	move_uploaded_file($rutatemporal,$rutadestino); // se mueve la imagen 
	
				$sql = "INSERT INTO `voucher` (`folioVoucher`, `concepto`, `fechaSalida`, `fechaRetorno`, `total`, `descripcion`, `imagen`) 
				VALUES (NULL, '$concepto', '$FechaSalida', '$FechaRetorno', '$totalVta', '$descripcion', '$rutareal');";
			
				if (consultaSQL($sql,$conexion))
				{								
					echo '<script language="javascript">alert("El vaucher se ha almacenado correctamente.");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
}	
cerrar($conexion);
?>