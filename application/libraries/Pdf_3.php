<?php 
/* -------------------------------------------------------------------------------------------------------------------------------------------
ARCHIVO: doc.php                                                                                                                              |
DESCRIPCION: Libreria PDF donde se integra el FPDF                                                                                            |
FECHA DE CREACIÓN: 18/04/2023                                                                                                                 |
PROGRAMADOR: Dounorquix Silva                                                                                                                   |
INSTITUCIÓN: Instituto de Ferrocarriles del Estado                                                                                            |
GERENCIA: OTIC - Oficina de Técnología de Información y Comunicación                                                                          |
ÁREA: Desarrollo de Sistemas                                                                                                                  |
---------------------------------------------------------------------------------------------------------------------------------------------- */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('Fpdf.php'); #LIBRERIA PROPIA DE FPDF
#CLASE FPDF
class Pdf_3 extends FPDF
{
   //var $nom = null;
   //var $nom = null;
   //var $ced = null;
   
	#FUNCION CONTRUCTORA	
	function __construct( $orientation='P', $unit='mm', $size='Letter')
	{
		#CONTRUCTOR PADRE
		parent::__construct($orientation,$unit,$size);
      
      //$this->nom = $params['alm'];
      //$this->nom = $params['nom'];
      //$this->ced = $params['ced'];
	}
	# FUNCION QUE GENERA ARREGLOS PARA LAS CELDAS DINAMICAS
	var $widths;
	var $aligns;
   
   
function SetWidths($w){$this->widths = $w;} function SetAligns($a){$this->aligns = $a;}	
	
	#FUNCION ARREGLOS
	public function Row($data, $n, $b){
		$nb=0;
		for($i=0;$i<count($data); $i++){
			$nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		} 
		$h=4*$nb;
		$this->CheckPageBreak($h);
		for($i=0;$i<count($data);$i++){	
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			$x=$this->GetX(); $y=$this->GetY();
			$this->Rect($x,$y,$w,$h);
			$this->SetFont('Arial','',6);                           #FUENTE
	
			if($b[$i] == $i){
				$alineacion = "C";
			}else{
            if($b[$i] == 'r'){
               $alineacion = "R";
            }else{
               $alineacion = "J";
            }
			}
	
			if($n[$i] == $i){
				$this->SetFillColor(196,196,196);               #COLOR DE LA CELDA
				$fill = TRUE;
			}else{
				$fill = FALSE;	
			}	
			$this->MultiCell($w,4,$data[$i],0,$alineacion,$fill);   #BORDE DE LA CELDA
			$this->SetXY($x+$w,$y);
		}
		$this->Ln($h);
	}
	
        #FUNCION SALDO DE PAGINA Y NUEVA PAGINA
function CheckPageBreak($h){	
			if($this->GetY()+$h>
			$this->PageBreakTrigger){	
				$this->AddPage($this->CurOrientation,'Letter');
			}
		}
		
	function NbLines($w,$txt){
			$cw=&$this->CurrentFont['cw']; if($w==0){$w=$this->w-$this->rMargin-$this->x;}
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize; $s=str_replace("\r",'',$txt);
			$nb=strlen($s); if($nb>0 and $s[$nb-1]=="\n"){$nb--;} $sep=-1; $i=0; $j=0; $l=0; $nl=1;

			while($i<$nb)
			{	$c=$s[$i]; if($c=="\n"){$i++; $sep=-1; $j=$i; $l=0; $nl++; continue;} if($c==' '){$sep=$i;}$l+=$cw[$c];
				if($l>$wmax){if($sep==-1){if($i==$j){$i++;}}else{$i=$sep+1;}$sep=-1; $j=$i; $l=0; $nl++;}else{$i++;}
			}return $nl;
		}
#----------------------------------------------------------------------------------------------------------------------------------
	#FUNCION DE LA CABECERA		
	function Header()                                                        
		{
		$this->Image('public/img/cintillo2022.png',11,5,190);                             #Cintillo de la cabecera
		$this->SetFont('Arial','B',8);                                               #Fuente
		$this->Text(12,33,'INSTITUTO DE FERROCARRILES DEL ESTADO');                  #Nombre de la institucion
		$this->Text(12,38,utf8_decode("Oficina de Gestión Humana RRHH"));
                $this->Text(178,33,'FECHA: '.date("d/m/Y"));
                $this->Text(178,37,'HORA: '.date("h:m:s a"));
                ##Departamento
		//$this->Image('public/img/saep.png',165,20,40);                               #Logo del Sistema (RPG)
		$this->ln(35);                                                               #Espacio reservado para la cabecera
		
	}
#----------------------------------------------------------------------------------------------------------------------------------
	#FUNCION FIE DE PÁGINA	
	function Footer(){
		$this->SetY(-15);#Margen de abajo hacia arriba
      
      $this->SetFont('Arial', '', 9);
      $this->Cell(192, -2, utf8_decode("''INDEPENDENCIA Y PATRIA SOCIALISTA VIVIREMOS Y VENCEREMOS!!!''"), 0, 1, 'C');
     
   } 
}
?>