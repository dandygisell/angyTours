<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$log = $_SESSION["tipo"];

$folioGrupo = $_GET["folio"];

$sql = "SELECT * FROM ventagrupo WHERE `FolioGrupo` = '$folioGrupo'";

$resultado = mysql_query($sql) or die(mysql_error());

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
$sql1 = "SELECT * FROM cliente WHERE idViajero = '$idViajero'";

$resultado1 = mysql_query($sql1) or die(mysql_error());
while ($datos1 = @mysql_fetch_assoc($resultado1) ){

	$nombreCli = $datos1['Nombre'];
}


$_SESSION['FolioAux'] = $folioGrupo;

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Pasajeros Grupo</title>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
	<link rel="stylesheet" href="../css/bordesT.css">

</head>
<body>

<figure style="text-align: center;">
	<img src="../imagenes/Angy.png" alt="" style="width:50px;" >
	<h3>Agregar Cupones Grupo</h3>
</figure>

<div id="informacion">
<input type="hidden" id="FolioGrupo"value="<?php echo $FolioGrupo ?>">
<div class="derecha">
<?php  echo "<button class='btn btn-warning'><a href=\"../Usuarios/".$log."/DashBoard/DGCupon.php\">Regresar</a></button>" ?> 
<button id="btn_nuevaEmpresa" class="btn btn-success" data-toggle="modal" data-target="#modal_empresa">Agregar nuevo pasajero</button>
<button id="btn_rooming" class="btn btn-info" >Imprimir Rooming</button>

</div>
<div id="datos_grupo" style="text-align:top; width: 950px; display: inline-block;"class="bg-warning">


<div class="caja"> <label for="">Nombre del Grupo:</label> <br> <?php echo $NombreGrupo ?>
</div>
<div class="caja"> <label for="">Fecha de Viaje :</label><br><?php echo "Entrada ".$FechaIn." / Salida : ".$FechaOut; ?>
</div>
<div class="caja"> <label for="">Coordinador :</label><br><?php echo $nombreCli ?>
</div>

</div>
<!-- Ventana modal -->
 <div class="modal fade" id="modal_empresa">	
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" align="center">Nuevo pasajero</h3>
      </div>
      <div class="modal-body">
        <!-- Mi formulario -->
        <form action="" id="cupon1">
    <input type="hidden" class="form-control" id="FolioGrupo" readonly name="FolioGrupo"value="<?php echo $folioGrupo; ?>">
	<label for="">Número de Habitación</label><input type="text" class="form-control" name="numeroH" placeholder="Número de Habitación">
	<label for="">Cantidad Adultos</label><input type="number" class="form-control" name="cantAdultos">
	<label for="">Pasajeros</label><input type="text" class="form-control" name="NombreT" placeholder="Titular de Reservación"> / <input type="text" class="form-control" name="NombreA" placeholder="Segundo Pasajero / Tercer Pasajero">
	<label for="">Cantidad Menores</label><input type="number" class="form-control" name="cantMenores">
	<label for="">Menor 1</label><input type="text" class="form-control" name="Menor1" placeholder="Primer Menor">
	<label for="">Menor 2</label><input type="text" class="form-control" name="Menor2" placeholder="Segundo Menor / Tercer Menor">
	<label for="">Edades Menores</label><input type="Text" class="form-control" name="EdadesMenores" placeholder=" 0 y 0 años respectivamente">
	<label for="">Tipo de Habitación</label>
	<select  class="form-control" name="TipoHab"> 
		<option value="Doble">Doble</option>
	    <option value="Sencilla">Sencilla</option>		
		<option value="Triple">Triple</option>
		<option value="Cuadruple">Cuadruple</option>		
	</select>

	<label for="">Observaciones:</label>
	<textarea class="form-control" name="Obs" cols="50" rows="3" placeholder="Ingresar Observaciones"></textarea>
	<br>
	<div class="derecha">
		
	</div>	
	</form>

        
        <!-- Termina mi Formulario -->
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      	<button type="button" class="enviar btn btn-info" id="btn_regresar">Agregar</button>
        
         
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- FInal Ventana modal -->

<div id="load" style="display: none;"><img src="imagenes/loading.gif" alt=""></div>

        <table id="lista_Tablas" class="table">
     <thead>
        <th>Número de Hab</th>
        <th>Titular</th>
        <th>Acompañante</th>
        <th>Menor 1</th>
        <th>Tipo de Hab</th>
        <th>Observaciones</th>
        
        
      </thead>
      <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
         <td></td>
          <td></td>
           <td></td>
      </tbody>
    </table>

</div>

<div id="pax"></div>



	

	<script src="../js/jquery-1.11.0.js"> </script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/appPax.js"> </script>	
</body>
</html>
<style>
	.caja
	{
		display: inline-block;
		width: 300px;
		text-align: top;
	}
</style>