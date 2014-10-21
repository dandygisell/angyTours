<?php
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$log = $_SESSION["tipo"];

if(isset($_POST["cliente"]))
{
	$cliente =$_POST["cliente"];
	$total =$_POST["total"];
	$importe =$_POST["importe"];
	$descripcion =$_POST["descripcion"];
    $usuario =$_SESSION["user"];
    $estatus = "Abierta";
    $estatusP = "Pendiente";
    $fechaViaje = $_POST["FechaInn"];
    $fechaRegreso = $_POST["FechaOut"];
    $idViajero = $_POST["idViajero"];

    $IdUsuario =$_SESSION["id"];


$qValidar = mysql_query("SELECT * FROM cliente WHERE Nombre = '$cliente'") or die(mysql_error());






	$resultado = mysql_num_rows($qValidar);


	if ($log=="Gerente") {
		if ($resultado==0)
	{

		echo '<script language="javascript">alert("El usuario no se encuentra registrado");
		window.location.href="../Usuarios/Gerente/DashBoard/DRegistrar.php";
		</script>'; 
		
	} else {
   

		$sql = "INSERT INTO `venta`(`FolioVta`, `idViajero`, `IdUsuario`, `Descripcion`, `CantidadTotal`, `CantLetras`, `Saldo`, `FechaViaje`, `FechaRegreso`, `FechaCompra`, `Estatus`, `EstatusP`) 
		VALUES (NULL,'$idViajero','$IdUsuario','$descripcion','$total','$importe','$total','$fechaViaje','$fechaRegreso',NOW(),'$estatus','$estatusP')";
		        

		if (consultaSQL($sql,$conexion))
		{

		$rs = mysql_query("SELECT @@identity AS FolioVta");
					if ($row = mysql_fetch_row($rs)) {
					$id = trim($row[0]);

					// echo $id;
					$_SESSION["FolioVta"] = $id;
				}
			// header("ReciboNuevaVenta.php");

			echo '<script language="javascript">alert("La Venta se ha registrado correctamente");
				window.location.href="ReciboNuevaVenta.php";
					</script>';

			
		 // echo "Datos Agregados correctamente";
		}
		else 
		{
			echo '<script language="javascript">alert("correctamente");
				window.location.href="ReciboNuevaVenta.php";
					</script>'; 
		}
	}
		# code...
	} else {
		if ($resultado==0)
	{

		echo '<script language="javascript">alert("El usuario no se encuentra registrado");
		window.location.href="../Usuarios/Agente/DashBoard/DRegistrar.php";
		</script>'; 
		
	} else {
   

		$sql = "INSERT INTO `venta`(`FolioVta`, `idViajero`, `IdUsuario`, `Descripcion`, `CantidadTotal`, `CantLetras`, `Saldo`, `FechaViaje`, `FechaRegreso`, `FechaCompra`, `Estatus`, `EstatusP`) 
		VALUES (NULL,'$idViajero','$IdUsuario','$descripcion','$total','$importe','$total','$fechaViaje','$fechaRegreso',NOW(),'$estatus','$estatusP')";
		        

		if (consultaSQL($sql,$conexion))
		{

		$rs = mysql_query("SELECT @@identity AS FolioVta");
					if ($row = mysql_fetch_row($rs)) {
					$id = trim($row[0]);

					// echo $id;
					$_SESSION["FolioVta"] = $id;
				}
			// header("ReciboNuevaVenta.php");

			echo '<script language="javascript">alert("La Venta se ha registrado correctamente");
				window.location.href="ReciboNuevaVenta.php";
					</script>';

			
		 // echo "Datos Agregados correctamente";
		}
		else 
		{
			echo '<script language="javascript">alert("correctamente");
				window.location.href="ReciboNuevaVenta.php";
					</script>'; 
		}
	}
		# code...
	}
	

	
}
cerrar($conexion);

?>