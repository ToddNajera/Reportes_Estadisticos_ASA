<?php
require_once 'G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\fpdf\fpdf.php';
include "G:/WampServer/www/ProyectoArancel_2018/Reportes_Estadisticos_ASA/Funciones/funciones_php.php";
//require_once 'C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA/fpdf/fpdf.php';
//ahora creamos una calse para usar como plantilla para generar los reportes

setlocale (LC_ALL, "");//Cambie el nombre de las funciones al que se tiene configurado en la maquina


class PDF_MC_Table extends FPDF{
  var $widths;
  var $aligns;

  function Header(){
    //variable para la fecha del dia en que se hace el rreporte
    $today =  strtoupper("MEXICO, Ciudad de Mexico a ".strftime("%d de %B del %Y") );

    $this->Image('G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\imagenes\Logo_mail.png', 15,4,75);
    //$this->Image('C:/wamp64/www/Proyecto_Arancel_2018/Reportes_Estadisticos_ASA\imagenes\Logo_mail.png', 15,4,75);
    $this->SetFont('Arial','B',12);
    $this->Cell(70);
    $this->Cell(200,5,$today,0,0,'R');//fecha
    $this->Ln(15);
    //Formato predefinido de la compañia y ubicacion
  }//FINAL DE HEADER
  //Titutlo de reportes de VARIOS MESES(VM)
  function Titulo_Tabla_VM($MesIN,$MesFN,$yearEJER){
    $this->SetFont('Arial','B',16);
    $this->Ln(5);
    $this->Cell(270,10,"REPORTE ESTADISTICO DE ".$MesIN." A ".$MesFN." DEL ".$yearEJER,0,0,'C');
  }
  //Titulo de reportes de UN MES (UM)
  function Titutlo_Tabla_UM($MesIN,$yearEJER){
    $this->SetFont('Arial','B',16);
    $this->Ln(5);
    $this->Cell(270,10,"REPORTE ESTADISTICO DE ".$MesIN." DEL ".$yearEJER,0,0,'C');
  }
  //Funcion Recibe tres Array de Totales
  function Crear_Tabla_Totales_UM($Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS){
    $this->SetFont('Arial','B',16);
    $this->Ln(10);
    $this->Cell(270,10,"SUMAS TOTALES",1,1,'C');
    $this->SetFont('Arial','B',14);
    $this->Cell(67.5,10,"Descripcion",1,0,'C');
    $this->Cell(67.5,10,"CFDI's del SAT",1,0,'C');
    $this->Cell(67.5,10,"Polizas de Ingresos",1,0,'C');
    $this->Cell(67.5,10,"Cuentas de Gastos",1,1,'C');
    $this->Cell(67.5,10,"Total sin IVA",1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_SAT[0],1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_POLIZAS[0],1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_CTAGASTOS[0],1,1,'C');
    $this->Cell(67.5,10,"Total del IVA",1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_SAT[1],1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_POLIZAS[1],1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_CTAGASTOS[1],1,1,'C');
    $this->Cell(67.5,10,"Total de Factutas",1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_SAT[2],1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_POLIZAS[2],1,0,'C');
    $this->Cell(67.5,10,"$".$Totales_CTAGASTOS[2],1,1,'C');
  }
  //Funcion recibe tres array de Diferencias
  function Crear_Tabla_Diferencias_UM($Totales_SAT,$Totales_CTAGASTOS,$Totales_POLIZAS){
    $this->SetFont('Arial','B',16);
    $this->Ln(10);
    $this->SetX(77.5);
    $this->Cell(135,10,"Diferencias TOTALES",1,1,'C');
    $this->SetFont('Arial','B',12);
    $this->SetX(77.5);
    $this->Cell(67.5,10,"Diferencia con",1,0,'C');
    $this->SetFont('Arial','B',14);
    $this->Cell(67.5,10,"CFDI's del SAT",1,1,'C');
    $this->SetX(77.5);
    $this->Cell(67.5,10,"Cuentas de Gastos",1,0,'C');
    $this->Cell(67.5,10,"$".intval($Totales_CTAGASTOS[2]-$Totales_SAT[2]),1,1,'C');
    $this->SetX(77.5);
    $this->SetFont('Arial','B',12);
    $this->Cell(67.5,10,"Diferencia con",1,0,'C');
    $this->SetFont('Arial','B',14);
    $this->Cell(67.5,10,"CFDI's del SAT",1,1,'C');
    $this->SetX(77.5);
    $this->Cell(67.5,10,"Polizas de Ingresos",1,0,'C');
    $this->Cell(67.5,10,"$".intval($Totales_POLIZAS[2]-$Totales_SAT[2]),1,1,'C');
    $this->SetX(77.5);
    $this->SetFont('Arial','B',12);
    $this->Cell(67.5,10,"Diferencia con",1,0,'C');
    $this->SetFont('Arial','B',14);
    $this->Cell(67.5,10,"Polizas de Ingresos",1,1,'C');
    $this->SetX(77.5);
    $this->Cell(67.5,10,"Cuentas de Gastos",1,0,'C');
    $this->Cell(67.5,10,"$".intval($Totales_CTAGASTOS[2]-$Totales_POLIZAS[2]),1,1,'C');


  }
  //Funcion que invoca Crear_Tabla_Totales() y Crear_Tabla_Diferencias() para ser mostrado en el PDF
  function Contenido_Tabla_VM_SAT($mesIN,$mesFN,$yearEJER,$dbARA,$query_SAT){
    $this->SetFont('Arial','B',12);
    $this->Ln(10);
    $this->Cell(270,9,"SUMAS TOTALES CFDI's SAT ",1,1,'C');
    $this->SetFont('Arial','B',11);
    $this->Cell(67.5,5,"Descripcion",1,0,'C');
    $this->Cell(67.5,5,"Total sin IVA",1,0,'C');
    $this->Cell(67.5,5,"Total IVA",1,0,'C');
    $this->Cell(67.5,5,"Total Facturas",1,1,'C');
    for($mesIN ; $mesIN<=$mesFN ; $mesIN++){
      $ResultadoMES=obtener_TOTALES_SAT($query_SAT,$dbARA,$mesIN,$yearEJER);
      $MesIN=convertir_num_mes($mesIN);
      $this->Cell(67.5,7,$MesIN,1,0,'C');
      $this->Cell(67.5,7,"$".$ResultadoMES[0],1,0,'C');
      $this->Cell(67.5,7,"$".$ResultadoMES[1],1,0,'C');
      $this->Cell(67.5,7,"$".$ResultadoMES[2],1,1,'C');
    }
    $this->Ln(5);
  }

