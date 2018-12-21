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

function obtener_TOTALES_SAT($sql){

}
?>
