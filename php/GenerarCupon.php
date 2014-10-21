<?php
session_start(); 

$FolioVta = $_SESSION["FolioVta"];
require_once 'Conexion.php';
require_once 'Biblioteca.php';
require('../fpdf/fpdf.php');
$conexion = conectarse();



$clasula = "SERVICIOS NO UTILIZADOS NO SON REEMBOLSABLES. CONDICIONES 1.-ESTE CUPÓN ES VÁLIDO EN EL HOTEL POR EL IMPORTE DE LAS NOCHES PAGADAS, PARA LAS FECHAS Y BAJO LAS CONDICIONES EXPRESAMENTE ESTIPULADAS, NO ES REEMBOLSABLE Y EN CASO DE CANCELACIÓN SE OBSERVARAN LAS POLÍTICAS ESTABLECIDAS POR EL HOTEL PAGADO. 2.-DECLARA LA AGENCIA QUE SE DEDICA A REPRESENTA HOTELES, ELABORAR, ORGANIZAR Y LLEVAR A CABO PROYECTOS, PLANES O ITINERARIOS TURÍSTICOS, RESERVANDO ESPACIOS EN MEDIOS DE TRANSPORTE Y HOTELES, EXPIDIENDO A FAVOR DEL CLIENTE LOS BOLETOS O CUPONES CORRESPONDIENTES ACTUANDO ÚNICAMENTE COMO INTERMEDIARIOS ENTRE EL CLIENTE Y LAS PERSONAS FÍSICAS O MORALES, PROPORCIONADORES DE DICHOS SERVICIOS Y QUE CUENTAN CON CAPACIDAD TÉCNICA Y ADMINISTRATIVA, MATERIALES Y HUMANOS NECESARIOS PARA CONTRATAR POR CUENTA DEL CLIENTE EL SERVICIO QUE SE PREFIERE. 3.- EL CLIENTE DECLARA QUE TIENE LA CAPACIDAD JURÍDICA PARA CONTRATAR Y QUE TIENE INTERÉS EN ADQUIRIR EL PAQUETE QUE SE ESPECIFICA EN EL ANVERSO O EL PRESENTE INSTRUMENTO, EN LOS TÉRMINOS Y CONDICIONES QUE EN EL MISMO SE ESTIPULA. 4.- EN CASO DE CANCELACIONES IMPUTABLES CLIENTE (ÚNICAMENTE EN TEMPORADA BAJA) ESTE PAGARA EL 25% DEL COSTO DEL SERVICIO TURÍSTICO, SI HACE LA CANCELACIÓN DE 20 AL 16 DÍAS ANTES DE LA SALIDA, EL 50% DEL COSTO DEL SERVICIO TURÍSTICO DE 15 A 10 DÍAS ANTES DE LA FECHA DE SALIDA, NO SE ACEPTAN CANCELACIONES FALTANDO MENOS DE 10 DÍAS ANTES DE LA FECHA DE SALIDA. 5.- EN TEMPORADA ALTA Y PUENTES NO SE PERMITEN CANCELACIONES NI CAMBIOS, YA QUE GENERA CARGO DE TODAS LAS NOCHES SOLICITADAS, QUEDANDO SIN VALIDES LA CLÁUSULA 4. 6.-LA AGENCIA DECLARA QUE ACTÚA COMO COMISIONISTA DE LOS PROPIETARIOS O CONTRATISTAS, QUE PROPORCIONAN LOS MEDIOS DE CONTRATACIÓN, TRANSPORTACIÓN, ALOJAMIENTO, Y DEMÁS SERVICIOS, POR LO QUE EL CLIENTE SETA DE ACUERDO EN QUE NI LA AGENCIA Y SU REPRESENTANTES SERÁN RESPONSABLES DE LOS SERVICIOS, DE LA PERDIDA, LESIÓN, DAÑOS A PERSONAS Y PROPIEDADES QUE PUDIERAN PRESENTARSE POR PARTE DEL PROPIETARIO O CONTRATISTA CORRESPONDIENTE NO IMPUTABLES A LA AGENCIA. 7.-LEIDO EL PRESENTE CONTRATO DE CONFORMIDAD LAS PARTES SE SUJETAN PARA SU PRESENTACIÓN Y CUMPLIMIENTO EN PRIMERA INSTANCIA, LA JURISDICCIÓN Y COMPARECENCIA DE LA PROCURADURÍA DEL CONSUMIDOR Y EN SEGUNDA INSTANCIA A LOS TRIBUNALES DE LA CIUDAD DE MÉRIDA, YUCATÁN RENUNCIANDO A CUALQUIER OTRO FUERO QUE LES PUDIERA CORRESPONDER POR RAZÓN DE DOMICILIO O NACIONALIDAD, SEÑALANDO COMO SUS DOMICILIOS LOS QUE QUEDAN INDICADOS EN EL PRESENTE DOCUMENTO. 8.-EL CUPÓN CONTENIDO EN ESTA CUBIERTA ESTA EXPEDIDO POR ANGYTOURS EN SU CALIDAD DE AGENTE DE HOTELES POR LO TANTO NO ASUME RESPONSABILIDAD POR PERDIDA, DAÑOS, RETRASOS, ACCIDENTES O IRREGULARIDADES QUE PUDIERAN OCURRIR, AL SER PROPORCIONADOS LOS SERVICIOS A LOS QUE SE REFIEREN EN ESTE CUPÓN. PARA CUALQUIER ACLARACIÓN DEBERÁ PRESENTAR ESTE DOCUMENTO.
";

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
	$this->SetFont('Arial','B',8);
	// Movernos a la derecha
	$this->SetY(4);
	$this->Cell(150);

	// Título
	$this->Cell(60,5,'Comprobante de compra',0,2,'C');
	$this->Ln(20);
}

