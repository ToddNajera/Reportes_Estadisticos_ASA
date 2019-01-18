<?php
require_once 'G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\fpdf\fpdf.php';
//ahora creamos una calse para usar como plantilla para generar los reportes

setlocale (LC_ALL, "");//Cambie el nombre de las funciones al que se tiene configurado en la maquina


class PDF_MC_Table extends FPDF{
  var $widths;
  var $aligns;

  function Header(){
    //variable para la fecha del dia en que se hace el rreporte
    $today =  strtoupper("MEXICO, Ciudad de Mexico a ".strftime("%d de %B del %Y") );

    $this->Image('G:\WampServer\www\ProyectoArancel_2018\Reportes_Estadisticos_ASA\imagenes\Logo_mail.png', 15,4,75);
    $this->SetFont('Arial','B',12);
    $this->Cell(70);
    $this->Cell(200,5,$today,0,0,'R');//fecha
    $this->Ln(15);
    //Formato predefinido de la compañia y ubicacion
  }//FINAL DE HEADER

  function Titulo_Tabla($MesIN,$MesFN,$yearEJER){
    $this->SetFont('Arial','B',16);
    $this->Ln(5);
    $this->Cell(270,10,"REPORTE ESTADISTICO DE ".$MesIN." A ".$MesFN." DEL ".$yearEJER,0,0,'C');
  }

  function Contenido_Tabla($query_SQL){
    
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
