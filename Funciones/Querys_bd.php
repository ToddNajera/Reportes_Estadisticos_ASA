<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: Estan son todas las consultas que se utilizan para generar el reporte estadistico
Tablas_bd: Polizas, Cuentas_Gastos, Cfdi_sat
*/
/*Consulta por mes en cfdi_sat*/$query_SAT='SELECT * FROM cfdi_sat WHERE MONTH(fecha) BETWEEN "'.$mes.'" AND "'.$mes2.'"';
/*Consulta por mes en poliza*/$query_POLIZA="";
/*Consulta por mes en cuentas_gastos*/$query_CTAGASTOS="";
?>
