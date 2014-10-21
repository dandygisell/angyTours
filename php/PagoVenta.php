<?php 
session_start();
$log = $_SESSION["tipo"];
$usuario = $_SESSION["user"];
require_once'Conexion.php';
$Conexion = conectarse();
$FolioVta = $_GET["folio"];
$sql = "SELECT * FROM venta WHERE FolioVta = '$FolioVta'";

$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$FolioVta = $datos['FolioVta'];
								$idViajero = $datos['idViajero'];
								$IdUsuario = $datos['IdUsuario'];
								$Descripcion = $datos['Descripcion'];
								$CantidadTotal = $datos['CantidadTotal'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaViaje = $datos['FechaViaje'];
								$FechaCompra = $datos['FechaCompra'];
								$estatus = $datos['Estatus'];
							}

$sql = "SELECT * FROM cliente WHERE idViajero = '$idViajero'";							
$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$nombre = $datos['Nombre'];
							}


?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pago de Ventas</title>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link rel="stylesheet" href="../css/bordesT.css">
</head>
<body>
<input type="hidden" id="log" value="<?php echo $log; ?>">
<figure style="text-align: center;">
	<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
	<h3>Pagos Pendientes Ventas</h3>
</figure>

<div id="informacion">
<div id="datos">
<div class="bg-warning bordes">
	<label for="">Cliente: </label><?php echo $nombre; ?><br>
	<label for="">Descripción: </label><?php echo $Descripcion; ?><br>
	<label for="">Cantidad: </label><?php echo $nombre; ?><br>
	<label for="">Estatus: </label><?php echo $estatus; ?><br>
</div><br>

<div >
	<button type="button" id="regresar"class="btn btn-success">Regresar</button>
</div>

</div>

<form action="ImprimirCuponPago.php" method="post" id="divDerecha" class="bg-warning bordes">

	<input type="text" hidden name="folioventa" value="<?php echo $FolioVta; ?>"><br>
	<label for="">Operadora: </label><input type="text" name="operadora" class="form-control" required><br>
	<input type="text" hidden id="concepto" name="concepto"value="<?php echo $Descripcion;?>"> 
	<label for="">Cantidad de pago:</label><input class="form-control" type="text" name="cantPago" readonly id="Cant" value="<?php echo $CantidadTotal; ?>"><br>
	<label for="">Comisión:</label><select name="comision" id="comision" class="form-control" required>
		<option value=".10">10%</option>
		<option value=".15">15%</option>
		<option value=".16">16%</option>
	</select>
	
	<div class="derecha">
		<input type="button" value="Calcular" id="Calcular" class="btn btn-info">
	</div>

	<label for="">Total:</label><input type="text" name="neto" id="neto" class="form-control" required><br>
	<label for="">Cantidad en Letras:</label><input type="text" name= "cantLetras" class="form-control" required><br>
	
	<div class="derecha">
		<input class="btn btn-info" type="submit" value="Registrar Pago">
	</div>

</form>
</div>

<script src="../js/jquery-1.11.0.js"> </script>

<script>
	$(document).ready(function($) {
	$("#Calcular").click(function(e) {

		var cantidad =  $("#Cant").val();
		var ciento = $("#comision").val();
		var neto;

		neto = (cantidad - (cantidad * ciento));

		$("#neto").val(""+neto);

	});
	$("#regresar").click(function(event) {

		var log = $("#log").val();

		$(location).attr('href','../Usuarios/'+log+'/DashBoard/DPpagosPendientes.php');
	});
	
});
	
</script>
</body>
</html><?php
cerrar($Conexion);
 ?>