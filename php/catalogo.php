<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();

$log = $_SESSION["tipo"];

	@$folio = $_GET['folio'];

	$sql1 = "SELECT * FROM `catalogo1` WHERE `foliocatalogo` = $folio";
	$sql2 = "SELECT * FROM `catalogo2` WHERE `foliocatalogo` = $folio";
	$sql3 = "SELECT * FROM `catalogo3` WHERE `foliocatalogo` = $folio";
	$sql4 = "SELECT * FROM `catalogo4` WHERE `foliocatalogo` = $folio";

$resultado1= @mysql_query($sql1) or die(mysql_error());
while ($datos = @mysql_fetch_assoc($resultado1) )
{
	$nombre = $datos["nombrehotel"];
}

$resultado2= @mysql_query($sql2) or die(mysql_error());
while ($datos = @mysql_fetch_assoc($resultado2) )
{
	$direccion = $datos["direccion"];
}

$resultado3= @mysql_query($sql3) or die(mysql_error());
while ($datos = @mysql_fetch_assoc($resultado3) )
{
	
	$telefono = $datos["telefono"];
}

$resultado4= @mysql_query($sql4) or die(mysql_error());
while ($datos = @mysql_fetch_assoc($resultado4) )
{
	$descripcion = $datos["descripcion"];
	$ruta = $datos["imagen"];
}

 ?>

 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Información del Hotel</title>
 	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/bordesT.css">

	<script src="../js/jquery-2.0.2.min.js"></script>

	<script>
	$(document).ready(function(){
	var log = $("#log").val();
	$("#btn_regresar").click(function(event) {

	 $(location).attr('href','../Usuarios/'+log+'/DashBoard/DCAdministrar.php');
});
	});


	</script>
 </head>
 <body>
 	
 	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Información de la Promoción</h3>
	</figure>

 <input type="text" id="log" hidden value="<?php echo $log; ?>">

 <div id="contenedor" class="bg-warning bordes2">

 			 <label>Nombre del Hotel : </label><?php echo $nombre; ?> <br>
			 <label>Dirección del Hotel :  </label><?php echo $direccion; ?> <br>
			 <label>Teléfono del Hotel : </label><?php echo $telefono; ?> <br>
			 <label>Descripción del Hotel : </label><?php echo $descripcion; ?> <br>
			 <label>Imagen del Hotel :  </label> <img src="../<?php echo $ruta; ?>" alt="" >
			
			<div class="derecha">
			 <button type="button" class="btn btn-warning" id="btn_regresar" align="center">Regresar</button>
			</div>

</div>
 	
 </body>
 </html>
			 




<?php 

 ?>