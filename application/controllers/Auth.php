<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if ($this->auth_library->sess_validate() == TRUE) {         
			header("location: /Carnet/inicio");
		 }

		
		$this->load->model('Usuario_model');
		
	}


	public function index()
	{

		$this->load->view("auth");
	}


	public function login() {
        $logi = $this->input->post('usu');
        $pass = $this->input->post('pass');

       // print $pass; die();

        if ($logi != NULL && $pass != NULL) {
            $usua = $this->Usuario_model->usua_get_id($logi, $pass);
            $this->session->set_userdata('sess_id', $usua[0]->id_usu);
            if ($usua != NULL) {
                $this->session->set_userdata('usua', $usua[0]);
                $resu = 0;
				
            } else {
                $resu = 2;
            }
        } else {
            $resu = 1;
        }
        $arr['resu'] = $resu;
        print json_encode($arr);
    }

   //Este método cierra la sesión
   public function logout() {
	$this->session->sess_destroy();
	header("location: /Carnet/auth");
 }  

}
