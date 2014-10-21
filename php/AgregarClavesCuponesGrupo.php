<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$log = $_SESSION["tipo"];

$folioGrupo = $_GET["folio"];

$sql = "SELECT * FROM ventagrupo WHERE `FolioGrupo` = '$folioGrupo'";

$resultado = mysql_query($sql) or die(mysql_error());

while ($datos = @mysql_fetch_assoc($resultado) ){

								$FolioGrupo = $datos['FolioGrupo'];
								$idViajero = $datos['idViajero'];
								$FechaIn = $datos['FechaIn'];
								$FechaOut = $datos['FechaOut'];
								$NombreGrupo = $datos['NombreGrupo'];
								$Descripcion = $datos['Descripcion'];
								$CostoTotal = $datos['CostoTotal'];
								// $CantidadVariable = $datos['CantidadVariable'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaCompra = $datos['FechaCompra'];
								$IdUsuario = $datos['IdUsuario'];
								$OperadoraMay = $datos['OperadoraMay'];
								$estatus = $datos['Estatus'];
							}
$sql1 = "SELECT * FROM cliente WHERE idViajero = '$idViajero'";

$resultado1 = mysql_query($sql1) or die(mysql_error());
while ($datos1 = @mysql_fetch_assoc($resultado1) ){

	$nombreCli = $datos1['Nombre'];
}


$_SESSION['FolioAux'] = $folioGrupo;

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Claves Grupo</title>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link rel="stylesheet" href="../css/bordesT.css">

</head>
<body>

<figure style="text-align: center;">
	<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
	<h3>Agregar Claves Grupo</h3>
</figure>

<div id="informacion">
<input type="hidden" id="FolioGrupo"value="<?php echo $FolioGrupo ?>">
<div class="derecha">
<?php  echo "<button class='btn btn-warning'><a href=\"../Usuarios/".$log."/DashBoard/DGCupon.php\">Regresar</a></button>" ?> 

</div>
<div id="datos_grupo" style="text-align:top; width: 950px; display: inline-block;"class="bg-warning">


<div class="caja"> <label for="">Nombre del Grupo:</label> <br> <?php echo $NombreGrupo ?>
</div>
<div class="caja"> <label for="">Fecha de Viaje :</label><br><?php echo "Entrada ".$FechaIn." / Salida : ".$FechaOut; ?>
</div>
<div class="caja"> <label for="">Coordinador :</label><br><?php echo $nombreCli ?>
</div>

</div>


<form action="" id="form_claves" >
	<input type="hidden" value="<?php echo $FolioGrupo ?>" name="FolioGrupo">
	<label for="">Clave de confirmacion </label><input type="text"  id="claveConfirmacion" name="claveConfirmacion" class="form-control" required placeholder="Clave que proporciona la operadora">
	<label for="">Confirmado por </label><input type="text" id="confirmadoPor" name="confirmadoPor" class="form-control" required placeholder="Quien confirma la reserva">
	<button type = "button"class="btn btn-info" id="agregarCV">agregar claves</button>
</form>


	

	<script src="../js/jquery-1.11.0.js"> </script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/appPax.js"> </script>	
</body>
</html>
<style>
	.caja
	{
		display: inline-block;
		width: 300px;
		text-align: top;
	}
</style>