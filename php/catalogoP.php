<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();

$log = $_SESSION["tipo"];

	@$folio = $_GET['folio'];

	$sql = "SELECT * FROM `promociones` WHERE `foliopromo` = $folio";

$resultado= @mysql_query($sql) or die(mysql_error());
while ($datos = @mysql_fetch_assoc($resultado) )
{
	$nombre = $datos["nombre"];
	$fechainiciop = $datos["fechainiciop"];
	$fechafinalp = $datos["fechafinalp"];
	$precio = $datos["precio"];
	$descripcion = $datos["descripcion"];
	$ruta = $datos['imagen'];	
}

 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Información de la Promoción</title>
 	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/bordesT.css">

	<script src="../js/jquery-2.0.2.min.js"></script>

	<script>
	$(document).ready(function(){ 
	var log = $("#log").val();
	$("#btn_regresar").click(function(event) {

	 $(location).attr('href','../Usuarios/'+log+'/Dashboard/DPrAdministrar.php');
	
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
				

			 <label>Nombre de la Promoción : </label><?php echo $nombre; ?> <br>
			 <label>Fecha de Inicio de la Promoción :  </label><?php echo $fechainiciop; ?> <br>
			 <label>Fecha de Caducidad de la Promoción : </label><?php echo $fechafinalp; ?> <br>
			 <label>Precio de la Promoción : </label><?php echo $precio; ?> <br>
			 <label>Descripción de la Promoción : </label><?php echo $descripcion; ?> <br>	
			 <label>Imagen de la Promoción :  </label> <img src="<?php echo $ruta;?>" alt=""> <br>
 			 
 			<div class="derecha">
			 <button type="button" class="btn btn-warning" id="btn_regresar">Regresar</button>
			</div>
		
</div>

 	
 </body>
 </html>
