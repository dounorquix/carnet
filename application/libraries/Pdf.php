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
class Pdf extends FPDF
{
	function designUp($espejo = 0){
        $this->Rect( (13 + $espejo), 13, 90, 100); //Marco exterior
        $this->Rect( (18 + $espejo), 18, 25, 30); //Marco foto
 
        //Nombre y su recuadro
        $this->setXY((50 + $espejo), 20);
        $this->Cell(29, 7, 'Nombre');
 
        $this->setXY((50 + $espejo), 28);
        $this->Cell(50, 7, '', 1);
 
        //Mail y su recuadro
        $this->setXY((50 + $espejo), 45);
        $this->Cell(29, 7, 'Mail');
 
        $this->setXY((50 + $espejo), 53);
        $this->Cell(50, 7, '', 1);
 
        //Edad y su recuadro
        $this->setXY( (18 + $espejo), 53);
        $this->Cell(13, 7, 'Edad');
 
        $this->setXY((31 + $espejo), 53);
        $this->Cell(12, 7, '', 1);
 
        //Imagen de expo
        $this->Image('../public/img/carnet_ife.png', (18 + $espejo), 65, 80 ,45);
 
    }
 
  
}//fin clase PDF
?>
