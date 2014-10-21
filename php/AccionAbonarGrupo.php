<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$FolioGrupo = $_SESSION["auxFolioGrupo"];
$cobrador = $_SESSION['id'];
$log = $_SESSION['tipo'];
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

	$cantidad = $_POST["cantidad"];

	$_SESSION["cant"] = $cantidad;


	$sql = "SELECT * FROM `ventagrupo` WHERE `FolioGrupo` = '$FolioGrupo'";
					$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								
								$FolioGrupo = $datos['FolioGrupo'];
								$idViajero = $datos['idViajero'];
								$FechaIn = $datos['FechaIn'];
								$FechaOut = $datos['FechaOut'];
								$NombreGrupo = $datos['NombreGrupo'];
								$Descripcion = $datos['Descripcion'];
								$CostoTotal = $datos['CostoTotal'];
								// $CantidadVariable = $datos['CantidadVariable'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaCompra = $datos['FechaCompra'];
								$IdUsuario = $datos['IdUsuario'];
								$OperadoraMay = $datos['OperadoraMay'];
								$estatus = $datos['Estatus'];
							}


							$saldo1 = $Saldo - $cantidad;

							if ($saldo1 < 0) {

								echo '<script language="javascript">alert("El pago es superior a la cantidad de pago");
																	window.history.back();
																	</script>'; 

								
							} else {	
								$sql = "INSERT INTO `abonargrupo` (`FolioAbono`, `FolioGrupo`, `FechaAbono`,`IdUsuario`, `Cantidad`) 
								VALUES (NULL,'$FolioGrupo',NOW(),'$cobrador','$cantidad')";
								# code...

								if (consultaSQL($sql,$conexion))
								{
									$sql = "UPDATE `ventagrupo` SET `Saldo`='$saldo1' WHERE `FolioGrupo` = '$FolioGrupo'";

												if (consultaSQL($sql,$conexion))
											{
												

																		if ($saldo1 == 0) {
																			$sql = "UPDATE `ventagrupo` SET `Estatus`='Cerrada' WHERE `FolioGrupo` = '$FolioGrupo'";

																			if (consultaSQL($sql,$conexion))
																			{
																				?>
																				
																				
																				<div id="agregar" class="alert alert-success">
																					<h2 align="center">El abono de $<?php echo $cantidad ?> y se ha agregado satisfactoriamente y se ha concluido la venta</h2>
																				<div class="derecha"><br>
																					<button class="btn btn-warning"><a href="../Usuarios/<?php echo $log ?>/DashBoard/DGAbonar.php">Regresar</a></button>
																					<button class="btn btn-success"><a href="imprimirCAGrupo.php?folio=<?php echo $FolioGrupo ?>" target="_blank">Imprimir comprobante de pago</a></button>
																				</div>
																				</div>

																				<?php
																				// echo '<script language="javascript">alert("Se ha agregado el abono y la venta se ha cerrado");
																				// 		window.history.go(-1);
																				// 		</script>'; 
																	

																				
																				} else {

																					echo '<script language="javascript">alert("Se ha agregado el abono Satisfactoriamente");
																								window.history.go(-1);
																								</script>'; 
																					# code...
																				}

																							
																					} else {

																						?>

																							<div id="agregar" class="alert alert-success">
	 																							<h2 align="center">El abono de $<?php echo $cantidad ?> se ha agregado satisfactoriamente</h2>
	 																							<div class="derecha"><br>
																								<button class="btn btn-warning"><a href="../Usuarios/<?php echo $log ?>/DashBoard/DGAbonar.php">Regresar</a></button>
																								<button class="btn btn-success"><a href="imprimirCAGrupo.php?folio=<?php echo $FolioGrupo ?>" target="_blank">Imprimir comprobante de pago</a></button>
																								</div>
																							</div>




																						
																						
																					
																				</body>
																				</html>


																				<?php 

																									// echo '<script language="javascript">alert("Se ha agregado el abono Satisfactoriamente");
																									// 			window.history.go(-1);
																									// 			</script>'; 
																									# code...
																								}
																}
											}else 
												{
													echo '<script language="javascript">alert("Se ha agregado ");
																	window.location.href="../index.html";
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