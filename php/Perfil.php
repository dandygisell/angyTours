<?php 
session_start();
require_once 'Conexion.php';
require_once 'Biblioteca.php';
$conexion = conectarse();
$log = $_SESSION['tipo'];
$id = $_SESSION['id'];
if($_SESSION['logged'] == 'yes')
{
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Editar Perfil</title>
<link rel="stylesheet" href="../css/bordesT.css">
<link rel="shortcut icon" href="../imagenes/iconoAngy.ico" />
<link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body>



<div id="agregar" class="alert alert-success">
<h2 align="center" id="datos0">Editar Perfil</h2>
<h2 align="center" id="datos1" ></h2>
</div>

  <div class="portlet-content">

    <form action="#" method="" id="perfil">
      <input type="hidden" value="<?php echo $id; ?>" name="usr" id="usr">

      <label for="usuario" class="" > Nombre de Usuario: </label>
      <input type="text" class="form-control" name="usuario" id="id" style="width:260px;" required>
                                
      <label for="username" class="uname" > Nombre Personal: </label>
      <input type="text" class="form-control" placeholder="Nombre Personal" name="nombre" id="nombre" style="width:260px;" required>
                                
      <label for="password" class="youpasswd" > Contraseña: </label>
      <input type="password" class="form-control" placeholder="Contraseña" name="pass" id="pass"style="width:260px;" required> 
               

      <label for="username" class="uname"> Teléfono Personal: </label>
      <input type="tel" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" style="width:260px;" required maxlength="10">
                                
      <label for="username" class="uname" > Correo Electrónico: </label>
      <input type="email" class="form-control" placeholder="Email" name="correo" id="correo" style="width:260px;" required>
      <br><br>

      <div class="derecha"><br>
        <button class="btn btn-success"><a href="../Usuarios/<?php echo $log ?>/DashBoard/DVentas.php">Regresar</a></button>
        <button type="button" id="commit"class="confirm btn btn-succes">Guardar</button>
      </div>
                                  
    </form>
  </div>

<script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/jquery-ui-1.10.4.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.confirm.min.js"></script>
<script src="../js/perfil.js"></script>

</body>
<?php
 }else{
	
	echo '<script language="javascript">alert("No se ha iniciado ninguna sesion");
		window.location.href="../index.html";
		</script>'; 
}
 ?>