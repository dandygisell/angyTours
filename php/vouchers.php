<?php 
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
	@$folio = $_GET['folio'];

	$sql = "SELECT * FROM `voucher` WHERE `folioVoucher` = $folio";

$resultado= @mysql_query($sql) or die(mysql_error());
while ($datos = @mysql_fetch_assoc($resultado) )
{
	$concepto = $datos["concepto"];
	$FechaSalida = $datos["fechaSalida"];
	$FechaRetorno = $datos["fechaRetorno"];
	$totalVta = $datos["total"];
	$descripcion = $datos["descripcion"];
	$ruta = $datos['imagen'];	
	
}

 ?>	
			 <label><strong>Concepto : </strong></label><?php echo $concepto; ?> <br>
			 <label><strong>Fecha de salida : </strong> </label><?php echo $FechaSalida; ?> <br>
			 <label><strong>Fecha de retorno : </strong></label><?php echo $FechaRetorno; ?> <br>
			 <label><strong>Total de la venta : </strong></label><?php echo $totalVta; ?> <br>
			 <label><strong>Descripcion : </strong></label><?php echo $descripcion; ?> <br>	
			 <a id="adjunto"href="../<?php echo $ruta ?>" target="_blank">Ver archivo</a>
			 <label><strong>Imagen del voucher : </strong> </label> <img src="../<?php echo $ruta ?>" alt="">	

