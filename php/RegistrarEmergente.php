<?php 
require_once 'Conexion.php';
require_once 'Biblioteca.php';

$conexion = conectarse();

if(isset($_POST["usuario"]))
{
	$usuario =$_POST["usuario"];
	$nombre =$_POST["nombre"];
	$pass=$_POST["pass"];
	$telefono=$_POST["telefono"];
	$correo=$_POST["correo"];
	$direccion=$_POST["direccion"];

	$qValidar = mysql_query("SELECT * FROM Cliente WHERE NombreIDViajero = '$usuario' or Correo = '$correo'" ,$conexion);

	@$resultado = mysql_num_rows($qValidar);

	
	if ($resultado!=0)
	{

		echo '<script language="javascript">alert("El usuario o correo electronico ya se encuentra registrado");
		window.window.history.go(-1);
		</script>'; 
		
	} else {

				$sql = "INSERT INTO `cliente`(`idViajero`, `Direccion`, `NombreIDViajero`, `Correo`, `Contrasena`, `Telefono`, `Nombre`, `FechaA`) VALUES (NULL, '$direccion', '$usuario','$correo','$pass','$telefono','$nombre',NOW())";
	
							
				if (consultaSQL($sql,$conexion))
				{
					
					echo '<script language="javascript">alert("El cliente se ha registrado satisfactoriamente");
					window.window.history.go(-2);
					</script>'; 
				}
				else 
				{
					header("AgregarAgente.php");		
				}
			}
}	

cerrar($conexion);

?>