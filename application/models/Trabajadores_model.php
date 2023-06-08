<?php

class Trabajadores_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	
	    public function ver_sig($ced_tra_sig) {        
        $query = $this->db->query("select * from fn_ver_sigefir('$ced_tra_sig');");
        $result = $query->result();        
         switch ($result) {
         default:
            return $result[0];
            break;
         case NULL:
            return NULL;
            break;
      }
    }
	
	  public function trab_get($id_tra) {        
        $query = $this->db->query("SELECT * FROM fn_trab_get($id_tra);");
        $result = $query->result();        
         switch ($result) {
         default:
            return $result[0];
            break;
         case NULL:
            return NULL;
            break;
      }
    }

    public function trab_lst($tra) {
        $query = $this->db->query("SELECT * FROM fn_trab_lst($tra);");
        $result = $query->result();
        return $result;
    }
    
    public function carg_lst() {
        $query = $this->db->query("SELECT * FROM fn_carg_lst();");
        $result = $query->result();
        return $result;
    }


    
    public function gua_img($id_tra, $fot){
        $query = $this->db->query("SELECT * FROM fn_trab_fot_upd($id_tra, '$fot');");
        $result = $query->result();
        switch ($result[0]->fn_trab_fot_upd) {
            case 0:
                return 0;
                break;
            case 1:
                throw new Exception("No se pudo almacenar la imagen del Trabajador.");
                break;
        }
    }
    
    
    public function emi_ins($id_tra, $id_usu, $cod) {
      $query = $this->db->query("SELECT * FROM fn_emis_ins($id_tra, $id_usu, $cod);");
      $result = $query->result();
      return $result;
         
   }
   
   
   
   
   public function cod_emi_get($cod) {
       $query = $this->db->query("SELECT * FROM fn_cod_emi_get($cod);");
       $result = $query->result();
       
       if($result!=null){
                  return $result[0];

       }else{
                return null;
  
       }
       
   }
   
   
       public function emi_lst() {
        $query = $this->db->query("SELECT * FROM fn_rpt_emi_get_lst();");
        $result = $query->result();
        return $result;
    }
	
	
    
}
