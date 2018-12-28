<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: Estan son las diversas funciones de uso en el programa.
*/
/*
Esta funcion sirve como auxiliar al momento de hacer las consultas en la base de datos por mes
*/
function siguiente_mes($fechaIN,$fechaFN){
  $mesAux=$fechaIN;
  if($mesAux<$fechaFN){
    $mesAux=$mesAux+1;
    return $mesAux;
  }
  else {
    return "0";
  }
}
/*
Esta funcion es para obtener los totales de la tabla cfdi_sat
*/
function obtener_TOTALES_SAT($sql,$dba){
  $subtutotal_TOTAL="";
  $iva_Total="";
  $totalf_TOTAL="";

  $Resultado = $dba->query($sql);
  while( $row = $Resultado->fetch_assoc() ){
    $subtutotal_TOTAL=$subtutotal_TOTAL+$row['subtotal'];
    $iva_Total=$iva_Total+$row['impuestos'];
    $totalf_TOTAL=$totalf_TOTAL+$row['total'];
  }

  return $TOTALES = array($subtutotal_TOTAL,$iva_Total,$totalf_TOTAL);
}

/*
Esta funcion es para obtener los totales de la tabla cuentas gastos
*/
function obtener_TOTALES_CTAGASTOS($sql,$dba){
  $subtutotal_TOTAL="";
  $iva_Total="";
  $totalf_TOTAL="";

  $Resultado = $dba->query($sql);
  while( $row = $Resultado->fetch_assoc() ){
    $subtutotal_TOTAL=$subtutotal_TOTAL+$row['base_iva'];
    $iva_Total=$iva_Total+$row['iva_total'];
    $totalf_TOTAL=$totalf_TOTAL+$row['total_factura'];
  }

  return $TOTALES = array($subtutotal_TOTAL,$iva_Total,$totalf_TOTAL);
}

/*
Esta funcion es para obtener los totales de la tabla cuentas gastos
*/
function obtener_TOTALES_POLIZA($sql_iva,$sql_ig,$dba){
  $subtutotal_TOTAL="";
  $iva_Total="";
  $totalf_TOTAL="";

  $Resultado_iva = $dba->query($sql_iva);
  while( $row = $Resultado_iva->fetch_assoc() ){
    $iva_Total=$iva_Total+$row['cargo'];
  }

  $Resultado_ig = $dba->query($sql_ig);
  while( $row = $Resultado_ig->fetch_assoc() ){
    $subtutotal_TOTAL=$subtutotal_TOTAL+$row['cargo'];
  }

  return $TOTALES = array($subtutotal_TOTAL,$iva_Total,$totalf_TOTAL);
}

?>
