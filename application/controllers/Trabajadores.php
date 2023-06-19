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

//		print_r($filtr); die();

        if ($filtr != NULL) {

			$arr['cedula']  = "$filtr->ced_tra";
            $arr['txt_nom']  = $filtr->pri_nom . "  " . $filtr->seg_nom;
            $arr['ape_tra']  = $filtr->pri_ape . "  " . $filtr->seg_ape;
		    $arr['area']  = "$filtr->nom_dep";  //area
		    $arr['depe']  = "$filtr->nom_dep2";  //dependencia
		    $arr['cargo']  = "$filtr->nom_car"; //descripcion del cargo
		    $arr['id_tip_per']  = "$filtr->id_tip_per";//tipo de personal
			
	
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

//Emitir carnet

	public function carnet(){

		$ced= $this->input->post('ced_tra');

        $data['tra'] = $this->Trabajadores_model->trab_get($ced);

		//print_r($data['tra']); die();

		$ci_tra= $data["tra"]->ced_tra;
        $nom_ape = $data["tra"]->pri_nom." ".$data["tra"]->seg_nom." ".$data["tra"]->pri_ape." ".$data["tra"]->seg_ape;
        $tip_per = $data["tra"]->nom_car;
		$dep = $data["tra"]->nom_dep;
		$eme ='En caso de emergencias llamar al (0239 5008429)(0239 5008330)';

		$eme2 ='En Caso de Perdida, Extravio, Hurto o Robo Debera Ser Notificado a la Oficina de seguridad al (0239 5008329)(0239 5008330)';

		$minis = 'Ministerio del Poder Popular Para Transporte';

        $datos = "V$ci_tra $nom_ape $tip_per $dep $eme $eme2 $minis";

	
        $qr = $this->generate_qrcode($datos, $ci_tra);


		$this->load->view("carnets", $data);


	}

	// QR 
	 /*
    |-------------------------------------------------------------------
    | Generate QR Code
    |-------------------------------------------------------------------
    |
    | @param $data   QR Content
    |
    */
	function generate_qrcode($datos, $ci_tra)

	{

		$ce = $ci_tra;
        /* Load QR Code Library */
		$this->load->library('ciqrcode');

        $hex_data   = $ce;
        $save_name  = $hex_data.'.png';

		//chmod($save_name, 0777);

        /* QR Code File Directory Initialize */
        $dir = 'public/img/qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
		
        /* QR Data  */
        $params['data']     = $datos;
        $params['level']    = 'L';
        $params['size']     = 2;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        $this->ciqrcode->generate($params);
    

        /* Return Data */
        $return = array(
            'content' => $datos,
            'file'    => $dir. $save_name
        ); 

        return $return;

		
    }
    


 



	









   
}
