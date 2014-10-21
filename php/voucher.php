<?php 
session_start();
$log = $_SESSION["tipo"];
if($_SESSION['logged'] == 'yes')
{
require_once '../php/Conexion.php';
require_once '../php/Biblioteca.php';
$conexion = conectarse();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrar Voucher</title>	
	<link rel="stylesheet" href="../css/bordesT.css">
	
	<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.4.css">

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/kendo.common.min.css">
  	<link rel="stylesheet" href="../css/kendo.default.min.css">

	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />

	<script src="../js/jquery-2.0.2.min.js"></script>
	<script src="../js/jquery-ui-1.10.4.js"></script> 
	<script src="../jquery-ui-1.10.4.custom\development-bundle\ui\i18n\jquery.ui.datepicker-es.js"></script>
	<script src="../js/kendo.web.min.js"></script>
	<script src="../js/appDashBoard.js"></script>
	<script src="../js/appPrecio.js"></script>

	
</head>
<body>
	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Registrar Voucher</h3>
	</figure>
	<section>
		
		<div class="bg-warning bordes2">
		<p><strong>Registro de Voucher</strong></p>

		<input type="hidden" id="tipo" value="<?php echo $log; ?>">

		<form action="enviarVoucher.php" method="POST" autocomplete="on" class="form-horizontal" role="form" enctype="multipart/form-data"> 
	                                                         
	        <label for="concepto">Concepto de Venta:</label>
	        <select name="concepto" id="concepto" class="form-control" required>

	            <option value="reservacion">Reservación</option>
	            <option value="transporte">Transporte</option>
	            <option value="reserYTrans">Ambos</option>

            </select>	                        
	        <label for="">Fecha de Salida: </label>
            <input type="text" id="fecha" name="FechaSalida" class="form-control">
            <label for="">Fecha de Retorno: </label>
            <input type="text" id="fechaFinal" name="FechaRetorno" class="form-control">

            <label for="">Total de la Venta:</label>
            <input id="currency" class="form-control" type="number" value="0" min="0" max="1000000" name="total" required/><br>

            <label for="">Descripción:</label>
            <textarea name="descripcion" id="texto" class="form-control" cols="60" rows="5"></textarea>
	                        
	        <label for="">Subir imagen del voucher: </label>
	        <input type= "FILE" name="voucher"/><br>

	        <div class="derecha">
				<input type= "submit" class="btn btn-info" value="Subir"/>
				<input type= "button" class="btn btn-warning" id="btn_regresar"value="Regresar"/>		    		 
					    		
			</div>
			                                
	        </form>
		</div>
	</section>	
</body>
</html>
<?php 
}
?>
