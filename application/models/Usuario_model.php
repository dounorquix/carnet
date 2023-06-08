<?php

class Usuario_model extends CI_Model
{

		function __construct() {
			parent::__construct();
		}
	
		public function usua_get_id($log, $pass) {
			$query = $this->db->query("SELECT * FROM fn_usua_get('$log', '$pass');");
			$result = $query->result(); 
		return $result;

		
		}
	
		public function usua_get($id) {
			$query = $this->db->query("SELECT * FROM fn_usua_get($id);");
			$result = $query->result();
			return $result[0];
		}
		public function usua_lst() {
			$query = $this->db->query("SELECT * FROM fn_usua_lst();");
			$result = $query->result();
			return $result;
		}
	
		public function usua_ins($id_usua, $ip_act, $log_usu, $pas_usu, $ced_usu, $nom_usu, $ape_usu, $id_tip_usu) {
			$query = $this->db->query("SELECT * FROM fn_usua_ins($id_usua, '$ip_act', '$log_usu', '$pas_usu', $ced_usu, '$nom_usu', '$ape_usu', $id_tip_usu);");
			$result = $query->result();
			switch ($result[0]->fn_usua_ins) {
				case 0:
					return 0;
					break;
				case -99:
					throw new Exception("No Posee los Privilegios Para Realizar Esta Operacion.");
					break;
				case -98:
					throw new Exception("El usuario ya se encuentra registrado.");
					break;
			}
		}
	
		public function usua_upd($id_usua, $id_usu, $ip_act, $log_usu, $ced_usu, $nom_usu, $ape_usu, $id_tip_usu) {
			$query = $this->db->query("SELECT * FROM fn_usua_upd($id_usua, $id_usu, '$ip_act', '$log_usu', $ced_usu, '$nom_usu', '$ape_usu', $id_tip_usu);");
			$result = $query->result();
			switch ($result[0]->fn_usua_upd) {
				case 0:
					return 0;
					break;
				case -99:
					throw new Exception("No Posee los Privilegios Para Realizar Esta Operacion.");
					break;
				case -98:
					throw new Exception("El usuario no existe.");
					break;
				case -97:
					throw new Exception("La cedula ya se encuentra registrado.");
					break;
			}
		}
	
		public function usua_dele($id_usu, $id_usua, $ip_act) {


          // print $ip_act; die();

			$query = $this->db->query("SELECT * FROM fn_usua_dele($id_usu, $id_usua, '$ip_act');");
			$result = $query->result();
			switch ($result[0]->fn_usua_dell) {
				case 0:
					return 0;
					break;
				case -99:
					throw new Exception("No Posee los Privilegios Para Realizar Esta Operacion.");
					break;
				
			}
		}
	

	    public function ver_tra($ced_tra) {        
        $query = $this->db->query("select * from fn_ver_intra('$ced_tra');");
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



	

}
