<?php 
session_start();
require_once '../php/Conexion.php';
require_once '../php/Biblioteca.php';

$conexion = conectarse();
if(isset($_POST["nombre"]))
{
	$nombre = $_POST["nombre"];
	$direccion = $_POST["direccion"];
	$telefono = $_POST["telefono"];
	$descripcion = $_POST["descripcion"];
	$estado = $_POST["estado"];

	
	$rutaservidor="imgcatalogo"; //aqui es el nombre de la carpeta donde se guardará la imgen
	$rutatemporal=$_FILES['imagen']['tmp_name'];//imagen es el name del formulario
	$nombreimg=$_FILES['imagen']['name'];//recuperarmos nombre de imagen
	$rutadestino="../".$rutaservidor.'/'.$nombreimg;//concatenamos la ruta donde estara la imagen
	$rutareal = $rutaservidor.'/'.$nombreimg;
	move_uploaded_file($rutatemporal,$rutadestino); // se mueve la imagen 
	
				$sql1 = "INSERT INTO `catalogo1` (`foliocatalogo`, `nombrehotel`,`idEstado`) 
				                               VALUES (NULL, '$nombre','$estado');";
				$sql2 = "INSERT INTO `catalogo2` (`foliocatalogo`, `direccion`) 
				                               VALUES (NULL, '$direccion');";
				$sql3 = "INSERT INTO `catalogo3` (`foliocatalogo`, `telefono`) 
				                               VALUES (NULL, '$telefono');";
				$sql4 = "INSERT INTO `catalogo4` (`foliocatalogo`, `descripcion`, `imagen`) 
				                               VALUES (NULL, '$descripcion', '$rutareal');";

				
			
				if (consultaSQL($sql1,$conexion))
				{								
					echo '<script language="javascript">alert("El hotel se ha registrado correctamente");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
				if (consultaSQL($sql2,$conexion))
				{								
					echo '<script language="javascript">alert("El hotel se ha registrado correctamente");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
				if (consultaSQL($sql3,$conexion))
				{								
					echo '<script language="javascript">alert("El hotel se ha registrado correctamente");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
				if (consultaSQL($sql4,$conexion))
				{								
					echo '<script language="javascript">alert("El hotel se ha registrado correctamente");
					window.location.href="javascript:history.back(1)";
					</script>'; 

					echo $sql4;
				}
				else 
				{
					echo mysql_error();	
				}
				
}	
cerrar($conexion);
?>
