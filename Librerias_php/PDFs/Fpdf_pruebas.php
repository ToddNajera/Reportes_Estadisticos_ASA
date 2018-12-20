<?php
//Se agregan los datos de coneccion para la base de datos
include 'G:\WampServer\www\ProyectoArancel_2018\ReporteadorCFDI\utilerias_php\config_db.php';
include 'G:\WampServer\www\ProyectoArancel_2018\ReporteadorCFDI\utilerias_php\conexion.php';
//incluimos la plantilla para el pdf
require('mc_table.php');


$pdf=new PDF_MC_Table();//generamos una nueva tabla
$pdf->AddPage('L','');
$pdf->SetFont('Arial','',10);

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(43,30,55,30,30,18,18,18,16,16));// se declara el arreglo donde estan las longitudes de los segmentos de la tabla

//pruebas de conexion conla base de datos
$Tdate='03';
$query ="SELECT folio_fiscal, rfc,razon,fecha_emision, fecha_certificado,subtotal,impuesto,total,efecto,estado FROM cfdi_sat
   WHERE emitido='1' AND estado='Cancelado'AND  MONTH(fecha_emision) =".$Tdate;
$resultado = $dba->query($query);



while ($row = $resultado->fetch_assoc() ) {
  //se le dan los datos que se van a insertar en la tabla

  $pdf->Row(array($row['folio_fiscal'],$row['rfc'],$row['razon'],$row['fecha_emision'],$row['fecha_certificado'],"$".$row['subtotal'],"$".$row['impuesto'],"$".$row['total'],$row['efecto'],$row['estado']));

}

$pdf->Output();

?>
