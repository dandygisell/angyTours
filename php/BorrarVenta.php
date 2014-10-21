<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$IdUsuario =$_SESSION["id"];
if($_SESSION['logged'] == 'yes')
{
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	
	<link rel="stylesheet" href="../jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css">

	<script type="text/javascript">
	$(function (){

		$('#cliente').autocomplete({
			source : 'ajx.php',
			select : function(event, ui){
				$('#resultados').html(
					
					'<h2>Verificar Datos</h2>' +
					'<strong>Nombre: </strong>' + ui.item.value + '<br />' +
					'<strong>Telefono: </strong>' + ui.item.telefono + '<br />'	+
					'<strong>Email: </strong>' + ui.item.email + '<br />' 
					
				)
				 $("#id").val(ui.item.idViajero);
			}
			});

	});
	</script>
</head>
<body>				
	<form action="" method="post"> 

		<label for="numeroFolio">Numero de Folio </label><input type="text" name="numeroFolio">
		<label for="nombrePax">Nombre del Titular de la Venta </label> <input type="text" name="cliente" id="cliente"><br>
		idViajero<input type="text" id="id" name="id"> <br>
		
		
		<input type="submit" value="buscar">
		<a href="../usuarios/Gerente/Gerente.php">regresar al menu</a>

	</form>

		<div id="resultados" align="center">


</body>
</html>
<?php 
if(isset($_POST["cliente"]))
{
	$numeroFolio = $_POST["numeroFolio"];
	$cliente =$_POST["cliente"];
	$idViajero =$_POST["id"];
	
   $sql = "SELECT * FROM `venta` WHERE idViajero = '$idViajero' or FolioVta = '$numeroFolio'";
$resultado= @mysql_query($sql) or die(mysql_error());


		if (consultaSQL($sql,$conexion))
		{			
			echo "Historial de Compras";
					$tabla = consultaArray ($sql,$conexion);
					$tablaborrable = array();
					$nuevoRenglon = array();
						foreach ($tabla as $renglon)
				{
				
					$nuevoRenglon = $renglon;
					@$nuevoRenglon["Borrar"]="<a href=\"AccionBorrarVenta.php?folio=".$renglon["FolioVta"]."\">Borrar </a>";
					$tablaborrable[]=$nuevoRenglon;
				}

		}
		else 
		{
			header("abonar.php");		
		}
		echo recorrerTabla($tablaborrable);


}	
cerrar($conexion);


 ?>
<?php 
	}else{
		echo '<script language="javascript">alert("No se ha iniciado ninguna sesión");
			window.location.href="../../Html/index.html";
			</script>'; 	
}
 ?>
