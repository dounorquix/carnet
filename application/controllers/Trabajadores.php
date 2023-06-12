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

         //   $resu = 0;

//print_r($arr); die();

        } else {
			$resu = 1;
			$arr['msj'] = 'No existen registros por favor comunicarse con Recursos Humanos';
			
			
        }
        $this->session->set_userdata('tmp_tra', NULL);
		$arr['resu'] = $resu;
        print json_encode($arr);
    }




   
}
