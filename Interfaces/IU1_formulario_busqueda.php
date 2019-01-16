<?php
/*
Autor:Porras Najera Miguel Najera.
Descripcion: En esta interfas se muestra un fomulaio para generar las consultas bajo criterios especificos
del usuario
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
  <head>
    <meta charset="utf-8">
    <title>Polizas de Impuestos CAAAREM3</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- INICIA EL CODIGO JAVASCRIPT-->
  <script  type="text/javascript">
  /*
  Dependiendo de la respuesta dada en el formulario la redireeccion es a UI1 O UI4 por diferente
  tipo de reporte
  */
  function activar_formularios(){
    alert("I am an alert box!");
    }
  </script>
<!-- FIN EL CODIGO JAVASCRIPT-->
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

      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" ><!--Inicio del Formulacio-->
       <h3>CONCILIACIÓN CFDIS SAT-ARANCEL</h3>
       <p>Seleccione si desea generar reporte de un solo mes o de varios meses a la vez</p>
       <form id="formulario_seleccion">
          <input onclick="return activar_formularios();" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
          <label class="form-check-label" for="inlineRadio1">POR MES</label>
          <input onclick="return activar_formularios();" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
          <label class="form-check-label" for="inlineRadio2">VARIOS MESES</label>
        </form>

        <div id="Formularios">

        </div>


        <!--Fin del SELECCION DE FORMULARIO-->
     </div><!--Fin del formulario de polizas -->

    </div>

  </body>
</html>
