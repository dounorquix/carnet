<?php

class Tipo_usuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    public function tip_usua_lst(){
         $query = $this->db->query("SELECT * FROM fn_tip_usu_lst();");
        $result = $query->result();
        return $result;
    }

}