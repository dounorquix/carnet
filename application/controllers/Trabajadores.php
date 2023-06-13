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

        $dato_emi = $this->Trabajadores_model->trab_get($ced);



		// if ($col > 0) {
        //     switch ($col) {
        //         case 1:$color = imagecolorallocate($im, 255, 255, 0); //amarillo contratados
        //             break;
        //         case 2:$color = imagecolorallocate($im, 108, 117, 125); // gris personal de seguridad*
        //             break;
        //         case 3: $color = imagecolorallocate($im, 31, 20, 238); //azul empleados
        //             break;
        //         case 4: $color = imagecolorallocate($im, 102, 16, 242); //morado jubilados*
        //             break;
        //         case 5: $color = imagecolorallocate($im, 244, 6, 6); //rojo para presidencia vice-presidencia, gerente generales, gerente de linea, adjunto, jefes de areas, coordinadores.
        //             break;
        //         case 6: $color = imagecolorallocate($im, 4, 81, 15); //verde obreros.
        //             break;
        //     }
		// }

	//	print_r($dato_emi);


		$this->load->view("carnets");


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
	function generate_qrcode($data)
	{
        /* Load QR Code Library */
        $this->load->library('ciqrcode');
        
        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data.'.png';

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
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 3;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'content' => $data,
            'file'    => $dir. $save_name
        );
        return $return;
    }
    
    /*
    |-------------------------------------------------------------------
    | Add Data
    |-------------------------------------------------------------------
    |
    */
	function add_data()
	{
        /* Generate QR Code */
        $data = $this->input->post('content');
        $qr   = $this->generate_qrcode($data);

        /* Add Data */
        if($this->Qr_model->insert_data($qr)) {
            $this->modal_feedback('success', 'Success', 'Add Data Success', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Add Data Failed', 'Try again');
        }
        redirect('/');

    }

    /*
    |-------------------------------------------------------------------
    | Edit Data
    |-------------------------------------------------------------------
    |
    | @param $id    ID Data
    |
    */
	function edit_data($id)
	{
        /* Old QR Data */
        $old_data = $this->Qr_model->fetch_data($id);
        $old_file = $old_data['file'];

        /* Generate New QR Code */
        $data = $this->input->post('content');
        $qr   = $this->generate_qrcode($data);

        /* Edit Data */
        if($this->Qr_model->update_data($id, $old_file, $qr)) {
            $this->modal_feedback('success', 'Success', 'Edit Data Success', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Edit Data Failed', 'Try again');
        }
        redirect('/');
    }

    /*
    |-------------------------------------------------------------------
    | Remove Data
    |-------------------------------------------------------------------
    |
    | @param $id    ID Data
    |
    */
	function remove_data($id)
	{
        /* Current QR Data */
        $qr_data = $this->Qr_model->fetch_data($id);
        $qr_file = $qr_data['file'];

        /* Delete Data */
        if($this->Qr_model->delete_data($id, $qr_file)) {
            $this->modal_feedback('success', 'Success', 'Delete Data Success', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Delete Data Failed', 'Try again');
        }
        redirect('/');
	}

	









   
}
