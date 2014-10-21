<?php
require('../fpdf/fpdf.php');
require('Conexion.php');
$conexion = conectarse();
$FolioGrupo = $_GET["FolioGrupo"];
 

		$query = "SELECT * FROM ventagrupo WHERE FolioGrupo = '$FolioGrupo'";
 $validar = mysql_query($query) or die(mysql_error());
 $resultado = mysql_num_rows($validar);



 if ($resultado == 0) {

 	echo '<script language="javascript">alert("No hay datos para el reporte.");
					window.location.href="javascript:history.back(1)";
					</script>';
 } else {

 while ($datos = @mysql_fetch_assoc($validar) ){

								$FolioGrupo = $datos['FolioGrupo'];
								$idViajero = $datos['idViajero'];
								$FechaIn = $datos['FechaIn'];
								$FechaOut = $datos['FechaOut'];
								$NombreGrupo = $datos['NombreGrupo'];
								$Descripcion = $datos['Descripcion'];
								$CostoTotal = $datos['CostoTotal'];
								$CantLetras = $datos['CantLetras'];
								$Saldo = $datos['Saldo'];
								$FechaCompra = $datos['FechaCompra'];
								$IdUsuario = $datos['IdUsuario'];
								$OperadoraMay = $datos['OperadoraMay'];
								$estatus = $datos['Estatus'];
								$idhotel = $datos['IdHotel'];
							}

							$sql3 = "SELECT * FROM catalogo1 WHERE foliocatalogo = '$idhotel'";

						$resultado3= @mysql_query($sql3) or die(mysql_error());

						while ($datos3 = @mysql_fetch_assoc($resultado3) ){

								$nombreHotel = $datos3["nombrehotel"];

								
							}

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
	$this->Text(20,10,"Angytours Rooming List",0,'C', 0);
	$this->Ln(30);
}

function Footer()
{
	$this->SetY(-15);
	$this->SetFont('Arial','B',8);
	$this->Cell(100,10,'Angytours Rooming List ',0,0,'L');

}

}
$pdf=new PDF("L");
	$pdf->Open();
	$pdf->AddPage();
	$pdf->setY(10);
	$pdf->setX(100);
	$pdf->Cell(60,8,"Rooming List Correspondiente a: ",0,1);
	$pdf->setX(120);
	$pdf->Cell(60,8,"Grupo ".utf8_decode($NombreGrupo)." al ". utf8_decode($nombreHotel)." del ".$FechaIn." al ".$FechaOut,0,0);
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(10);
	$pdf->setX(8);

	$pdf->SetWidths(array(8, 80, 15, 20, 20,15, 75, 50));
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(85,107,47);
    $pdf->SetTextColor(255);

		for($i=0;$i<1;$i++)
			{

				$pdf->Row(array('Hab', 'Pasajeros','TipoHab','Entrada','Salida','Adultos','Menores','Observaciones',));
			}
	
	$strConsulta = "SELECT 
	NumeroHab as Hab,
	 NombreTitular as Pasajeros,
	  NombreA as NombreA,
	   Menores as Menores,
	    Observaciones as Observaciones,
	     TipoHab as TipoHab,
	     EdadesMenores as Edades,
	    	cantAdultos as Adultos,
	    	`ventagrupo`.`FechaIn` as Entrada,
	    	`ventagrupo`.`FechaOut` as Salida
	       FROM cuponesgrupo LEFT JOIN ventagrupo ON `cuponesgrupo`.`FolioGrupoC` = `ventagrupo`.`FolioGrupo`
		where FolioGrupoC = '$FolioGrupo'";
	
	$historial = mysql_query($strConsulta) or die(mysql_error());
	$numfilas = mysql_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','',8);
			$pdf->setX(8);
			
			if($i%2 == 1)
			{
				$pdf->SetFillColor(153,255,153);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['Hab'],
				 utf8_decode($fila['Pasajeros']."/".$fila['NombreA']),
				 utf8_decode($fila['TipoHab']),
				  utf8_decode($fila['Entrada']),
				   utf8_decode($fila['Salida']),
				   utf8_decode($fila['Adultos']),
				   utf8_decode($fila['Menores']." / ".$fila['Edades']),
				   utf8_decode($fila['Observaciones'])
				   ));
			}
			else
			{
				$pdf->SetFillColor(102,204,51);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['Hab'],
				 utf8_decode($fila['Pasajeros']."/".$fila['NombreA']),
				 utf8_decode($fila['TipoHab']),
				  utf8_decode($fila['Entrada']),
				   utf8_decode($fila['Salida']),
				   utf8_decode($fila['Adultos']),
				   utf8_decode($fila['Menores']." / ".$fila['Edades']),
				   utf8_decode($fila['Observaciones'])
				   ));
			}
		}
		
			$pdf->Output('Rooming List '.utf8_decode($NombreGrupo).'pdf','D'); 

}
?>