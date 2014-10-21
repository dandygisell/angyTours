<?php 
session_start();
require_once '../php/Conexion.php';
require_once '../php/Biblioteca.php';
$log = $_SESSION["tipo"];
$conexion = conectarse();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modificar Promociones</title>
	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/bordesT.css">

	<script src="../js/jquery-1.11.0.js"></script>

	<script>
$(document).ready(function(){ //document.ready significa que cuando este lista la página

	var log = $("#log").val();
// $("#TxtPromo").hide(0);//va a ocultar las cajas de texto con los ID´s TxtNombre y Txte-mail
// $("#fecha1").hide(0);
// $("#fecha2").hide(0);
// $("#TxtPrecio").hide(0);
// $("#TxtDescripcion").hide(0);      //tambien cuando hagan clic en cualquier elemento input (focus)pondra 
                              //un color gris  y cuando dejen de hacer clic en los elemntos inputs (blur)
$("input").focus(function(){  //volvera a tener color blanco
	$(this).css("background-color","#cccccc");
});

$("input").blur(function(){
	$(this).css("background-color","#ffffff");
});
$("#btn_regresar").click(function(event) {

	 $(location).attr('href','../Usuarios/'+log+'/DashBoard/DPrAdministrar.php');
	/* Act on the event */
});
});

//nota: puedes combinar JQuery con javascript o viceversa...
//las functions son mis metodos, estos pueden ser llamados por eventos como onclic, onfocus, onblur, etc,
//y mandar parametros con "this.value" a los metodos como hago en <onblur="ModificarNombre(this.value)">

// los metodos VerNombre y VerEmail unicamente ocultan los spans y muestran los inputs text

//NOMBRE DE PROMOCION
// function NombrePromo()
// {
// 	$("#NPexistente").hide(0); //hide oculta y show muestra cualquier elemento de html
// 	$("#TxtPromo").show(1000);// se puede meter parametros a hide y show, lo que hara que se muestre lenta
// 								// o rapida la animación,con "0" la animación no se muestra
// }

// function ModificarNombrePromo(value)
// {
// 	$("#NPexistente").text(value);// el .text agregara al span "Nexistente" el texto 
// 	$("#TxtPromo").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
// 	$("#NPexistente").show(1000);
// }

// function fechainiciop()
// {
// 	$("#Fexistente1").hide(0);
// 	$("#fecha1").show(1000);
// }

// function fechafinalp()
// {
// 	$("#Fexistente2").hide(0);
// 	$("#fecha2").show(1000);
// }
// function precio()
// {
// 	$("#Pexistente").hide(0);
// 	$("#TxtPrecio").show(1000);
// }
// function descripcion()
// {
// 	$("#Dexistente").hide(0);
// 	$("#TxtDescripcion").show(1000);
// }

