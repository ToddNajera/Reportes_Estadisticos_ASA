<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: En esta interfaz se muestra el resultado en manera de tabla donde se muestran los datos obtenidos
de las distintas tablas.
*/
include "G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/Funciones/funciones_php.php";
$mes_ConsultaIN=getMonth_Num($_POST['MES']);
$mes_ConsultaFN=getMonth_Num($_POST['MES2']);//es de un solo mes la consulta
$year_Consulta=$_POST['YEAR'];
include "G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\ConexionBD\ConexionARANCELSA.php";

/*include "C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/Funciones/Querys_bd.php";
include "C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/Funciones/funciones_php.php";
include "C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/ConexionBD/ConexionARANCELSA.php";
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

        mostrar_TOTALES_CFDI($query_SAT,$dbARA,$mes_ConsultaIN,$mes_ConsultaFN,$year_Consulta);
        mostrar_TOTALES_CTAGASTOS($query_CTAGASTOS,$dbARA,$mes_ConsultaIN,$mes_ConsultaFN,$year_Consulta);
        mostrar_TOTALES_POLIZA($query_POLIZA_IG,$query_POLIZA_IMP,$dbARA,$mes_ConsultaIN,$mes_ConsultaFN,$year_Consulta);
         ?>
         <?php
         echo '<form action="IU3_muestraprevia_pdf.php"><input type="button" value="VOLVER" name="volver atrás2" onclick="history.back()" />';
         echo '<input type="button" value="IMPRIMIR" name="volver atrás2"/></form>';
         ?>
       </div>
     </div>
   </body>
</html>
