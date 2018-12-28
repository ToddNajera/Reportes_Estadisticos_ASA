<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: Estan son todas las consultas que se utilizan para generar el reporte estadistico
Tablas_bd: Polizas, Cuentas_Gastos, Cfdi_sat
*/
/*Consulta por mes en cfdi_sat*/$query_SAT='SELECT * FROM cfdi_sat WHERE efecto="Ingreso" AND MONTH(fecha_emision) BETWEEN "'.$fechaIN_Consulta[1].'" AND "'.$fechaFN_Consulta[1].'" AND YEAR(fecha_emision)="'.$year_Consulta.'"';
/*Consulta por mes en poliza*/$query_POLIZA='SELECT * FROM poliza WHERE tipo="Ig" AND MONTH(fecha) BETWEEN "'.$fechaIN_Consulta[1].'" AND "'.$fechaFN_Consulta[1].'" AND YEAR(fecha)="'.$year_Consulta.'" AND ';
/*Consulta por mes en cuentas_gastos*/$query_CTAGASTOS_IG='SELECT * FROM cuentas_gastos WHERE MONTH(fecha) BETWEEN "'.$fechaIN_Consulta[1].'" AND "'.$fechaFN_Consulta[1].'" AND YEAR(fecha) ="'.$year_Consulta.'" AND folio_fiscal!="" AND auxiliar LIKE "4100-001-%"';
/*Consulta por mes de cuenta de gastos iva*/$query_CTAGASTOS_IG='SELECT * FROM cuentas_gastos WHERE MONTH(fecha) BETWEEN "'.$fechaIN_Consulta[1].'" AND "'.$fechaFN_Consulta[1].'" AND YEAR(fecha) ="'.$year_Consulta.'" AND folio_fiscal!="" AND auxiliar LIKE "2180-001-%"';


?>
