<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: En esta interfaz se muestra el resultado en manera de tabla donde se muestran los datos obtenidos
de las distintas tablas.
*/
$fechaIN_Consulta=explode("-",$_POST['mes']);
$fechaFN_Consulta=explode("-",$_POST['mes2']);
$mes_ConsultaIN=$fechaIN_Consulta[1];
$mes_ConsultaFN=$fechaFN_Consulta[1];

if($fechaIN_Consulta[0]==$fechaFN_Consulta[0]){
    $year_Consulta=$fechaIN_Consulta[0];
  }
  else {
    $year_Consulta="0";
  }
include "G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\Funciones\Querys_bd.php";
include "G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/Funciones/funciones_php.php";
include "G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\ConexionBD\ConexionARANCELSA.php";
/*include "C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/Funciones/Querys_bd.php";
include "C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/Funciones/funciones_php.php";
include "C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/ConexionBD/ConexionARANCELSA.php";
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
  <head>
    <meta charset="utf-8">
    <title>Polizas de Impuestos CAAAREM3</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <class="navbar-brand" href="#"><img src="imagenes/Logo_mail.jpg" alt="logo1" width="250" height="60" border="1"/>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Inicio</a></li>
              <li><a href="#">Acerca de nosotros</a></li>
              <li><a href="#">Contacto</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" >
        <h3>CONCILIACIÓN CFDIS SAT-ARANCEL</h3>
        <?php
        /*EL REPORTEADOR ESTA CONTEMPLANDO QUE SE DESEE EL REPORTE DE MAS DE UN MES*/

         ?>

      </div>
    </div>

  </body>
</html>