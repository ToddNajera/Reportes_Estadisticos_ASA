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
  $totalf_TOTAL=$subtutotal_TOTAL+$iva_Total;
  return $TOTALES = array($subtutotal_TOTAL,$iva_Total,$totalf_TOTAL);
}


function muestra_DATOS_MES($mes_EJERCICIO,$array_TOTALES){
  echo '
  <tr>
    <th scope="row">MES</th>
    <td>'.$mes_EJERCICIO.'</td>
  </tr>
  ';
  $array = array("Total ", "bar", "hello");
  for($i=0 ;$i <= sizeof($array_TOTALES); $i++ ){
    echo '
    <tr>
      <th scope="row">MES</th>
      <td>'.$mes_EJERCICIO[$i].'</td>
    </tr>
    ';
  }

}

function convertir_num_mes($num_mes){
  $mes="";
  switch ($num_mes) {
    case 1:
        return $mes="ENERO";
        break;
    case 2:
        return $mes="FEBRERO";
        break;
    case 3:
        return $mes="MARZO";
        break;
    case 4:
        return $mes="ABRIL";
        break;
    case 5:
        return $mes="MAYO";
        break;
    case 6:
        return $mes="JUNIO";
        break;
    case 7:
        return $mes="JULIO";
        break;
    case 8:
        return $mes="AGOSTO";
        break;
    case 9:
        return $mes="SEPTIEMBRE";
        break;
    case 10:
        return $mes="OCTUBRE";
        break;
    case 11:
        return $mes="NOVIEMBRE";
        break;
    case 12:
        return $mes="DICIEMBRE";
        break;
  }
}

?>
