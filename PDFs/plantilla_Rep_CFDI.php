<!--
Autor: Porras Najera Miguel Angel
Descripcion: El siguiente programa es la plantilla para generar los reportes de los cfdis
-->
<?php
  require_once 'G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\fpdf\fpdf.php';
  //ahora creamos una calse para usar como plantilla para generar los reportes

setlocale (LC_ALL, "");//Cambie el nombre de las funciones al que se tiene configurado en la maquina

  class PDF extends FPDF {

    function Header(){

      //variable para la fecha del dia en que se hace el rreporte


      $today =  strtoupper("MEXICO, Ciudad de Mexico a ".strftime("%d de %B del %Y") );

      $this->Image('G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\imagenes\Logo_mail.png', 10, 3,60);
      $this->SetFont('Arial','B',12);
      $this->Cell(60);
      $this->Cell(200,5,$today,0,0,'R');//fecha
      $this->Ln(15);

      //Formato predefinido de la compañia y ubicacion
      $this->Cell(100,5,'ARANCEL S.A. DE C.V.',0,1,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(100,5,'CHIMALHUACAN',0,1,'L');
      $n = utf8_decode("PEÑON DE LOS BAÑOS");

      //subtitulo de la pagina o formato
      $this->SetFont('Arial','',15);
      $this->SetX(5);
      $titulo =  strtoupper('REPORTE DEL SAT DE CFDI DEL'.strftime(" %B del %Y") );
      $this->Cell(270,7,$titulo."hola",1,1,'C');
      //encabezado de la tabla
      $this->SetFillColor(232,232,232);
      $this->SetFont('Arial','',10);
      $this->SetFillColor(232,232,232);
      $this->SetX(5);

      $texto='003F64C1-41BA-4A61-';
      $texto .='A94A-FEB2AA416F54 QME951026DX7';

      $this->Cell(43,10,utf8_decode($texto),1,0,'C');
      $this->Cell(30,10,"RFC",1,0,'C');
      $this->Cell(55,10,"Nombre o Razon Social",1,0,'C');
      $this->Cell(30,10,"Fecha Emision",1,0,'C');
      $this->MultiCell(30,5,"Fecha Certificacion",1,'C');
      $this->SetY(60);
      $this->SetX(193);
      $this->Cell(16,10,"SubTotal",1,0,'C');
      $this->Cell(18,10,"Impuestos",1,0,'C');
      $this->Cell(16,10,"Total",1,0,'C');
      $this->Cell(16,10,"Nomina",1,0,'C');
      $this->Cell(16,10,"Vigente",1,1,'C');
    }//FINAL DE HEADER

    function ImprimirFinal($TotalReg,$TotalCan,$SubTotal,$Impuestos,$Total){
      $this->SetY(-15);
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $texto = 'El total de registros ='.$TotalReg.'  Canceladas ='.$TotalCan.'Total sin canceladas subtotal =$'.$SubTotal.'Impuestos =$'.$Impuestos.'Total =$'.$Total;
      $this->Cell(100,10,$texto,0,0,'R');
    }

    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
{
    //Get string width
    $str_width=$this->GetStringWidth($txt);

    //Calculate ratio to fit cell
    if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
    $ratio = ($w-$this->cMargin*2)/$str_width;

    $fit = ($ratio < 1 || ($ratio > 1 && $force));
    if ($fit)
    {
        if ($scale)
        {
            //Calculate horizontal scaling
            $horiz_scale=$ratio*100.0;
            //Set horizontal scaling
            $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
        }
        else
        {
            //Calculate character spacing in points
            $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
            //Set character spacing
            $this->_out(sprintf('BT %.2F Tc ET',$char_space));
        }
        //Override user alignment (since text will fill up cell)
        $align='';
    }

    //Pass on to Cell method
    $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

    //Reset character spacing/horizontal scaling
    if ($fit)
        $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
}

function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
}

function MBGetStringLength($s)
 {
     if($this->CurrentFont['type']=='Type0')
     {
         $len = 0;
         $nbbytes = strlen($s);
         for ($i = 0; $i < $nbbytes; $i++)
         {
             if (ord($s[$i])<128)
                 $len++;
             else
             {
                 $len++;
                 $i++;
             }
         }
         return $len;
     }
     else
         return strlen($s);
 }
  }//final de la clase

?>
