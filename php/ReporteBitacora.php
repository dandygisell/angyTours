 <?php
require('../fpdf/fpdf.php');
require('Conexion.php');
$conexion = conectarse();

 $fecha = $_GET["fechaInicio"];
 $fechaFinal = $_GET["fechaFinal"];

 $query = "SELECT * FROM venta WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
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

	
	$pdf->SetWidths(array(15, 60, 55, 50, 60));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(85,107,47);
    $pdf->SetTextColor(255);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('Folio', 'Cliente', 'Vendedor', 'Fecha de Compra','Importe de la Venta' ));
			}

	$strConsulta = "SELECT FolioVta as Folio, cantidadTotal as Importe,FechaCompra as Fecha,`usuarios`.`nombre` as Vendedor,`cliente`.`nombre` as Cliente FROM venta LEFT JOIN usuarios ON (`venta`.`idUsuario` = `usuarios`.`idUsuario`) left join cliente on (`venta`.`idViajero`=`cliente`.`idViajero`)
		where EstatusP = 'Cerrado' AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal') ORDER BY FechaCompra DESC";
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','',10);
			
			if($i%2 == 1)
			{
				$pdf->SetFillColor(153,255,153);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['Folio'], utf8_decode($fila['Cliente']), utf8_decode($fila['Vendedor']), $fila['Fecha'],$fila['Importe']));
			}
			else
			{
				$pdf->SetFillColor(102,204,51);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['Folio'], utf8_decode($fila['Cliente']), utf8_decode($fila['Vendedor']), $fila['Fecha'],$fila['Importe']));
			}
		}
		$sql = "SELECT SUM(CantidadTotal) AS Ventas FROM venta WHERE (`EstatusP`= 'Cerrado') AND (`FechaCompra` BETWEEN '$fecha' AND '$fechaFinal')";
		$resultado = mysql_query($sql);		
		while ($datos = @mysql_fetch_assoc($resultado) ){

								$total = $datos['Ventas'];
							}
							$pdf->setX(200);
							$pdf->Cell(60,8,utf8_decode("Total de ventas : ").$total,'LRB',0);
							
$pdf->Output('Reporte '.$fecha.' al '.$fechaFinal.'.pdf','D'); 
}
?>