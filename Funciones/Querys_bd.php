<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: Estan son todas las consultas que se utilizan para generar el reporte estadistico
Tablas_bd: Polizas, Cuentas_Gastos, Cfdi_sat
*/
/*Consulta por mes en cfdi_sat*/$query_SAT='SELECT * FROM cfdi_sat WHERE efecto="Ingreso" AND estado="Vigente" AND emitido=1 AND MONTH(fecha_emision) BETWEEN "'.$mes_ConsultaIN.'" AND "'.$mes_ConsultaFN.'" AND YEAR(fecha_emision)="'.$year_Consulta.'"';
/*Consulta por mes en poliza*/$query_CTAGASTOS='SELECT * FROM cuentas_gastos WHERE `status`="I" AND MONTH(fecha) BETWEEN "'.$mes_ConsultaIN.'" AND "'.$mes_ConsultaFN.'" AND YEAR(fecha)="'.$year_Consulta.'"AND folio_fiscal!="" ';
/*Consulta por mes en cuentas_gastos*/$query_POLIZA_IG='SELECT * FROM poliza WHERE tipo="Ig" AND MONTH(fecha) BETWEEN "'.$mes_ConsultaIN.'" AND "'.$mes_ConsultaFN.'" AND YEAR(fecha) ="'.$year_Consulta.'"  AND auxiliar LIKE "4100-001-%"';
/*Consulta por mes de cuenta de gastos iva*/$query_POLIZA_IMP='SELECT * FROM poliza WHERE tipo="Ig" AND MONTH(fecha) BETWEEN "'.$mes_ConsultaIN.'" AND "'.$mes_ConsultaFN.'" AND YEAR(fecha) ="'.$year_Consulta.'" AND auxiliar LIKE "2180-001-%"';


?>
.
