<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->auth_library->sess_validate() != TRUE) {
            header("location: /carnetizacion/");
        }
        $this->load->model('Usuario_model');
        $this->load->model('Tipo_usuario_model');
    }


    public function index() {
        
        $data['usua'] = $this->session->userdata('usua');
        $data['content'] = 'usuarios';
        $data['tip_usua'] = $this->Tipo_usuario_model->tip_usua_lst();
        $this->load->view('layout', $data);
    }

    public function listar() {

        $con = $this->Usuario_model->usua_lst();

        $usua = $this->session->userdata("usua");

        if ($con != null) {
            $i=1;

            foreach ($con as $row): 
             
                
                    $img = "<button type='button' class='btn btn-info btn-sm usu_del' title='modificar' id='$row->id_usu' data-toggle='modal' data-target='#modal-lg'><span class='fas fa-edit'></span></button>

                            &nbsp;&nbsp;&nbsp;
<button type='button' id='$row->id_usu' title='eliminar' class='btn btn-danger btn-sm usu_del'><span class='fas fa-trash'></span></button></a>
                             &nbsp;&nbsp;&nbsp;";

            

                $data[] = array(
                    'N°'   => $i++,
                    'usuario'     => " $row->log_usu",
                    'cedula' => "$row->ced_usu",
                    'apellidos'  => "$row->ape_usu",
                    'nombre'     => " $row->nom_usu",
                    'tipo de usuario' => "$row->des_tip_usu",
                    'acciones'  => "$img",
                );
            endforeach;
        } else {
            $data[] = "";
        }
        $paging = array('data' => $data);

        print json_encode($paging);
    
    
    }
    public function setvartemp() {
        $id_usua = $this->input->post('id');
        $this->session->set_userdata('tmp_id_usua', $id_usua);
        print 0;
    }

    public function eliminar() {
        $id_usu = $this->session->userdata('sess_id');
        $id_usua = $this->input->post("id_us");
        // $id_usua = $this->session->userdata('tmp_id_usua') != NULL ? $this->session->userdata('tmp_id_usua'): NULL;
        $ip_act = $this->common_library->getIP();

      // print $id_usua;

        //die();
        try {
            if ($id_usua != NULL) {
                $resu = $this->Usuario_model->usua_dele($id_usu, $id_usua, $ip_act);


                $arr['resu'] = $resu;
                $arr['mens'] = "El registro ha sido eliminado.";
                
            } else {
                $arr['mens'] = 'Error en la transferencia de datos.';
                $arr['resu'] = 1;
            }
            
            
        } catch (Exception $e) {
            $arr["mens"] = $e->getMessage();
            $arr["resu"] = 1;
        }        
        $this->session->set_userdata('tmp_id_usua', NULL);
        print json_encode($arr);
    }

//filtrar trabajador para listar tanto del sigefiir como del intrasarrhh
    public function trab_filt()
    {
       
        $ced_tra = $this->input->post("ced");
        
        if ($ced_tra != null) {
            $this->session->set_userdata("tmp_ced_tra", $ced_tra);

        } else {
            $this->session->set_userdata("tmp_ced_tra", null);

        }

 
        $filtr = $this->Usuario_model->ver_tra($ced_tra);
        
        

        if ($filtr != null) {
       
            $arr['cedula']  = "$filtr->cedula";
            $arr['txt_nom']  = $filtr->primer_nombre . "  " . $filtr->segundo_nombre;
            $arr['ape_tra']  = $filtr->primer_apellido . "  " . $filtr->segundo_apellido;
            $arr['usuario']  = "$filtr->usuario";
            $arr['clave']  = "$filtr->clave";
    
            $resu            = 0;      
        } else {
            $resu = 'No existen registros por favor comunicarse con Recursos Humanos';
        }
        $arr['tip_usua'] = $this->Tipo_usuario_model->tip_usua_lst();
        $arr['resu'] = $resu;
        print json_encode($arr);

    }

    public function guardar() {

        
        $id_usua = $this->session->userdata('sess_id');
        $id_usu = $this->session->userdata('tmp_id_usua') == NULL ? NULL : $this->session->userdata('tmp_id_usua');
        $ip_act = $this->common_library->getIP();
        $log_usu = trim($this->input->post("usu"));
        $pas_usu = trim($this->input->post("pass"));
        $ced_usu = trim($this->input->post("cedula"));
        $nom_usu = trim($this->input->post("nom"));
        $ape_usu = trim($this->input->post("ape"));
        $id_tip_usu = $this->input->post("tip_usu");


        try {
            if ($id_usu != NULL) {
                //print "1"; die();
                $resu = $this->Usuario_model->usua_upd($id_usua, $id_usu, $ip_act, $log_usu, $ced_usu, $nom_usu, $ape_usu, $id_tip_usu);
            } else {
              //  print "2"; die();
                $resu = $this->Usuario_model->usua_ins($id_usua, $ip_act, $log_usu, $pas_usu, $ced_usu, $nom_usu, $ape_usu, $id_tip_usu);
            }
            $arr['resu'] = $resu;
            $arr['mens'] = "El registro se ha guardado correctamente.";
        } catch (Exception $e) {
            $arr["mens"] = $e->getMessage();
            $arr["resu"] = 1;
        }
        $this->session->set_userdata('tmp_id_usua', NULL);
        print json_encode($arr);

        print "3"; die();
    }




}
