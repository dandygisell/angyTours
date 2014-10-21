<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$FolioVta = $_SESSION["auxFolioVta"];
$log = $_SESSION["tipo"];
$conexion = conectarse();
if($_SESSION['logged'] == 'yes')
{
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Agregar Abono</title>
<link rel="stylesheet" href="../css/bordesT.css">
<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
<link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body><?php

if (isset($_POST["cantidad"])) {

	$cantidad1 = $_POST["cantidad"];

	$caracteres = Array("$",","); 
	$cantidad = str_replace($caracteres,"",$cantidad1); 

	$_SESSION["cant"] = $cantidad;

	


	$sql = "SELECT * FROM `venta` WHERE `FolioVta` = '$FolioVta'";
					$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$FolioVta = $datos['FolioVta'];
								$idViajero = $datos['idViajero'];
								$IdUsuario = $datos['IdUsuario'];
								$Descripcion = $datos['Descripcion'];
								$CantidadTotal = $datos['CantidadTotal'];
								// $CantidadVariable = $datos['CantidadVariable'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaViaje = $datos['FechaViaje'];
								$FechaCompra = $datos['FechaCompra'];
								$estatus = $datos['Estatus'];
							}

							$_SESSION["FolioVta"] = $FolioVta;


							$saldo1 = $Saldo - $cantidad;

							if ($saldo1 < 0) {

								echo '<script language="javascript">alert("El pago realizado es superior al saldo");
																	window.history.go(-1);
																	</script>'; 

								
							} else {	
								$sql = "INSERT INTO `abono` (`FolioAbono`, `FolioVta`, `Cantidad`, `FechaAbono`) 
								VALUES (NULL,'$FolioVta',$cantidad,NOW())";
								# code...

								if (consultaSQL($sql,$conexion))
								{
									$sql = "UPDATE `venta` SET `Saldo`='$saldo1' WHERE `FolioVta` = '$FolioVta'";

												if (consultaSQL($sql,$conexion))
											{
if ($saldo1 == 0) {
$sql = "UPDATE `venta` SET `Estatus`='Cerrada' WHERE `FolioVta` = '$FolioVta'";

if (consultaSQL($sql,$conexion))
{
?>
																				
																				
																				<div id="agregar" class="alert alert-success">
																					<h2 align="center">El abono de $<?php echo $cantidad1 ?> se ha agregado satisfactoriamente y se ha concluido la venta</h2>
																				<div class="derecha"><br>
																					<button class="btn btn-warning"><a href="../Usuarios/<?php echo $log ?>/DashBoard/DVAbono.php">Regresar</a></button>
																					<button class="btn btn-success"><a href="CuponAbono.php?folio=<?php echo $FolioVta ?>" target="_blank">Imprimir comprobante de pago</a></button>
																				</div>
																				</div>

																				<?php														

																				
																				} else {

																					echo '<script language="javascript">alert("Se ha agregado el abono Satisfactoriamente");
																								window.location.history.go(-2)";
																								</script>'; 
																					# code...
																				}

																							
																					} else {

																									// echo '<script language="javascript">alert("Se ha agregado el abono Satisfactoriamente");
																									// 			window.history.go(-1);
																									// 			</script>'; 
	 																							?>

																							<div id="agregar" class="alert alert-success">
	 																							<h2 align="center">El abono de $<?php echo $cantidad1 ?> se ha agregado satisfactoriamente</h2>
	 																							<div class="derecha"><br>
																								<button class="btn btn-warning"><a href="../Usuarios/<?php echo $log ?>/DashBoard/DVAbono.php">Regresar</a></button>
																								<button class="btn btn-success"><a href="CuponAbono.php?folio=<?php echo $FolioVta ?>" target="_blank">Imprimir comprobante de pago</a></button>
																								</div>
																							</div>




																						
																						
																					
																				</body>
																				</html>


																				<?php 
																									# code...
																								}
																}
											}else 
												{
													echo '<script language="javascript">alert("Se ha agregado ");
																	window.history.back(-2);
																	</script>'; 
												}
														# code...
														# code...
													}

	cerrar($conexion);
 } else {

 	'<script language="javascript">alert("No se ha reccibido ninguna Cantidad");
		window.location.href="../index.html";
		</script>'; 
 	# code...
 }
 
 }else{
	
	echo '<script language="javascript">alert("No se ha iniciado ninguna sesion");
		window.location.href="../index.html";
		</script>'; 
}
 ?>