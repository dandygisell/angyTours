<?php 
session_start();
require_once '../php/Conexion.php';
require_once '../php/Biblioteca.php';
$log = $_SESSION["tipo"];
$conexion = conectarse();
if($_SESSION['logged'] == 'yes')
{}
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cupón de Venta</title>

	<link rel="stylesheet" href="../css/ECupon.css">
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.4.css">

	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />	
	
	<script src="../js/jquery-2.0.2.min.js"></script>
	<script src="../js/jquery-ui-1.10.4.js"></script> 
	<script src="../jquery-ui-1.10.4.custom\development-bundle\ui\i18n\jquery.ui.datepicker-es.js"></script>
	<script src="../js/appDashBoard.js"></script>
	<script src="../js/appCupones.js"></script>

	<script type="text/javascript">
	$(function (){
	$("#nombrehotel").autocomplete({
		source: 'buscar.php',
		select: function(event, ui){
			$("#nombrehotel").val(ui.item.label);
			$("#direccion").val(ui.item.direccion);
			$("#telefono").val(ui.item.telefono);
			$("#idhotel").val(ui.item.id);
		}
	});
	});
	</script>
</head>

<body>

	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Cupón de Venta</h3>
	</figure>

	<section><?php

	@$idViajero = $_GET['idViajero'];
	@$folio = $_GET['folio'];
	$sql = "SELECT * FROM `venta` WHERE `FolioVta`='$folio'";
	$resultado1= @mysql_query($sql) or die(mysql_error());
	while ($datos = @mysql_fetch_assoc($resultado1) ){

		$FolioVta = $datos['FolioVta'];
		$idViajero = $datos['idViajero'];
		$IdUsuario = $datos['IdUsuario'];
		$Descripcion = $datos['Descripcion'];
		$CantidadTotal = $datos['CantidadTotal'];
		$CantLetras = $datos['CantLetras'];
		$Saldo = $datos['Saldo'];
		$FechaViaje = $datos['FechaViaje'];
		$Fecharegreso = $datos['FechaRegreso'];
		$FechaCompra = $datos['FechaCompra'];
		$estatus = $datos['Estatus'];

	}
	$_SESSION["auxFolioVta"]=$FolioVta;
	$sql2 = "SELECT * FROM `cliente` WHERE `idViajero` = '$idViajero'";
	    $resultado2 = @mysql_query($sql2) or die(mysql_error());
		while ($datos = @mysql_fetch_assoc($resultado2) ){

				$idViajero = $datos['idViajero'];
				$Direccion = $datos['Direccion'];
				$Correo = $datos['Correo'];
				$Telefono = $datos['Telefono'];
				$Nombre = $datos['Nombre'];
			}
			$_SESSION["auxIdViajero"]=$idViajero;
	?>

		<div id="formulario">
			<form action="EnviarCuponCompleto.php"  method="post" class="form-horizontal" role="form" id="formCupon">

			    <div id="cliente" class="bg-warning">
			    	<div id="descripcion">
					   	<h2 class="titulo">Datos del Cliente</h2>
					   	<label for="">Titular</label>
					   	<input type="text" readonly  name="titular" value="<?php echo $Nombre;?>" class="form-control" required>
					   	<label for="">Acompañante</label>
					   	<input type="text" name="acompanante" placeholder= "Acompañante" class="form-control" required>		    	
						<label for="">Adultos </label>
						<input type="number" name="adultos" step="1" min="0" max="4" value="0" class="form-control" required>				
						<label for="">Menores </label>
						<input type="number" name="menores" step="1" min="0" max="2" value="0" class="form-control" required>
					</div>

			    	<div id="llegada">
			    	    <label for="">Fecha de Salida</label>
					   	<input type="text" name="fechaSalida" class="form-control" value="<?php echo $FechaViaje; ?>" readonly>
					   	<label for="">Fecha de Llegada</label>
					   	<input type="text" name="fechaLLegada" class="form-control" value="<?php echo $Fecharegreso; ?>" readonly>
					   	
					</div>
			    </div>

			    <div id="hotel" class="bg-warning">
			    	
			    	<div id="hotelC">
					   	<h2 class="titulo">Datos del Hotel</h2>
					    <input type="hidden" name="idhotel" id="idhotel">
					   	<label for="">Nombre del Hotel </label>
					   	<input type="text" id="nombrehotel"name="nombrehotel" placeholder="Nombre del Hotel" class="form-control" required><br>
						<label for="">Dirección del Hotel</label>
						<input type="text" id="direccion" name="direccion" placeholder="Dirección del Hotel" class="form-control" readonly><br>
						<label for="">Teléfono del Hotel </label>
						<input type="text" id="telefono"name="telefono" placeholder="Teléfono del Hotel" class="form-control" readonly><br>
					</div>

					<div id="plan">
					    	
					    	<label for="">Plan:</label>
					    	<select name="Plan" class="form-control">
						    	<option value="Plan Europeo">Plan Europeo </option>
						    	<option value="Plan con Desayuno">Plan con Desayuno </option>
						    	<option value="Plan todo incluido">Plan Todo Incluido </option>
						    	<option value="Pasadia">Pasadía</option>
					        </select><br>
					    </div>

			    </div>
				
				<div id="venta" class="bg-warning">

					<div id="opm">
				  		<h2 class="titulo">Datos de la Venta</h2>
				   		<label for="">Operadora Mayorista</label>
				   		<input type="text" name="opm" placeholder="Operadora Mayorista" class="form-control" required>
				   	</div>

				   	<div id="reserva">
				    	<label for="">Reserva confirmada por:</label>
				    	<input type="text" name="ResConP"placeholder="Asesor Mayorista" class="form-control" required>
				    </div>

				    <div id="atencion">
				    	<label for="">A la atencion de:</label>
				    	<input type="text" name="atencion" placeholder= "Hotel que Recibe al Huesped" class="form-control" required>
				    </div>

				    <div>
				    	<label for="">Fecha de Emisión </label>
				    	<input readonly value="<?php echo date("d/m/Y");?>" name="FdeE" class="form-control" required>
				    </div>

				    <div id="observaciones">
				    	<div id="clave_confirmacion">
					    	<label for="">Clave de confirmación:</label>
					    	<input type="text" name="clave" placeholder="Clave de Confirmacion" class="form-control" required>
					    </div>

					    <div id="otras">
					    	<label for="">Otras observaciones:</label>
					    	<input type="text" name="otras" placeholder="Otras Observaciones" class="form-control" required>
					    </div>

					</div>
					
				</div><br><br>
				
				<div id="boton">
				<?php
				echo "<button class='btn btn-warning' align=\"center\"><a style='color:white; text-decoration:none;' href=\"../Usuarios/".$log."/DashBoard/DVCupones.php\">Regresar</a></button>";
				?>
				<input type="button" class="btn btn-success" name="Enviar" id="boton1" value="Generar Cupón" align="center" target="_blank">
				</div>
				<div id="msg" style="display:none;"></div>
				
				    			    
		    </form>	
		</div>
		<div id="botonera"  style="display:none; float:right;">

		<div>El cupón se ha generado correctamente</div>
					<?php
				echo "<button class='btn btn-warning' align=\"center\"><a style='color:white; text-decoration:none;' href=\"../Usuarios/".$log."/DashBoard/DVCupones.php\">Regresar</a></button>";
				?>
				<input type="button" class="btn btn-success" name="Enviar" id="boton2" value="Generar Cupón" align="center" target="_blank">
				
				</div>

	</section>
		</body>
		<script>
		
		</script>
</html>