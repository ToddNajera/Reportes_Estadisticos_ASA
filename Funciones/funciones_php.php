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


?>
