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
    <meta charset="utf-8" content="width=device-width, initial-scale=1" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" >
<!--************************************************INICIO del SELECCION DE FORMULARIO para un solo mes****************************************************************************-->
       <h3>CONCILIACIÓN CFDIS SAT-ARANCEL</h3>
       <p>Seleccione si desea generar reporte de un solo mes o de varios meses a la vez</p>
       <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo">UN MES</button>
       <div id="demo" class="collapse">
         <form action="IU2_resultado_consulta.php" method="post" >
           <div class="form-group">
             <label for="mes">Seleciona un mes</label>
             <select class="form-control" id="mes" name="mes">
               <option>ENERO</option>
               <option>FEBRERO</option>
               <option>MARZO</option>
               <option>ABRIL</option>
               <option>MAYO</option>
               <option>JUNIO</option>
               <option>JULIO</option>
               <option>AGOSTO</option>
               <option>SEPTIEMBRE</option>
               <option>OCTUBRE</option>
               <option>NOVIEMBRE</option>
               <option>DICIEMBRE</option>
             </select>
             <label for="año">Seleciona año de ejercicio</label>
             <select class="form-control" id="año" name="year">
               <option>2018</option>
               <option>2019</option>
               <option>2020</option>
               <option>2021</option>
               <option>2022</option>
               <option>2023</option>
             </select>
           </div>
           <input type="submit" name="entrar" value="CONTINUAR"></input>
         </form>
        </div>
      </br>
      </br>
<!---***********************************************Fin del SELECCION DE FORMULARIO para un solo mes**************************************************************************-->
<!--************************************************INICIO del SELECCION DE FORMULARIO para varios meses**********************************************************************-->
        <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo2">VARIOS MESES</button>
        <div id="demo2" class="collapse">
          <form action="IU4_resultado_consultas_varias.php" method="post" >
            <div class="form-group">
              <label for="MES">Seleciona el mes de inicio</label>
              <select class="form-control" id="MES" name="MES">
                <option>ENERO</option>
                <option>FEBRERO</option>
                <option>MARZO</option>
                <option>ABRIL</option>
                <option>MAYO</option>
                <option>JUNIO</option>
                <option>JULIO</option>
                <option>AGOSTO</option>
                <option>SEPTIEMBRE</option>
                <option>OCTUBRE</option>
                <option>NOVIEMBRE</option>
                <option>DICIEMBRE</option>
              </select>
              <label for="MES2">Seleciona el mes final</label>
              <select class="form-control" id="MES2" name="MES2" >
                <option>ENERO</option>
                <option>FEBRERO</option>
                <option>MARZO</option>
                <option>ABRIL</option>
                <option>MAYO</option>
                <option>JUNIO</option>
                <option>JULIO</option>
                <option>AGOSTO</option>
                <option>SEPTIEMBRE</option>
                <option>OCTUBRE</option>
                <option>NOVIEMBRE</option>
                <option>DICIEMBRE</option>
              </select>
              <label for="YEAR">Seleciona año de ejercicio</label>
              <select class="form-control" id="YEAR" name="YEAR">
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
              </select>
            </div>
            <input type="submit" name="entrar" value="CONTINUAR"/>
          </form><!--Fin del SELECCION DE FORMULARIO para un solo mes-->
         </div>
<!---***********************************************Fin del SELECCION DE FORMULARIO para varios meses**************************************************************************-->
     </div><!--Fin del formulario de polizas -->

    </div>

  </body>
</html>
