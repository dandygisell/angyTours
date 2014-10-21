<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$log = $_SESSION["tipo"];

$conexion = conectarse();
if($_SESSION['logged'] == 'yes')
{ 

	@$folio = $_GET["folio"];
	$_SESSION['folio'] = $folio;

	$sql = "SELECT * FROM `ventagrupo` WHERE `FolioGrupo` = '$folio'";
	$resultado= @mysql_query($sql) or die(mysql_error());

	while ($datos = @mysql_fetch_assoc($resultado) ){

	$FolioGrupo = $datos['FolioGrupo'];
	$idViajero = $datos['idViajero'];
	$FechaIn = $datos['FechaIn'];
	$FechaOut = $datos['FechaOut'];
	$NombreGrupo = $datos['NombreGrupo'];
	$Descripcion = $datos['Descripcion'];
	$CostoTotal = $datos['CostoTotal'];
	$CantLetras = $datos['CantLetras'];
	$Saldo = $datos['Saldo'];
	$FechaCompra = $datos['FechaCompra'];
	$IdUsuario = $datos['IdUsuario'];
	$OperadoraMay = $datos['OperadoraMay'];
	$estatus = $datos['Estatus'];

	$_SESSION['auxFolioGrupo'] = $FolioGrupo;

	if ($estatus == "Abierta") {	
?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Abono Grupo</title>

<link rel="stylesheet" href="../css/bordesT.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/kendo.common.min.css">
<link rel="stylesheet" href="../css/kendo.default.min.css">
	
<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />

</head>
<body><?php 

	$sql = "SELECT * FROM `cliente` WHERE `idViajero` = '$idViajero'";
	$resultado= @mysql_query($sql) or die(mysql_error());
	while ($datos = @mysql_fetch_assoc($resultado) ){

		$idViajero = $datos['idViajero'];
		$Direccion = $datos['Direccion'];
		$Correo = $datos['Correo'];
		$Telefono = $datos['Telefono'];
		$Nombre = $datos['Nombre'];
	}?>
	<div id="datos_Vta">

	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Abonar Grupo</h3>
	</figure>

		<table align="center" class="table table-hover table-bordered bg-warning" style="width:700px;">
			<thead>
				<th>Folio de la Venta</th>
				<th>Nombre del Grupo</th>
				<th>Descripccion</th>
				<th>Fecha Entrada</th>
				<th>Fecha Salida</th>
				<th>Total</th>
				<th>Saldo</th>
				<th>Fecha de La compra</th>
			</thead>

			<tbody>
				<tr>
					<td><?php echo $FolioGrupo ?></td>
					<td><?php echo $NombreGrupo; ?></td>
					<td><?php echo $Descripcion ?></td>
					<td><?php echo $FechaIn ?></td>
					<td><?php echo $FechaOut ?></td>
					<td><?php echo $CostoTotal ?></td>
					<td><?php echo $Saldo ?></td>
					<td><?php echo $FechaCompra ?></td>
				</tr>
			</tbody>
		
		</table>
	</div>

	<form action="AccionAbonarGrupo.php" method="post" align="center">
											  			
		<label for="cantidad">Cantidad :</label>
		<input type="number" name="cantidad" class="form-control" align="center" id="currency" value="0" min="0" max="1000000" required><br><br>
		<div align="center"><?php echo"<button type=\"button\" class='btn btn-warning'><a style='text-decoration: none;color:white;' href=\"../Usuarios/".$log."/DashBoard/DGAbonar.php\" >Regresar</a></button>" ?>
		<input type="submit" class="btn btn-success" value="Abonar" id="push"></div>

	</form>
	<script src="../js/jquery-2.0.2.min.js"></script>
	<script src="../js/kendo.web.min.js"></script>
	<script src="../js/appPrecio.js"></script>
</body>
</html><?php 

} else {
 	echo "<h2 align=\"center\">La venta esta cerrada pulse para regresar</h2>";
	echo "<button align=\"center\"><a href=\"../Usuarios/".$log."/DashBoard/DGAbonar.php\">Regresar</a></button>";
  	}
}
cerrar($conexion);
 
}else{
	
	echo '<script language="javascript">alert("No se ha iniciado ninguna sesion");
		window.location.href="../index.html";
		</script>'; 
}
?>