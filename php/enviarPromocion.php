<?php 
session_start();
require_once '../php/Conexion.php';
require_once '../php/Biblioteca.php';

$conexion = conectarse();
if(isset($_POST["nombre"]))
{
	$nombre = $_POST["nombre"];
	$fechainiciop = $_POST["fechainiciop"];
	$fechafinalp = $_POST["fechafinalp"];
	$precio = $_POST["precio"];
	$descripcion = $_POST["descripcion"];
	$btnpaypal = $_POST["btnpaypal"];
	$rutaservidor="imgpromo"; //aqui es el nombre de la carpeta donde se guardara la imgen
	$rutatemporal=$_FILES['imagen']['tmp_name'];//imagen es el name del formulario
	$nombreimg=$_FILES['imagen']['name'];//recuperarmos nombre de imagen
	$rutadestino="../".$rutaservidor.'/'.$nombreimg;//concatenamos la ruta donde estara la imagen
	$rutareal = $rutaservidor.'/'.$nombreimg;
	move_uploaded_file($rutatemporal,$rutadestino); // se mueve la imagen 
	
				$sql = "INSERT INTO `promociones` (`foliopromo`, `nombre`, `fechainiciop`, `fechafinalp`, `precio`, `descripcion`, `imagen`,`btnpaypal`) 
				       VALUES (NULL, '$nombre', '$fechainiciop', '$fechafinalp', '$precio', '$descripcion', '$rutareal','$btnpaypal');";
			
				if (consultaSQL($sql,$conexion))
				{								
					echo utf8_decode('<script language="javascript">alert("La promoción de a registrado correctamente");
					window.location.href="javascript:history.back(1)";
					</script>'); 
				}
				else 
				{
					echo mysql_error();	
				}
}	
cerrar($conexion);
?>

	


