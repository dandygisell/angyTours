 <?php
require('../fpdf/fpdf.php');
require('Conexion.php');
$conexion = conectarse();


 $fecha = $_GET["fechaInicio"];
 $fechaFinal = $_GET["fechaFinal"];

 $query = "SELECT * FROM pagov WHERE `FechaExpedicion` BETWEEN '$fecha' AND '$fechaFinal'";
 $validar = mysql_query($query);
 $resultado = mysql_num_rows($validar);
 if ($resultado == 0) {

 	echo '<script language="javascript">alert("No hay datos para el reporte.");
					window.location.href="javascript:history.back(1)";
					</script>';
 	
 } else {
 
 
class PDF extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=6*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		
		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,6,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}

function Header()
{

	$this->SetFont('Arial','',10);
	$this->Text(20,10,"Reporte de Ventas",0,'C', 0);
	$this->Ln(30);
}

function Footer()
{
	$this->SetY(-15);
	$this->SetFont('Arial','B',8);
	$this->Cell(100,10,'Angytours Reporte de Ventas ',0,0,'L');

}

}

	// $paciente= $_GET['id'];
	// $con = new DB;
	// $pacientes = $con->conectar();	
	
	// $strConsulta = "SELECT * from Cliente ";
	
	// $pacientes = mysql_query($conexion,$strConsulta);
	
	// $fila = mysql_fetch_array($pacientes);

	$pdf=new PDF('L','mm','Letter');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->setY(10);
	$pdf->setX(100);
	$pdf->Cell(60,8,"Este reporte de ventas corresponde a las siguentes fechas: ",0,1);
	$pdf->setX(120);
	$pdf->Cell(60,8,"del ".$fecha."al ".$fechaFinal,0,0);
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(10);

 //    $pdf->SetFont('Arial','',12);
 //    $pdf->Cell(0,6,'Clave: '.$fila['idViajero'],0,1);
	// $pdf->Cell(0,6,'Nombre: '.$fila['Nombre'].' '.$fila['Direccion'].' '.$fila['Telefono'],0,1);
	// $pdf->Cell(0,6,'Sexo: '.$fila['Correo'],0,1); 
	// $pdf->Cell(0,6,'Domicilio: '.$fila['Correo'],0,1); 
	
	// $pdf->Ln(10);
	
	$pdf->SetWidths(array(15, 55, 60, 40, 35,35,18));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(85,107,47);
    $pdf->SetTextColor(255);
    $pdf->SetY(20);
    $pdf->setX(5);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('Folio', 'Cliente', 'Vendedor', 'Fecha de Compra', 'Importe','Neto','Tipo'));
			}
	
	// $strConsulta  = "SELECT * FROM venta WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
	$strConsulta = "SELECT 
		FolioPago as Folio,
		CantPago as Importe,
		FechaExpedicion as Fecha,
		`usuarios`.`nombre` as Vendedor,
		`cliente`.`nombre` as Cliente,
		`pagov`.`Tipo`,
		Neto

		FROM pagov
		LEFT JOIN venta ON (`pagov`.`FolioVenta` = `Venta`.`FolioVta`) 
		LEFT JOIN usuarios ON (`venta`.`IdUsuario` = `usuarios`.`idUsuario`) 
		left join cliente on (`venta`.`idViajero`=`cliente`.`idViajero`)
		ORDER BY FechaCompra DESC";
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(5);
			
			if($i%2 == 1)
			{
				$pdf->SetFillColor(153,255,153);
    			$pdf->SetTextColor(0);
    			$pdf->Row(array($fila['Folio'], utf8_decode($fila['Cliente']), utf8_decode($fila['Vendedor']), $fila['Fecha'],$fila['Importe'],$fila['Neto'], $fila['Tipo']));
				
			}
			else
			{
				$pdf->SetFillColor(102,204,51);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['Folio'], utf8_decode($fila['Cliente']), utf8_decode($fila['Vendedor']), $fila['Fecha'],$fila['Importe'],$fila['Neto'], $fila['Tipo']));
			}
		}
		$sql = "SELECT SUM(neto) AS Ventas FROM pagov WHERE `FechaExpedicion` BETWEEN '$fecha' AND '$fechaFinal'";
		$sql2 = "SELECT SUM(CantPago) AS Ventas FROM pagov WHERE `FechaExpedicion` BETWEEN '$fecha' AND '$fechaFinal'";
		$resultado = mysql_query($sql);		
		while ($datos = @mysql_fetch_assoc($resultado) ){

								$total = $datos['Ventas'];
							}
							$resultado2 = mysql_query($sql2);		
		while ($datos2 = @mysql_fetch_assoc($resultado2) ){

								$total2 = $datos2['Ventas'];
							}
							$pdf->setX(135);
							$pdf->Cell(40,8,utf8_decode("Totales : "),0,0);
							$pdf->Cell(30,8,$total2,0,0);
							$pdf->setX(211);
							$pdf->Cell(30,8,$total,0,0);
								


$pdf->Output();
}
?>