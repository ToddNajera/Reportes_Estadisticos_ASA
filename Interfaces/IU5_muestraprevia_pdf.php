<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: En esta se muestra un vista previa del pdf antes de ser impreso.
*/
//incluimos la plantilla para el pdf
include 'G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';
include "G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\ConexionBD\ConexionARANCELSA.php";
$mesIN=$_POST['mes_reporte_1'];
$yearEJER=$_POST['year_reporte'];
$mesFN=$_POST['mes_reporte_2'];

$MesIN=convertir_num_mes($mesIN);
$MesFN=convertir_num_mes($mesFN);

//Se agregan los datos de coneccion para la base de datos
//include 'C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';
//var_dump($_POST['Totales_CTAGASTOS']);
//var_dump($Totales_CTAGASTOS);
$pdf=new PDF_MC_Table();//generamos una nueva tabla
$pdf->AddPage('L','');
$pdf->Titulo_Tabla_VM($MesIN,$MesFN,$yearEJER);
$pdf->Contenido_Tabla_VM_SAT($mesIN,$mesFN,$yearEJER,$dbARA,$query_SAT);
$pdf->AddPage('L','');
$pdf->Titulo_Tabla_VM($MesIN,$MesFN,$yearEJER);
$pdf->Contenido_Tabla_VM_CTA($mesIN,$mesFN,$yearEJER,$dbARA,$query_CTAGASTOS);
$pdf->AddPage('L','');
$pdf->Titulo_Tabla_VM($MesIN,$MesFN,$yearEJER);
$pdf->Contenido_Tabla_VM_POLZ($mesIN,$mesFN,$yearEJER,$dbARA,$query_POLIZA_IMP,$query_POLIZA_IG);
$pdf->Output();
?>
