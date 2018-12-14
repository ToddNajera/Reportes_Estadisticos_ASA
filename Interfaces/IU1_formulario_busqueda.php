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
       <p>Seleccione el mes del cual quiere generar un reporte</p>

         <form action="IU2_resultado_consulta.php" method="post">
           <input type="month" name="mes"><br/ >
           <br/><input type="submit" name="entrar" value="CONTINUAR"></input>
         </from><!--Fin del formulario-->
     </div><!--Fin del formulario de polizas -->

    </div>

  </body>
</html>
