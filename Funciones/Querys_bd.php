<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: Estan son todas las consultas que se utilizan para generar el reporte estadistico
Tablas_bd: Polizas, Cuentas_Gastos, Cfdi_sat
*/
/*Consulta por mes en cfdi_sat*/$query_SAT='SELECT * FROM cfdi_sat WHERE efecto="Ingreso" AND MONTH(fecha_emision) BETWEEN "'.$mes1_Consulta.'" AND "'.$mes2_Consulta.'" AND YEAR(fecha_emision)="'.$year_Consulta.'"';
/*Consulta por mes en poliza*/$query_POLIZA='SELECT * FROM poliza WHERE tipo="Ig" AND MONTH(fecha) BETWEEN "'.$mes1_Consulta.'" AND "'.$mes2_Consulta.'" AND YEAR(fecha)="'.$year_Consulta.'"';
/*Consulta por mes en cuentas_gastos*/$query_CTAGASTOS='SELECT * FROM cuentas_gastos WHERE MONTH(fecha) BETWEEN "'.$mes1_Consulta.'" AND "'.$mes2_Consulta.'" AND YEAR(fecha)="'.$year_Consulta.'" ';

?>
