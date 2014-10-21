<?php 
if(isset($_POST['nombre'])) 
{  // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias 
$email_to = "angeluna1423@gmail.com"; 
$email_subject = "Contacto desde el sitio web";  


// Aquí se deberían validar los datos ingresados por el usuario 

if(!isset($_POST['nombre']) || 
!isset($_POST['correo']) || 
!isset($_POST['mensaje'])) {  

echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />"; 
echo "Por favor, vuelva atrás y verifique la información ingresada<br />"; 
die(); }  
$email_message = "Detalles del formulario de contacto:\n\n"; 
$email_message .= "Nombre: " . $_POST['nombre'] . "\n";  
$email_message .= "E-mail: " . $_POST['correo'] . "\n"; 
$email_message .= "Comentarios: " . $_POST['mensaje'] . "\n\n";   // Ahora se envía el e-mail usando la función mail() de PHP 

$headers = 'From: '.$_POST[email]."\r\n". 
'Reply-To: '.$_POST[email]."\r\n" . 
'X-Mailer: PHP/' . phpversion(); 
@mail($email_to, $email_subject, $email_message, $headers);
echo '<script language="javascript">alert("`Su mensaje ha sido enviado con exito, Gracias");
					window.location.href="../";
					</script>';   
//PARA REDIRECCIONAR AL FORMULARIO DE NUEVO PUEDES USAR ESTAS DOS FORMAS:

//echo "<a href='formulario.php'>REGRESAR >></a>";
//echo "<META HTTP-EQUIV=Refresh CONTENT='2; URL=formulario.php'>";

 } ?>