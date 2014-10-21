<?php 
session_start();
$usuario = $_SESSION["user"];
require_once'Conexion.php';
$Conexion = conectarse();

if (isset($_POST["folioventa"])) {

	$folioventa = $_POST["folioventa"];
	$operadora = $_POST["operadora"];
	$concepto = $_POST["concepto"];
	$cantPago = $_POST["cantPago"];
	$comision = $_POST["comision"];
	$neto = $_POST["neto"];
	$cantLetras = $_POST["cantLetras"];
	$Tipo = "Grupo";

	$sql = "INSERT INTO `pagov`(`FolioPago`, `FolioVenta`, `CantPago`, `FechaExpedicion`, `Operadora`, `Concepto`, `idUsuario`, `CantLetras`, `neto`, `comision`,`Tipo`)
	             VALUES (NULL,'$folioventa','$cantPago',NOW(),'$operadora','$concepto','$usuario','$cantLetras','$neto','$comision','$Tipo')";

	             if (consultaSQL($sql,$Conexion)) {

	             	$rs = mysql_query("SELECT @@identity AS id");
					if ($row = mysql_fetch_row($rs)) {
					$id = trim($row[0]);
					}
					$_SESSION["foliopago"] = $id;

					$aux = "Cerrado";

					$modificar = "UPDATE `ventagrupo` SET `EstatusP`='$aux' WHERE FolioGrupo = '$folioventa' ";

					$query = mysql_query($modificar,$Conexion);

	             	echo '<script language="javascript">alert("Se ha agregado el abono Satisfactoriamente");
	             		window.location.href="CuponPagoImprimir.php";
						</script>'; 
				} else {

	             	echo '<script language="javascript">alert("Ocurrio un error");
						</script>'; 
	            }
} else {

	echo "No se ha recibido algún dato";
}

cerrar($Conexion);
?>