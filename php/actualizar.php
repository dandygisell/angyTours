<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$log = $_SESSION["tipo"];

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modificar Hoteles</title>

	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/bordesT.css">

	<script src="../js/jquery-2.0.2.min.js"></script>

	<script>
$(document).ready(function(){ //document.ready significa que cuando este lista la página
	var log = $("#log").val();
// $("#TxtHotel").hide(0);//va a ocultar las cajas de texto con los ID´s TxtNombre y Txte-mail
// $("#TxtDireccion").hide(0);
// $("#TxtTelefono").hide(0);
// $("#TxtDescripcion").hide(0);
                             //tambien cuando hagan clic en cualquier elemento input (focus)pondra 
                              //un color gris  y cuando dejen de hacer clic en los elemntos inputs (blur)
$("input").focus(function(){  //volvera a tener color blanco
	$(this).css("background-color","#cccccc");
});

$("input").blur(function(){
	$(this).css("background-color","#ffffff");

});
$("#btn_regresar").click(function(event) {

	 $(location).attr('href','../Usuarios/'+log+'/DashBoard/DCAdministrar.php');
	/* Act on the event */
});
});

//nota: puedes combinar JQuery con javascript o viceversa...
//las functions son mis metodos, estos pueden ser llamados por eventos como onclic, onfocus, onblur, etc,
//y mandar parametros con "this.value" a los metodos como hago en <onblur="ModificarNombre(this.value)">

// los metodos VerNombre y VerEmail unicamente ocultan los spans y muestran los inputs text


//NOMBRE DEL HOTEL
function NombreHotel()
{
	$("#NHactual").hide(0); //hide oculta y show muestra cualquier elemento de html
	$("#TxtHotel").show(1000);// se puede meter paramtros a hide y show, lo que hara que se muestre lenta
								// o rapida la animación,con "0" la animación no se muestra
}

function ModificarHotel(value)
{
	$("#NHactual").text(value);// el .text agregara al span "Nexistente" el texto 
	$("#TxtHotel").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
	$("#NHactual").show(1000);
}

function DireccionHotel()
{
	$("#DHactual").hide(0);
	$("#TxtDireccion").show(1000);
}
function ModificarDireccion(value)
{
	$("#DHactual").text(value);// el .text agregara al span "Nexistente" el texto 
	$("#TxtDireccion").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
	$("#DHactual").show(1000);
}
function TelefonoHotel()
{
	$("#THactual").hide(0);
	$("#TxtTelefono").show(1000);
}
function Modificartelefono(value)
{
	$("#THactual").text(value);// el .text agregara al span "Nexistente" el texto 
	$("#TxtTelefono").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
	$("#THactual").show(1000);
}
function DescripcionHotel()
{
	$("#DesHotel").hide(0);
	$("#TxtDescripcion").show(1000);
}
function ModificarDescripcion(value)
{
	$("#DesHotel").text(value);// el .text agregara al span "Nexistente" el texto 
	$("#TxtDescripcion").hide(1000); // si quieres hacer lo mismo con el input text debera ser .val en ves de .text
	$("#DesHotel").show(1000);
}
</script>
</head>
<body>

	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Modificar Hoteles</h3>
	</figure>
	
	<section>
<?php
@$folio = $_GET['folio2'];
	$sql1 = "SELECT * FROM `catalogo1` WHERE `catalogo1`.`foliocatalogo` = $folio;";
	$sql2 = "SELECT * FROM `catalogo2` WHERE `catalogo2`.`foliocatalogo` = $folio;";
	$sql3 = "SELECT * FROM `catalogo3` WHERE `catalogo3`.`foliocatalogo` = $folio;";
	$sql4 = "SELECT * FROM `catalogo4` WHERE `catalogo4`.`foliocatalogo` = $folio;";
	$resultado1 = @mysql_query($sql1) or die(mysql_error());
    while ($datos = @mysql_fetch_assoc($resultado1) )
    {
	  $nombrehotel = $datos['nombrehotel'];
	}
	$resultado2 = @mysql_query($sql2) or die(mysql_error());
    while ($datos = @mysql_fetch_assoc($resultado2) )
    {
	  $direccion = $datos['direccion'];
	}
	$resultado3 = @mysql_query($sql3) or die(mysql_error());
    while ($datos = @mysql_fetch_assoc($resultado3) )
    {
	  $telefono = $datos['telefono'];
	}
	$resultado4 = @mysql_query($sql4) or die(mysql_error());
    while ($datos = @mysql_fetch_assoc($resultado4) )
    {
	  $descripcion = $datos['descripcion'];
	  $ruta = $datos['imagen'];
	}
