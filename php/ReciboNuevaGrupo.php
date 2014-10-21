<?php
session_start();
$FolioGrupo = $_SESSION["FolioGrupo"];
$log = $_SESSION["tipo"];
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();

$sql = "SELECT * FROM ventagrupo WHERE FolioGrupo = '$FolioGrupo'";

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
							}

							// echo $Descripcion;
							$sql = "SELECT * FROM cliente WHERE idViajero = '$idViajero'";

							$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$NombreCli = $datos['Nombre'];
							}

							$sql = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuario'";

							$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$NombreUsr = $datos['Nombre'];
							}



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recibo Nuevo Grupo</title>
	<link rel="stylesheet" href="../css/ReciboVenta.css">
	<link rel="stylesheet" href="../css/bordesT.css">
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<link rel="shortcut icon" href="imagenes\iconoAngy.ico" />	
</head>
<body>
	<section style="margin: 0 auto; width: 800px;">
		
	
			<form action="" method="post">
				<div id="contenedor">
			<div id="Encabezado" >
				<div id="logo" >
					<figure>
						<img src="../imagenes/AngyTours.png" alt="" width="100px" heigth="100px">
					</figure>
				</div>
				<div id="datos" align="Center" >
					<p>Angytours</p>					
					<p>Calle 59j # 565 X 110 y 112 Col. Bojorquez</p>
					<p>Tel: (999) 9-12-28-95 | Cel: (044)9992-44-54-14</p>
					<p>Correo: angeviajes@hotmail.com</p>
				</div>
			</div>
			<div id="folio" class="recuadro">
				<label>Folio : </label><?php echo $FolioGrupo ?>
			</div>
			<div id="cliente" class="recuadro">
				<label>Cliente : </label><?php echo $NombreCli ?>
			</div>
			<div id="cantidad" class="recuadro">
				<label>Importe : </label><?php echo $CostoTotal ?>
			</div>
			<div id="cantLetras" class="recuadro">
				<?php echo $CantLetras ?>
			</div>
			<div id="fecha" class="recuadro">
				<label>Fecha : </label><?php echo $FechaCompra ?>				
			</div>
			<div id="Descripcion" class="recuadro">
				<label>Descripción : </label> <p id="Texto"><?php echo $Descripcion ?></p>
			</div>			
			
			<div id="recibido" class="recuadro">
				<label>Vendedor : </label><?php echo $NombreUsr ?>
			</div>
			<div id="Firma" class="recuadro">
				<label>Firma : </label>
			</div>
		</div>
		
		
		<div id="botonera" class="derecha">
			<?php echo "<button class='btn btn-warning'><a href=\"../Usuarios/".$log."/DashBoard/DGrupo.php\">Regresar</a></button>"; ?>
			<button class='btn btn-info'><a href="GenerarCuponGrupo.php" target="_blank">Descargar</a></button>	
		</div>
			</form>
		</div>
	</section>
	<footer></footer>
	
</body>
</html>
<style type="text/css" media="print">
@media print {
#botonera {display:none;}

}
</style>