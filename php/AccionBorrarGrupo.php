<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
// $FolioGrupo = $_SESSION["auxFolioGrupo"];
$cobrador = $_SESSION['id'];
$log = $_SESSION['tipo'];
if($_SESSION['logged'] == 'yes')
{
	?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Abono Grupo</title>

<link rel="stylesheet" href="../css/bordesT.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
	
<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />

</head>
	
	<?php 

	$FolioVta = $_GET["folio"];

	$sql ="SELECT * FROM ventagrupo WHERE FolioGrupo = '$FolioVta'";
	$resultado = mysql_query($sql) or die (mysql_error());
	while ($datos = @mysql_fetch_assoc($resultado) ){




								$FolioVta = $datos['FolioGrupo'];
								$idViajero = $datos['idViajero'];
								$IdUsuario = $datos['IdUsuario'];
								$Descripcion = $datos['Descripcion'];
								$CantidadTotal = $datos['CostoTotal'];
								// $CantidadVariable = $datos['CantidadVariable'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaViaje = $datos['FechaIn'];
								$FechaCompra = $datos['FechaCompra'];
								$estatus = $datos['Estatus'];
							}
	$sql ="SELECT Nombre FROM cliente WHERE idViajero = '$idViajero'";
	$resultado = mysql_query($sql) or die (mysql_error());
	while ($datos = @mysql_fetch_assoc($resultado) ){

								$Nombre = $datos['Nombre'];
								
							}




 ?>
 <body>

 <input type="hidden" id="log" value="<?php echo $log; ?>">
 <input type="hidden" id="FolioVta" value="<?php echo $FolioVta; ?>">

<div class="alert alert-danger">
	<div id="borrarDatos">
		<h2>¿Esta seguro que desea borar la venta?</h2><br>

		 <label for="">Cliente :</label> <?php echo $Nombre ?> <br>
		 <label for="">Descripcion :</label> <?php echo $Descripcion  ?> <br>
		 <label for="">Cantidad Total:</label> <?php echo $CantidadTotal ?><br>
		 <label for="">Fecha Viaje :</label> <?php echo $FechaViaje ?><br>
		 <label for="">Estatus :</label> <?php echo $estatus ?><br>
		<label for="">Compra Realizada el</label> <?php echo $FechaCompra ?><br>
		<div class="derecha">
			<button id="btn_regresar" class="btn btn-warning">No</button>
			<button id="btn_borrar" class="btn btn-danger">Si</button>
		</div>
	</div>
</div>



	<script src="../js/jquery-2.0.2.min.js"></script>
	<script src="../js/kendo.web.min.js"></script>
	<script src="../js/appPrecio.js"></script>
	<script>

	$(document).ready(function() {


		var a = $("#log").val();

		$("#btn_regresar").click(function(event) {

			$(location).attr('href','../Usuarios/'+a+'/DashBoard/DGBorrar.php');
			/* Act on the event */
		});
		$("#btn_borrar").click(function(event) {

			$(location).attr('href','BorrarGrupoFinal.php?folio='+$("#FolioVta").val());
			/* Act on the event */
		});
		
	});



	</script>		
	</body>
	</html>

<?php 

	



	cerrar($conexion);
 
 
 }else{
	
	echo '<script language="javascript">alert("No se ha iniciado ninguna sesion");
		window.location.href="../index.html";
		</script>'; 
}
 ?>
