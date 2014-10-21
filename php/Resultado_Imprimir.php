<?php 
session_start();
require_once'Conexion.php';
$Conexion = conectarse();
$usuario = $_SESSION["id"];
$folipago = $_SESSION["foliopago"];
$log = $_SESSION["tipo"];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Imprimir Cupon de Pago</title>
	<link rel="stylesheet" href="../css/bordesT.css">
	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="agregar" class="alert alert-success">
	<h2 align="center">El pago ha registrado con exito y el comprobante esta listo para descargar</h2>
	<div class="derecha"><br>
	<button class="btn btn-warning"><a href="../Usuarios/<?php echo $log ?>/Dashboard/DPagos.php">Regresar</a></button>
	<button class="btn btn-success"><a href="CuponPagoImprimir.php" target="_blank">Imprimir comprobante de pago</a></button>
	</div>
	</div>
</body>
</html>
<?php 
cerrar($Conexion);
?>