// function ModificarFechainiciop(value)
// {
// 	$("#Fexistente1").text(value);// el .text agregara al span "Nexistente" el texto 
// 	$("#fecha1").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
// 	$("#Fexistente1").show(1000);
// }
// function ModificarFechafinalp(value)
// {
// 	$("#fexistente2").text(value);// el .text agregara al span "Nexistente" el texto 
// 	$("#fecha2").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
// 	$("#Fexistente2").show(1000);
// }
// function ModificarPrecio(value)
// {
// 	$("#Pexistente").text(value);// el .text agregara al span "Nexistente" el texto 
// 	$("#TxtPrecio").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
// 	$("#Fexistente").show(1000);
// }
// function ModificarDescripcion(value)
// {
// 	$("#Dexistente").text(value);// el .text agregara al span "Nexistente" el texto 
// 	$("#TxtDescripcion").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
// 	$("#Dexistente").show(1000);
// }
</script>
</head>
<body>

	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Modificar Promoción</h3>
	</figure>

	<section>

	<?php
	@$folio = $_GET['folio2'];
	$sql1 = "SELECT * FROM `promociones` WHERE `promociones`.`foliopromo` = $folio;";
	$resultado = @mysql_query($sql1) or die(mysql_error());
    while ($datos = @mysql_fetch_assoc($resultado) )
    {
	  $nombre = $datos['nombre'];
	  $fechainiciop = $datos['fechainiciop'];
	  $fechafinalp = $datos['fechafinalp'];
	  $precio = $datos['precio'];
	  $descripcion = $datos['descripcion'];
	  $ruta = $datos['imagen'];
	}
	?>
	<input type="hidden" id="log"value="<?php echo $log; ?>">
		<div>
		<form action="" method = "post" enctype="multipart/form-data" class="bg-warning bordes2" >          		
          	<label for="">Nombre de Promoción:</label>
			<span id="NPexistente"><?php echo $nombre?></span><br>
			
			<input type="text" class="form-control" id="TxtPromo" name="TxtPromo" value="<?php echo $nombre ?>" ><br>
			    
			<label for="">Fecha de Inicio de la promoción:</label> 
			<span id="Fexistente1" ><?php echo $fechainiciop ?></span>
			<input type="DATE" class="form-control" id="fecha1" name="fecha1" value="<?php echo $fechainiciop ?>"><br>
				
			<label for="">Fecha Final de la promoción:</label>
			<span id="Fexistente2" ><?php echo $fechafinalp ?></span>
			<input type="DATE" class="form-control" id="fecha2" name="fecha2" value="<?php echo $fechafinalp ?>"><br>

			    
			<label for="">Precio:</label>
			<span id="Pexistente" ><?php echo $precio ?></span>
			<input type="text" class="form-control" id="TxtPrecio" name="TxtPrecio" value="<?php echo $precio ?>" ><br>
				
			<label for="">Descripción:</label>
			<span id="Dexistente" ><?php echo $descripcion ?></span>
			<input type= "text" style="WIDTH: 228px; HEIGHT: 98px" id="TxtDescripcion" name="TxtDescripcion" value="<?php echo $descripcion ?>" ><br />
				
			<label for="">Subir Imagen de la Promoción:</label>
			<input type= "FILE" name = "imagen" value="<?php $ruta?>" /><br />
			
			<div class="derecha">
				<button type="button" class="btn btn-warning" id="btn_regresar" align="center">Regresar</button>
	        	<input type= "submit" value="Agregar" class="btn btn-info"/>
	        </div>				
			
		</form>
		<!-- <form action="" method = "post" enctype="multipart/form-data" class="bg-warning bordes2" >          		
          	<label for="">Nombre de Promoción:</label>
			<span id="NPexistente" onclick="NombrePromo()"><?php echo $nombre ?></span>
			<input type="text" class="form-control" id="TxtPromo" name="TxtPromo" value="<?php echo $nombre ?>" onblur="ModificarNombrePromo(this.value)"><br>
			    
			<label for="">Fecha de Inicio de la promoción:</label> 
			<span id="Fexistente1" onclick="fechainiciop()"><?php echo $fechainiciop ?></span>
			<input type="DATE" class="form-control" id="fecha1" name="fecha1" value="<?php echo $fechainiciop ?>" onblur="ModificarFechainiciop(this.value)"><br>
				
			<label for="">Fecha Final de la promoción:</label>
			<span id="Fexistente2" onclick="fechafinalp()"><?php echo $fechafinalp ?></span>
			<input type="DATE" class="form-control" id="fecha2" name="fecha2" value="<?php echo $fechafinalp ?>" onblur="ModificarFechafinalp(this.value)"><br>

			    
			<label for="">Precio:</label>
			<span id="Pexistente" onclick="precio()"><?php echo $precio ?></span>
			<input type="text" class="form-control" id="TxtPrecio" name="TxtPrecio" value="<?php echo $precio ?>" onblur="ModificarPrecio(this.value)"><br>
				
			<label for="">Descripción:</label>
			<span id="Dexistente" onclick="descripcion()"><?php echo $descripcion ?></span>
			<input type= "text" style="WIDTH: 228px; HEIGHT: 98px" id="TxtDescripcion" name="TxtDescripcion" value="<?php echo $descripcion ?>" onblur="ModificarDescripcion(this.value)"><br />
				
			<label for="">Subir Imagen de la Promoción:</label>
			<input type= "FILE" name = "imagen" value="<?php $ruta?>" /><br />
			
			<div class="derecha">
				<button type="button" class="btn btn-warning" id="btn_regresar" align="center">Regresar</button>
	        	<input type= "submit" value="Agregar" class="btn btn-info"/>
	        </div>				
			
		</form> -->
			
		</div>
	</section>
	<?php
	@$folio = $_GET['folio2'];
	if(isset($_POST["TxtPromo"]))
    {
		$nombre1 = $_POST["TxtPromo"];
		$fechainiciop1 = $_POST["fecha1"];
		$fechafinalp1 = $_POST["fecha2"];
		$precio1 = $_POST["TxtPrecio"];
		$descripcion1 = $_POST["TxtDescripcion"];

		// $concepto = $con.$fechaViaje.$cantidad;
		$rutaservidor="../imgpromo"; //aqui es el nombre de la carpeta donde se guardara la imgen
		$rutatemporal=$_FILES['imagen']['tmp_name'];//imagen es el name del formulario
		$nombreimg=$_FILES['imagen']['name'];//recuperarmos nombre de imagen
		$rutadestino=$rutaservidor.'/'.$nombreimg;//concatenamos la ruta donde estara la imagen
		move_uploaded_file($rutatemporal,$rutadestino); // se mueve la imagen 
	
		$sql = "UPDATE `promociones` SET `foliopromo` = '$folio', `nombre` = '$nombre1', `fechainiciop` = '$fechainiciop1', `fechafinalp` = '$fechafinalp1', `precio` = '$precio1', `descripcion` = '$descripcion1', `imagen` = '$rutadestino' WHERE `promociones`.`foliopromo` = $folio;";
	
				if (consultaSQL($sql,$conexion))
				{								
					echo utf8_decode('<script language="javascript">alert("Promoción actualizada correctamente");
						window.location.href="javascript:history.back(1)";
						</script>'); 
				}
				
				else 
				{
					echo mysql_error();	
				}
	}
	?></body>
</html>