  function Contenido_Tabla_VM_CTA($mesIN,$mesFN,$yearEJER,$dbARA,$query_CTAGASTOS){
    $this->SetFont('Arial','B',12);
    $this->Ln(10);
    $this->Cell(270,9,"SUMAS TOTALES CUENTAS GASTOS",1,1,'C');
    $this->SetFont('Arial','B',11);
    $this->Cell(67.5,7,"Descripcion",1,0,'C');
    $this->Cell(67.5,7,"Total sin IVA",1,0,'C');
    $this->Cell(67.5,7,"Total IVA",1,0,'C');
    $this->Cell(67.5,7,"Total Facturas",1,1,'C');
    for($mesIN ; $mesIN<=$mesFN ; $mesIN++){
      $ResultadoMES=obtener_TOTALES_CTAGASTOS($query_CTAGASTOS,$dbARA,$mesIN,$yearEJER);
      $MesIN=convertir_num_mes($mesIN);
      $this->Cell(67.5,5,$MesIN,1,0,'C');
      $this->Cell(67.5,5,"$".$ResultadoMES[0],1,0,'C');
      $this->Cell(67.5,5,"$".$ResultadoMES[1],1,0,'C');
      $this->Cell(67.5,5,"$".$ResultadoMES[2],1,1,'C');
    }
    $this->Ln(5);
  }

  function Contenido_Tabla_VM_POLZ($mesIN,$mesFN,$yearEJER,$dbARA,$query_POLIZA_IMP,$query_POLIZA_IG){
    $this->SetFont('Arial','B',12);
    $this->Ln(10);
    $this->Cell(270,9,"SUMAS TOTALES CUENTAS GASTOS",1,1,'C');
    $this->SetFont('Arial','B',11);
    $this->Cell(67.5,7,"Descripcion",1,0,'C');
    $this->Cell(67.5,7,"Total sin IVA",1,0,'C');
    $this->Cell(67.5,7,"Total IVA",1,0,'C');
    $this->Cell(67.5,7,"Total Facturas",1,1,'C');
    for($mesIN ; $mesIN<=$mesFN ; $mesIN++){
      $ResultadoMES=obtener_TOTALES_POLIZA($query_POLIZA_IMP,$query_POLIZA_IG,$dbARA,$mesIN,$yearEJER);
      $MesIN=convertir_num_mes($mesIN);
      $this->Cell(67.5,5,$MesIN,1,0,'C');
      $this->Cell(67.5,5,"$".$ResultadoMES[0],1,0,'C');
      $this->Cell(67.5,5,"$".$ResultadoMES[1],1,0,'C');
      $this->Cell(67.5,5,"$".$ResultadoMES[2],1,1,'C');
    }
    $this->Ln(5);
  }


  function SetWidths($w){
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a){
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data){
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h){
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt){
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}


}


?>