// Pie de página
function Footer()
{
	// Posición: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Número de página
	$this->Cell(0,10,'Page '.$this->PageNo().'/Comprobante de compra',0,0,'C');
}
	function SetCol($col)
{
    // Establecer la posición de una columna dada
    $this->col = $col;
    $x = 10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}
function ChapterBody($file)
{
    // Abrir fichero de texto
    $txt = file_get_contents($file);
    // Fuente
    $this->SetFont('Times','',12);
    // Imprimir texto en una columna de 6 cm de ancho
    $this->MultiCell(60,5,$txt);
    $this->Ln();
    // Cita en itálica
    $this->SetFont('','I');
    $this->Cell(0,5,'(fin del extracto)');
    // Volver a la primera columna
    $this->SetCol(0);
}
}
$sql = "SELECT * FROM venta WHERE FolioVta = '$FolioVta'";

$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$FolioVta = $datos['FolioVta'];
								$idViajero = $datos['idViajero'];
								$IdUsuario = $datos['IdUsuario'];
								$Descripcion = $datos['Descripcion'];
								$CantidadTotal = $datos['CantidadTotal'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaViaje = $datos['FechaViaje'];
								$FechaCompra = $datos['FechaCompra'];
								$estatus = $datos['Estatus'];
							}


							$sql = "SELECT * FROM cliente WHERE idViajero = '$idViajero'";

						$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$nombre = $datos["Nombre"];
								
							}
							$sql = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuario'";

						$resultado= @mysql_query($sql) or die(mysql_error());

						while ($datos = @mysql_fetch_assoc($resultado) ){

								$nombreU = $datos["Nombre"];
								
							}

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


					$pdf = new PDF();
					$pdf->AddPage();

					$pdf->Image('../imagenes/logo.jpg',40,15,33);
					// Arial bold 15
					$pdf->SetFont('Arial','B',8);
					// Movernos a la derecha
					$pdf->SetY(12);
					$pdf->Cell(80);

					// Título
					$pdf->Cell(60,5,'Angytours',0,2,'C');
					$pdf->Cell(60,5,'Calle 59J # 565 X 110 y 112 Col Bojorquez',0,2,'C');
					$pdf->Cell(60,5,'Tel: (999)9-12-28-95 | Cel: (044)99-92-44-54-14',0,2,'C');
					$pdf->Cell(60,5,'Correo: angeviajes@hotmail.com',0,2,'C');
					$pdf->Cell(60,5,'RFC: PELA620129L36',0,2,'C');
					$pdf->SetFont('Arial','',10);
					$pdf->SetY(35);
					$pdf->SetX(140);
					$pdf->Cell(40,8,utf8_decode("Fecha: ").utf8_decode($dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ),0,1);
					$pdf->SetY(45);
					$pdf->SetX(20);					
					$pdf->Cell(130,8,utf8_decode("Cliente : ").utf8_decode($nombre),1,0);
					$pdf->Cell(30,8,utf8_decode("Folio : ").$FolioVta,1,1);
					$pdf->SetX(20);				
					$pdf->Cell(60,8,utf8_decode("Cantidad : ").$CantidadTotal,1,0,'L');
					$pdf->MultiCell(100,8,utf8_decode("Importe Letras : ").$CantLetras,1,1);					
					$pdf->SetX(20);
					
					$pdf->MultiCell(160,8,utf8_decode("Descripción : ").utf8_decode($Descripcion),1,'J');					
					$pdf->SetX(20);
					$pdf->Cell(100,14,utf8_decode("Le atendio : ").utf8_decode($nombreU),1,0);
					$pdf->Cell(60,14,utf8_decode("Firma : "),1,2);

					$pdf->SetY(225);

					$pdf->SetX(20);
					$pdf->SetFont('Arial','B',4);


					$pdf->MultiCell(160,3,utf8_decode($clasula),0,'J');


					///Segundo Cupón
					 $pdf->AddPage();
					 $pdf->Image('../imagenes/logo.jpg',40,15,33);
					// Arial bold 15
					$pdf->SetFont('Arial','B',8);
					// Movernos a la derecha
					$pdf->SetY(12);
					$pdf->Cell(80);

					// Título
					$pdf->Cell(60,5,'Angytours',0,2,'C');
					$pdf->Cell(60,5,'Calle 59J # 565 X 110 y 112 Col Bojorquez',0,2,'C');
					$pdf->Cell(60,5,'Tel: (999)9-12-28-95 | Cel: (044)99-92-44-54-14',0,2,'C');
					$pdf->Cell(60,5,'Correo: angeviajes@hotmail.com',0,2,'C');
					$pdf->Cell(60,5,'RFC: PELA620129L36',0,2,'C');
					$pdf->SetFont('Arial','',10);
					$pdf->SetY(35);
					$pdf->SetX(140);
					$pdf->Cell(40,8,utf8_decode("Fecha: ").utf8_decode($dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ),0,1);
					$pdf->SetY(45);
					$pdf->SetX(20);					
					$pdf->Cell(130,8,utf8_decode("Cliente : ").$nombre,1,0);
					$pdf->Cell(30,8,utf8_decode("Folio : ").$FolioVta,1,1);
					$pdf->SetX(20);				
					$pdf->Cell(60,8,utf8_decode("Cantidad : ").$CantidadTotal,1,0,'L');
					$pdf->MultiCell(100,8,utf8_decode("Importe Letras : ").$CantLetras,1,'L');					
					$pdf->SetX(20);
					
					$pdf->MultiCell(160,8,utf8_decode("Descripción : ").utf8_decode($Descripcion),1,'J');					
					$pdf->SetX(20);
					$pdf->Cell(100,14,utf8_decode("Le atendio : ").utf8_decode($nombreU),1,0);
					$pdf->Cell(60,14,utf8_decode("Firma : "),1,2);

					$pdf->SetY(225);

					$pdf->SetX(20);
					$pdf->SetFont('Arial','B',4);


					$pdf->MultiCell(160,3,utf8_decode($clasula),0,'J');
					$pdf->Output('venta '.$FolioVta.' cli '.$nombre.'.pdf','D');

 cerrar($conexion);
 ?>


