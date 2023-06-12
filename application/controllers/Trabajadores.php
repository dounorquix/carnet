<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trabajadores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->auth_library->sess_validate() != TRUE) {
            header("location: /carnet/");
        }
        $this->load->model('Trabajadores_model');
    }

    public function index() {
       
        $data['usua'] = $this->session->userdata('usua');
        $data['content'] = 'trabajadores';
        $this->load->view('layout', $data);
    }

	public function setvartemp() {
        $tra = $this->input->post('tra') != NULL ? $this->input->post('tra') : NULL;
        $this->session->set_userdata('tmp_tra', trim(strtoupper($tra)));
      //  print 0;

		print json_encode($tra);
    }

	
	//buscar datos del trabajador en el sigefirrhh
	
	 public function trab_filt() {
    
		if ($this->session->userdata('tmp_tra') == NULL) {
            DIE;
        }
        $tra = $this->session->userdata('tmp_tra') != NULL ? $this->session->userdata('tmp_tra') : NULL;

        

        $filtr = $this->Trabajadores_model->trab_get($tra);

		

        if ($filtr != NULL) {

			$arr['cedula']  = "$filtr->ced_tra";
            $arr['txt_nom']  = $filtr->pri_nom . "  " . $filtr->seg_nom;
            $arr['ape_tra']  = $filtr->pri_ape . "  " . $filtr->seg_ape;
			 $arr['dep']  = "$filtr->nom_dep";
			
	
			if ($arr['fot_trab'] = pg_unescape_bytea($filtr->fot_tra)) {
            } else {
                $arr['fot_trab'] = null;
            }
            $arr['btn_reg'] = 1;
            $arr['btn_emi'] = 1;

            $resu = 0;

//print_r($arr); die();

        } else {
			$resu = 1;
			$arr['msj'] = 'No existen registros por favor comunicarse con Recursos Humanos';
			
			
        }
        $this->session->set_userdata('tmp_tra', NULL);
		$arr['resu'] = $resu;
        print json_encode($arr);
    }

	public function carnet(){

		$ced= $this->input->post('ced_tra');

        $dato_emi = $this->Trabajadores_model->trab_get($ced);



		if ($col > 0) {
            switch ($col) {
                case 1:$color = imagecolorallocate($im, 255, 255, 0); //amarillo contratados
                    break;
                case 2:$color = imagecolorallocate($im, 108, 117, 125); // gris personal de seguridad*
                    break;
                case 3: $color = imagecolorallocate($im, 31, 20, 238); //azul empleados
                    break;
                case 4: $color = imagecolorallocate($im, 102, 16, 242); //morado jubilados*
                    break;
                case 5: $color = imagecolorallocate($im, 244, 6, 6); //rojo para presidencia vice-presidencia, gerente generales, gerente de linea, adjunto, jefes de areas, coordinadores.
                    break;
                case 6: $color = imagecolorallocate($im, 4, 81, 15); //verde obreros.
                    break;
            }
		}

	//	print_r($dato_emi);



		$this->load->view("carnets");


	}




   
}