?>
			<input type="hidden" id="log" value="<?php echo $log; ?>">

		<div>
			<form action="" method = "post" enctype="multipart/form-data" class="bg-warning bordes2">

			    <label for="">Nombre del Hotel:</label>
			    <span id="NHactual" onclick="NombreHotel()"><?php echo $nombrehotel ?></span>
				<input type="text" class="form-control" id="TxtHotel" name="TxtHotel" value="<?php echo $nombrehotel ?>" onblur="ModificarHotel(this.value)"><br>
							
				<label for="">Dirección del Hotel:</label> 
				<span id="DHactual" onclick="DireccionHotel()"><?php echo $direccion ?></span>
				<input type= "text" class="form-control" id="TxtDireccion" name = "Txtdireccion" value="<?php echo $direccion ?>" onblur="ModificarDireccion(this.value)"><br>

				<label for="">Teléfono del Hotel: </label>
				<span id="THactual" onclick="TelefonoHotel()"><?php echo $telefono ?></span>
				<input type= "text" class="form-control" id="TxtTelefono" name = "TxtTelefono" value="<?php echo $telefono ?>" onblur="Modificartelefono(this.value)"><br>

				<label for="">Descripción:</label> 
				<span id="DesHotel" onclick="DescripcionHotel()"><?php echo $descripcion ?></span>
				<input type= "text" style="WIDTH: 228px; HEIGHT: 98px; text-align:justify;"  size="32" id="TxtDescripcion" name="TxtDescripcion" value="<?php echo $descripcion ?>" cols="30" rows="10" onblur="ModificarDescripcion(this.value)"><br />
				<!-- <textarea  style="WIDTH: 228px; HEIGHT: 98px border:2px red solid;" size=32 id="TxtDescripcion" name="TxtDescripcion" value="<?php echo $descripcion ?>" onblur="ModificarDescripcion(this.value)" cols="30" rows="10"></textarea> <br> -->
				<label for="">Actualizar Imagen del Hotel:</label>
				<input type= "FILE" name = "imagen" /><br />

				<div class="derecha">
					<button type="button" id="btn_regresar" class="btn btn-warning" align="center">Regresar</button>
		        	<input type= "submit" value="Agregar" class="btn btn-info"/>
	        	</div>			
			</form>
		</div>
	</section>
	<?php

	@$folio = $_GET['folio2'];

	if(isset($_POST["TxtHotel"]))
{
	$nombre = $_POST["TxtHotel"];
	$direccion = $_POST["TxtDireccion"];
	$telefono = $_POST["TxtTelefono"];
	$descripcion = $_POST["TxtDescripcion"];

	// $concepto = $con.$fechaViaje.$cantidad;
	$rutaservidor="../imgcatalogo"; //aqui es el nombre de la carpeta donde se guardara la imgen
	$rutatemporal=$_FILES['imagen']['tmp_name'];//imagen es el name del formulario
	$nombreimg=$_FILES['imagen']['name'];//recuperarmos nombre de imagen
	$rutadestino=$rutaservidor.'/'.$nombreimg;//concatenamos la ruta donde estara la imagen
	move_uploaded_file($rutatemporal,$rutadestino); // se mueve la imagen 
	
				$sql1 = "UPDATE `catalogo1` SET `foliocatalogo` = '$folio', `nombrehotel` = '$nombre' WHERE `catalogo1`.`foliocatalogo` = $folio;";
				$sql2 = "UPDATE `catalogo2` SET `foliocatalogo` = '$folio', `direccion` = '$direccion' WHERE `catalogo2`.`foliocatalogo` = $folio;";
				$sql3 = "UPDATE `catalogo3` SET `foliocatalogo` = '$folio', `telefono` = '$telefono' WHERE `catalogo3`.`foliocatalogo` = $folio;";
				$sql4 = "UPDATE `catalogo4` SET `foliocatalogo` = '$folio', `descripcion` = '$descripcion', `imagen` = '$rutadestino' WHERE `catalogo4`.`foliocatalogo` = $folio;";
				
			
				if (consultaSQL($sql1,$conexion))
				{								
					echo '<script language="javascript">alert("Registro correcto.");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
				if (consultaSQL($sql2,$conexion))
				{								
					echo '<script language="javascript">alert("Registro correcto.");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
				if (consultaSQL($sql3,$conexion))
				{								
					echo '<script language="javascript">alert("Registro correcto.");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
				if (consultaSQL($sql4,$conexion))
				{								
					echo '<script language="javascript">alert("Registro correcto.");
					window.location.href="javascript:history.back(1)";
					</script>'; 
				}
				else 
				{
					echo mysql_error();	
				}
			}
	?></body>
</html>