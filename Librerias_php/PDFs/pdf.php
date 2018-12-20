<?php
//primero agregamos tanto la plantilla como la conexcion a la base de datos
include 'G:\WampServer\www\ProyectoArancel_2018\ReporteadorCFDI\plantilla_Rep_CFDI.php';
include 'G:\WampServer\www\ProyectoArancel_2018\ReporteadorCFDI\utilerias_php\config_db.php';
include 'G:\WampServer\www\ProyectoArancel_2018\ReporteadorCFDI\utilerias_php\conexion.php';

//ahora empezamos creando la plantilla
$pdf = new PDF();
$pdf->AddPage('L','Letter');

$query = "SELECT folio_fiscal, rfc,razon,fecha_emision, fecha_certificado,subtotal,impuesto,total,efecto,estado FROM cfdi_sat
 WHERE emitido='1' ";
$resultado = $dba->query($query);
//echo $dba->host_info;
//echo $resultado['folio_fiscal'];
/*
while ($row = $resultado->fetch_assoc() ) {

  $pdf->SetFont('Arial','',9);
  $folio =$row['folio_fiscal'];
  $pdf->SetX(5);
  $pdf->Cell(43,10,$folio,1,'C');
  $pdf->Cell(30,10,$row['rfc'],1,0,'C');

  $pdf->Cell(55,10,$row['razon'],1,'C');



  $pdf->Cell(30,10,$row['fecha_emision'],1,'C');
  $pdf->Cell(30,10,$row['fecha_certificado'],1,'C');
  $pdf->Cell(16,10,"$".$row['subtotal'],1,0,'C');
  $pdf->Cell(18,10,"$".$row['impuesto'],1,0,'C');
  $pdf->Cell(16,10,"$".$row['total'],1,0,'C');
  $pdf->Cell(16,10,$row['efecto'],1,0,'C');
  $pdf->Cell(16,10,$row['estado'],1,1,'C');


}
*/

$pdf->Output();
?>
