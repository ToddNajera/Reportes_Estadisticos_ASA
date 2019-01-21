<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: En esta se muestra un vista previa del pdf antes de ser impreso.
*/
//incluimos la plantilla para el pdf
include 'G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';
include "G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/Funciones/funciones_php.php";
$mesIN=$_POST['mes_reporte'];
$yearEJER=$_POST['year_reporte'];
$Totales_SAT=explode(',',$_POST['Totales_SAT']);
$Totales_CTAGASTOS=explode(',',$_POST['Totales_CTAGASTOS']);
$Totales_POLIZAS=explode(',',$_POST['Totales_POLIZAS']);
$MesIN=convertir_num_mes($mesIN);

//Se agregan los datos de coneccion para la base de datos
//include 'C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/PDFs/mc_table.php';
//var_dump($_POST['Totales_CTAGASTOS']);
//var_dump($Totales_CTAGASTOS);
$pdf=new PDF_MC_Table();//generamos una nueva tabla
$pdf->AddPage('L','');
$pdf->Titutlo_Tabla_UM($MesIN,$yearEJER);
$pdf->Crear_Tabla_Totales_UM($Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS);
$pdf->Crear_Tabla_Diferencias_UM($Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS);
$pdf->Output();


?>
