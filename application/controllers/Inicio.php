<?php if (!defined('BASEPATH'))
   exit('No direct script access allowed');

/* ------------------------------------------------
  ARCHIVO: inicio.php
  DESCRIPCION: Controlador principal del sistema RPG
  FECHA DE CREACIÓN: 20/07/2013
  OTIC
  ------------------------------------------------ */


class Inicio extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->auth_library->sess_validate(true);
   
     
   }

   public function index() {

     // die("aquii");
      
      $usua = $this->session->userdata("usua");
      $data["usua"] = $usua;

      //$data["tipo_usua"] = 2;
      $data["content"] = "inicio";
      $this->load->view("layout", $data);

//$this->load->view("vistap" , $data);

   }

   public function clear_session() {
      $this->session->set_userdata("tmp_tram", NULL);
      $this->session->set_userdata("tmp_come", NULL);
      $this->session->set_userdata("tmp_clie", NULL);
      $this->session->set_userdata("tmp_prod", NULL);
      $this->session->set_userdata("tmp_arti", NULL);
   }

}
  
	

