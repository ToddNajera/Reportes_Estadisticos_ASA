<?php
include "G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\Funciones\Querys_bd.php";
/*
Autor:Porras Najera Miguel Najera.
Descripcion: Estan son las diversas funciones de uso en el programa.
*/

/************************************************************FUNCIONES PARA EL ESTADISTICO DE UN MES***********************************************************/
/*
Esta funcion es para obtener los totales de la tabla cfdi_sat
*/
function obtener_TOTALES_SAT($sqldb,$dba,$mesCN,$yearBD){
  $subtutotal_TOTAL="";
  $iva_Total="";
  $totalf_TOTAL="";
  $sql=$sqldb[0].$mesCN.$sqldb[1].$mesCN.$sqldb[2].$yearBD.$sqldb[3];

  $Resultado = $dba->query($sql);
  while( $row = $Resultado->fetch_assoc() ){
    $subtutotal_TOTAL=$subtutotal_TOTAL+$row['subtotal'];
    $iva_Total=$iva_Total+$row['impuesto'];
    $totalf_TOTAL=$totalf_TOTAL+$row['total'];
  }
  return $TOTALES = array($subtutotal_TOTAL,$iva_Total,$totalf_TOTAL);
}

/*
Esta funcion es para obtener los totales de la tabla cuentas gastos
*/
function obtener_TOTALES_CTAGASTOS($sqldb,$dba,$mesCN,$yearBD){
  $subtutotal_TOTAL="";
  $iva_Total="";
  $totalf_TOTAL="";
  $sql=$sqldb[0].$mesCN.$sqldb[1].$mesCN.$sqldb[2].$yearBD.$sqldb[3];
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
function obtener_TOTALES_POLIZA($sqldb_iva,$sqldb_ig,$dba,$mesCN,$yearBD){
  $subtutotal_TOTAL="";
  $iva_Total="";
  $totalf_TOTAL="";
  $sql_iva=$sqldb_iva[0].$mesCN.$sqldb_iva[1].$mesCN.$sqldb_iva[2].$yearBD.$sqldb_iva[3];
  $Resultado_iva = $dba->query($sql_iva);
  while( $row = $Resultado_iva->fetch_assoc() ){
    $iva_Total=$iva_Total+$row['abono'];
  }
  $sql_ig=$sqldb_ig[0].$mesCN.$sqldb_ig[1].$mesCN.$sqldb_ig[2].$yearBD.$sqldb_ig[3];
  $Resultado_ig = $dba->query($sql_ig);
  while( $row = $Resultado_ig->fetch_assoc() ){
    $subtutotal_TOTAL=$subtutotal_TOTAL+$row['abono'];
  }
  $totalf_TOTAL=$subtutotal_TOTAL+$iva_Total;
  return $TOTALES = array($subtutotal_TOTAL,$iva_Total,$totalf_TOTAL);
}

/*
MUESTRA LOS DATOS DEL MESES
*/
function muestra_DATOS_MES($mes_EJERCICIO,$Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS){
  /*EL REPORTEADOR ESTA CONTEMPLANDO CASO UN SOLO MES*/
  echo '
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>SUMAS TOTALES DEL MES</th>
      </tr>
    </thead>
    <tr>
      <th scope="row">'.$mes_EJERCICIO.'</th>
      <td>CFDIs SAT</td>
      <td>POLIZAS INGRESOS</td>
      <td>CUENTAS DE GASTOS</td>
      </tr>
      ';
  $array_Titulos = array("Total sin IVA","Total IVA","Total Facturas");
  for($i=0 ;$i < sizeof($Totales_SAT); $i++ ){
    echo '
    <tr>
      <th>'.$array_Titulos[$i].'</th>
      <td>$'.$Totales_SAT[$i].'</td>
      <td>$'.$Totales_POLIZAS[$i].'</td>
      <td>$'.$Totales_CTAGASTOS[$i].'</td>
    </tr>
    ';
  }
}

function muestra_DIFERENCIAS_MES($mes_EJERCICIO,$Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS){
  /*EL REPORTEADOR ESTA CONTEMPLANDO CASO UN SOLO MES*/
  echo '
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">DIFERENCIAS TOTALES DEL MES</th>
      </tr>
    </thead>
    <tr>
      <th scope="row">TOTALES</th>
      <td>CFDIs SAT</td>
      <td>POLIZAS INGRESOS</td>
      <td>CUENTAS DE GASTOS</td>
      </tr>
      ';
  $array_Titulos = array("CFDIs SAT","POLIZAS INGRESOS","CUENTAS DE GASTOS");
  $array_Totales= array($Totales_SAT[2],$Totales_POLIZAS[2],$Totales_CTAGASTOS[2]);
  for($i=0 ;$i < sizeof($array_Totales); $i++ ){
    echo '
    <tr>
      <th scope="row">'.$array_Titulos[$i].'</th>
      <td>$'.(intval($array_Totales[$i])-intval($Totales_SAT[2])).'</td>
      <td>$'.(intval($array_Totales[$i])-intval($Totales_POLIZAS[2])).'</td>
      <td>$'.(intval($array_Totales[$i])-intval($Totales_CTAGASTOS[2])).'</td>
    </tr>
    ';
  }
}
/************************************************************FUNCIONES GENERALES***********************************************************************/
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
/*funcion que convierte de numero a letra el mes*/
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

function getMonth_Num($mes) {

 switch ($mes) {
  case "ENERO"  : $month_numero = 1; break;
  case "FEBRERO": $month_numero = 2; break;
  case "MARZO"  : $month_numero = 3; break;
  case "ABRIL"  : $month_numero = 4; break;
  case "MAYO"   : $month_numero = 5; break;
  case "JUNIO"  : $month_numero = 6; break;
  case "JULIO"  : $month_numero = 7; break;
  case "AGOSTO" : $month_numero = 8; break;
  case "SEPTIEMBRE": $month_numero = 9; break;
  case "OCTUBRE": $month_numero = 10; break;
  case "NOVIEMBRE" : $month_numero = 11; break;
  case "DICIEMBRE" : $month_numero = 12; break;
 }
 return ($month_numero);
}
/************************************************************FUNCIONES PARA EL ESTADISTICO DE VARIOS MESES***********************************************/

function mostrar_TOTALES_CFDI($query_SAT,$dbARA,$mes_ConsultaIN,$mes_ConsultaFN,$yearBD){
 $mesIN=$mes_ConsultaIN;
 $mesFN=$mes_ConsultaFN;
 echo '
 <table class="table">
   <thead class="thead-dark">
     <tr>
       <th>CUENTAS CFDI`s SAT</th>
     </tr>
   </thead>
   <tr>
   <td></td>
     <td>Total sin IVA</td>
     <td>Total IVA</td>
     <td>Total Facturas</td>
     </tr>
   ';
  for($mesIN ; $mesIN<=$mesFN ; $mesIN++){
    $ResultadoMES=obtener_TOTALES_SAT($query_SAT,$dbARA,$mesIN,$yearBD);
    echo'
    <tr>
      <th>'.convertir_num_mes($mesIN).'</th>
      <td>$'.$ResultadoMES[0].'</td>
      <td>$'.$ResultadoMES[1].'</td>
      <td>$'.$ResultadoMES[2].'</td>
    </tr>
    ';
    }
    echo '</table><br/>';
  }

  /*ESTA FUNCION ES PARA MOSTRAR LOS TOTALES DE CTAGASTOS*/
  function mostrar_TOTALES_CTAGASTOS($query_CTAGASTOS,$dbARA,$mes_ConsultaIN,$mes_ConsultaFN,$yearBD){
   $mesIN=$mes_ConsultaIN;
   $mesFN=$mes_ConsultaFN;
   echo '
   <table class="table">
     <thead class="thead-dark">
       <tr>
         <th>CUENTAS DE GASTOS</th>
       </tr>
     </thead>
     <tr>
     <td></td>
       <td>Total sin IVA</td>
       <td>Total IVA</td>
       <td>Total Facturas</td>
       </tr>
     ';
    for($mesIN ; $mesIN<=$mesFN ; $mesIN++){
      $ResultadoMES=obtener_TOTALES_CTAGASTOS($query_CTAGASTOS,$dbARA,$mesIN,$yearBD);
      echo'
      <tr>
        <th>'.convertir_num_mes($mesIN).'</th>
        <td>$'.$ResultadoMES[0].'</td>
        <td>$'.$ResultadoMES[1].'</td>
        <td>$'.$ResultadoMES[2].'</td>
      </tr>
      ';
      }
      echo '</table><br/>';
    }

    /*ESTA FUNCION ES PARA MOSTRAR LOS TOTALES DE POLIZA*/
    function mostrar_TOTALES_POLIZA($query_POLIZA_IG,$query_POLIZA_IMP,$dbARA,$mes_ConsultaIN,$mes_ConsultaFN,$yearBD){
     $mesIN=$mes_ConsultaIN;
     $mesFN=$mes_ConsultaFN;
     echo '
     <table class="table">
       <thead class="thead-dark">
         <tr>
           <th>POLIZA DE INGRESO</th>
         </tr>
       </thead>
       <tr>
       <td></td>
         <td>Total sin IVA</td>
         <td>Total IVA</td>
         <td>Total Facturas</td>
         </tr>
       ';
      for($mesIN ; $mesIN<=$mesFN ; $mesIN++){
        $ResultadoMES=obtener_TOTALES_POLIZA($query_POLIZA_IMP,$query_POLIZA_IG,$dbARA,$mesIN,$yearBD);
        echo'
        <tr>
          <th>'.convertir_num_mes($mesIN).'</th>
          <td>$'.$ResultadoMES[0].'</td>
          <td>$'.$ResultadoMES[1].'</td>
          <td>$'.$ResultadoMES[2].'</td>
        </tr>
        ';
        }
        echo '</table><br/>';
      }

?>
