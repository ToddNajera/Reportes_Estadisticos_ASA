<?php
//Se agregan los datos de coneccion para la base de datos
//incluimos la plantilla para el pdf
include 'G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';
//include 'C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';
$MesIN="ENERO";
$MesFN="DICIEMBRE";
$yearEJER="2018";

$Totales_SAT="";
$Totales_CTAGASTOS="";
$Totales_POLIZAS="";

$pdf=new PDF_MC_Table();//generamos una nueva tabla
$pdf->AddPage('L','');
$pdf->Titutlo_Tabla_UM($MesIN,$yearEJER);
$pdf->Crear_Tabla_Totales_UM($Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS);
$pdf->Crear_Tabla_Diferencias_UM($Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS);
$pdf->Output();

?>
