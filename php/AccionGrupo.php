<?php
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$log = $_SESSION["tipo"];
//Insertar

if(isset($_POST["cliente"]))
{
	$cliente =$_POST["cliente"];
	$NombreGrupo =$_POST["NombreGrupo"];
	$total =$_POST["total"];
	$importe =$_POST["importe"];
	$descripcion =$_POST["descripcion"];
    $usuario =$_SESSION["user"];
    $estatus = "Abierta";
    $estatusP = "Pendiente";
    $fechaInn = $_POST["FechaInn"];
    $fechaOut = $_POST["FechaOut"];
    $Operadora = $_POST["opm"];
    $IdUsuario =$_SESSION["id"];
    $idHotel = $_POST["idHotel"];
    $idViajero =$_POST["idViajero"];

$qValidar = mysql_query("SELECT * FROM cliente WHERE Nombre = '$cliente'");

	$resultado = mysql_num_rows($qValidar);
	?>

	<script>
	var log = "<?php echo $log ?>";
	</script>
	<?php	
	if ($resultado==0)
	{

		echo '<script language="javascript">
		alert("El usuario no se encuentra registrado");		
		window.location.href="../Usuarios/"+log+"/DashBoard/DRegistrar.php";
		</script>'; 
		
	} else {
   

		$sql = "INSERT INTO `ventagrupo`(`FolioGrupo`, `idViajero`,  `NombreGrupo`,`FechaIn`, `FechaOut`, `Descripcion`,`CantLetras`,`CostoTotal`,`Saldo`,`FechaCompra`, `idUsuario`,`IdHotel`,`OperadoraMay`,`Estatus`,`EstatusP`) 
		VALUES (NULL,'$idViajero','$NombreGrupo','$fechaInn','$fechaOut','$descripcion','$importe','$total','$total',NOW(),'$IdUsuario','$idHotel','$Operadora','$estatus','$estatusP')";



		        

		if (consultaSQL($sql,$conexion))
		{

		$rs = mysql_query("SELECT @@identity AS FolioGrupo");
					if ($row = mysql_fetch_row($rs)) {
					$id = trim($row[0]);
					$_SESSION["FolioGrupo"] = $id;
				}
			

			echo '<script language="javascript">alert("El grupo se ha creado satisfactoriamente");
				window.location.href="ReciboNuevaGrupo.php";
					</script>'; 
		}
		else 
		{
			echo '<script language="javascript">alert("correctamente");
				window.location.href="ReciboNuevaVenta.php";
					</script>'; 
		}
	}	
}
cerrar($conexion);

?>