<?php 
session_start();
require_once'Conexion.php';
$Conexion = conectarse();
$usuario = $_SESSION["id"];

if (isset($_POST["folioventa"])) {

	$folioventa = $_POST["folioventa"];
	$operadora = $_POST["operadora"];
	$concepto = $_POST["concepto"];
	$cantPago = $_POST["cantPago"];
	$comision = $_POST["comision"];
	$neto = $_POST["neto"];
	$cantLetras = $_POST["cantLetras"];
	$Tipo = "Individual";



	$sql = "SELECT FolioVenta FROM pagov WHERE FolioVenta = '$folioventa'";
	$result = mysql_query($sql);
	$validar = mysql_num_rows($result);
	if ($validar != 0) {

	

	echo '<script language="javascript">alert("La venta ya ha sido pagada");             		
	             		window.history.go(-1);
						</script>';
} else {


	$sql = "INSERT INTO `pagov`(`FolioPago`, `FolioVenta`, `CantPago`, `FechaExpedicion`, `Operadora`, `Concepto`, `idUsuario`, `CantLetras`, `neto`, `comision` ,`Tipo`)
	             VALUES (NULL,'$folioventa','$cantPago',NOW(),'$operadora','$concepto','$usuario','$cantLetras','$neto','$comision','$Tipo')";

	             if (consultaSQL($sql,$Conexion)) {

	             	$rs = mysql_query("SELECT @@identity AS id");
					if ($row = mysql_fetch_row($rs)) {
					$id = trim($row[0]);
					}
					$_SESSION["foliopago"] = $id;

					$aux = "Cerrado";

					$modificar = "UPDATE `venta` SET `EstatusP`='$aux' WHERE FolioVta = '$folioventa' ";

					$query = mysql_query($modificar,$Conexion);

	             	echo '<script language="javascript">alert("Se ha agregado el abono Satisfactoriamente");
	             		window.location.href="Resultado_Imprimir.php";
						</script>';
	             } else {

	             	echo '<script language="javascript">alert("Ocurrio un error");
						</script>';
	             }
	}} else {

		 echo "No se ha recibido algun dato";
	}
cerrar($Conexion);
?>