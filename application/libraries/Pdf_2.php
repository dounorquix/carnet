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
class Pdf_2 extends FPDF
{
   var $nom = null;
   //var $nom = null;
   //var $ced = null;
   
	#FUNCION CONTRUCTORA	
	function __construct(  $params, $orientation='P', $unit='mm', $size='Letter')
	{
		#CONTRUCTOR PADRE
		parent::__construct($orientation,$unit,$size);
      
      $this->nom = $params['pro'];
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
		$this->Image('public/img/cintillo2022.png',11,5,190);                              #Cintillo de la cabecera
		$this->SetFont('Arial','B',8);                                               #Fuente
		$this->Text(12,33,'Instituto de Ferrocarriles del Estado');                  #Nombre de la institucion
		$this->Text(12,38,utf8_decode("Oficina de Gestión Humana RRHH"));   #Departamento
		$this->Text(178,33,'FECHA: '.date("d/m/Y"));
		//$this->Image('public/img/saep.png',165,20,40);                               #Logo del Sistema (RPG)
		$this->ln(35);                                                               #Espacio reservado para la cabecera
		
	}
#----------------------------------------------------------------------------------------------------------------------------------
	#FUNCION FIE DE PÁGINA	
	function Footer(){
		$this->SetY(-15);#Margen de abajo hacia arriba
      
      $this->SetFont('Arial', '', 9);
      $this->Cell(192, -2, utf8_decode("''INDEPENDENCIA Y PATRIA SOCIALISTA VIVIREMOS Y VENCEREMOS!!!''"), 0, 1, 'C');
      //$this->Cell(96, -20, utf8_decode("________________________________"), 0, 0, 'L');
     // $this->Cell(96, -20, utf8_decode("________________________________"), 0, 1, 'R');
      
      /*$this->SetFont('Arial', 'B', 10); // tipo de letra, negrilla, tamaño
      //$this->Cell(96, -6, utf8_decode("$this->elab"), 0, 0, 'L', false);
      //$this->Cell(96, -6, utf8_decode("Jefe de Area"), 0, 1, 'R');
      
      
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, -2, utf8_decode("Elaborado por:"), 0, 0, 'L');
      //$this->Cell(64, -2, utf8_decode("HUELLA:"), 0, 0, 'C', false); 
      $this->Cell(96, -2, utf8_decode("Revisado por:"), 0, 1, 'R', false);*/    #Usuario logueado 
      
		/*$this->SetFont('Arial','',6);                                                #Fuente
		$pie1 ="AV.PERIMETRAL DE CHARALLAVE, SECTOR LA PEÑITA, CHARALLAVE NORTE";            
		$pie2 ="MUNICIPIO CRISTÓBAL ROJAS, ESTADO MIRANDA-VENEZUELA";
		$pie3 ="TELF: (+58)-0239-500.84.37, 500.83.92 | SITIO WEB: WWW.IFE.GOB.VE | RIF: G-20000124-0";
		$this->Cell(0,-5,utf8_decode("$pie3"),0,1,'C');
		$this->Cell(0,-5,utf8_decode("$pie1 $pie2"),0,1,'C');
		$this->SetFont('Arial','',7);	                                                #Fuente y tamaño del foliado
		$this->Cell(0,-5,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'R');     #Foliado 1/1 AliasNbPages();
		$this->Cell(7,-5,'',0,0,'C');  #Celda den blanco*/

           
   } 
}
?>