<?php
//Se agregan los datos de coneccion para la base de datos
//incluimos la plantilla para el pdf
include 'G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';

$MesIN="ENERO";
$MesFN="DICIEMBRE";
$yearEJER="2018";


$pdf=new PDF_MC_Table();//generamos una nueva tabla
$pdf->AddPage('L','');
$pdf->SetFont('Arial','',10);
$pdf->titulo_tabla($MesIN,$MesFN,$yearEJER);
$pdf->Output();

?>
