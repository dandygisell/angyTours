<?php  
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();


$FolioGrupo = $_GET["folio"];
$_SESSION['FolioAux'] = $FolioGrupo;

$sql = "SELECT * FROM cuponesgrupo WHERE `FolioGrupo` = '$FolioGrupo'";

$resultado = mysql_query($sql) or die(mysql_error());

$validar = mysql_num_rows($resultado);

if ($validar != 0) {


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Imprimir Cupón Grupo</title>
	<link rel="stylesheet" href="../css/bordesT.css">
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="../css/kendo.common.min.css">
	<link rel="stylesheet" href="../css/kendo.default.min.css">
		
	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
</head>
<body>

	<figure style="text-align: center;">
		<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
		<h3>Imprimir Cupones</h3>
	</figure>

	  	<table align="center" class="table table-hover table-bordered bg-warning" style="width:900px;">
	 		<thead>
				<th>Nombre ddel Titular</th>
				<th>Nombre del Acompañante</th>
				<th>Menores</th>
				<th>Observaciones</th>
				<th>Tipo de Habitación</th>
				<th>Descargar</th>
			</thead><?php

while ($datos = @mysql_fetch_assoc($resultado) ){

	$FolioGrupo = $datos['FolioGrupo'];
	$nombreT = $datos['NombreTitular'];
	$nombreA =  $datos['NombreA'];
	$menores = $datos['Menores'];
	$obs = $datos['Observaciones'];
	$tipo = $datos['TipoHab'];	
	$FolioCupon = $datos['FolioCupon'];

?>
			<tbody>
				<tr>
					<td><?php echo $nombreT ?></td>
					<td><?php echo $nombreA ?></td>
					<td><?php echo $menores ?></td>
					<td><?php echo $obs ?></td>
					<td><?php echo $tipo ?></td>
					<td><?php echo "<button class='btn btn-info'><a style='text-decoration: none;color: white;' href=\"ImprimirCG.php?folio=".$FolioCupon."\" >Descargar</a></button>" ?></td>				   
				</tr>
			</tbody><?php } ?>
	 
		</table>

<?php 

	echo "<button><a href=\"ImprimirCGT.php?folio=".$FolioCupon."\" >Descargar Todos</a></button>" ;

} else {
	echo "EL gurpo no tiene Pasajeros";
}
?>

<script src="../js/jquery-2.0.2.min.js"></script>
<script src="../js/kendo.web.min.js"></script>
<script src="../js/appPrecio.js"></script>

</body>
</html>
<?php 

cerrar($conexion);
 ?>