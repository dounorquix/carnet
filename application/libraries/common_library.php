<?php

/* ------------------------------------------------
  ARCHIVO: common_library.php
  DESCRIPCION: Funciones comunes
  FECHA DE CREACIÓN: 24/07/2013
  OTIC
  ------------------------------------------------ */

class Common_library {
   /*
    * Calcular edad
    */

   function es_navegador_valido() {            
      $CI = CI_Controller::get_instance();
      if (!$CI->agent->is_mobile()) {
         $browser = $CI->agent->browser();       
         switch ($browser) {
            case "Chrome":
            case "Opera":
            case "Internet Explorer":         
            case "Firefox":         
            case "Mozilla":
               switch ($browser){
                  case "Internet Explorer":         
                     return intval($CI->agent->version()) >= 8 ? true : false;
                     break;
                  case "Firefox":         
                  case "Mozilla":
                     return intval($CI->agent->version()) >= 14 ? true : false;                  
                     break;
                  default:
                     return true;
                  break;
               }
            default:            
               return false;
         }
      } else {
         return false;
      }
   }
   
   function edad($fech_ini, $fech_fin = NULL) {
      if ($fech_fin != NULL) {
         $dia = date("j", strtotime($fech_fin));
         $mes = date("n", strtotime($fech_fin));
         $anno = date("Y", strtotime($fech_fin));
      } else {
         $dia = date("j");
         $mes = date("n");
         $anno = date("Y");
      }
      $dia_ini = substr($fech_ini, 0, 2);
      $mes_ini = substr($fech_ini, 3, 2);
      $anno_ini = substr($fech_ini, 6, 4);
      if ($mes_ini > $mes) {
         $calc_edad = $anno - $anno_ini - 1;
      } else {
         if ($mes == $mes_ini AND $dia_ini >= $dia) {
            $calc_edad = $anno - $anno_ini - 1;
         } else {
            $calc_edad = $anno - $anno_ini;
         }
      }
      return $calc_edad;
   }

   function formato_fecha($fecha, $separador = "-") {
      $hora = date("g:i:s A", strtotime($fecha));
      $fecha = date("d-m-Y ", strtotime($fecha));
      //$dia = substr($fecha, 8, 2);
      //$mes = substr($fecha, 5, 2);
      //$anno = substr($fecha, 0, 4);
      //$hora = substr($fecha, 11, 8);
      return $fecha . "  |  " . $hora;
   }

   function formato_moneda($valor) {
      return number_format($valor, 2, ",", ".");
   }

   private function isIPIn($ip, $net, $mask) {
      $lnet = ip2long($net);
      $lip = ip2long($ip);
      $binnet = str_pad(decbin($lnet), 32, "0", STR_PAD_LEFT);
      $firstpart = substr($binnet, 0, $mask);
      $binip = str_pad(decbin($lip), 32, "0", STR_PAD_LEFT);
      $firstip = substr($binip, 0, $mask);
      if (strcmp($firstpart, $firstip)) {
         return true;
      } else {
         return false;
      }
//      return(strcmp($firstpart,$firstip)==0);
   }

   private function isPrivateIP($ip) {
      $privates = array("127.0.0.1/24", "172.31.32.6", "172.31.32.1", "192.168.0.0/16");
      foreach ($privates as $k) {
         //list($net,$mask)=preg_split("/",$k);		
         $k = preg_split("[\/]", $k);
         $net = $k[0];
         $mask = $k[1];
         if ($this->isIPIn($ip, $net, $mask)) {
            return true;
         }
      }
      return false;
   }

   function check_ip_behind_proxy() {
      $user_ip = $_SERVER["REMOTE_ADDR"];
      if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
         $user_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
      } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
         $user_ip = $_SERVER["HTTP_CLIENT_IP"];
      } else {
         return $user_ip;
      }
      $ips = preg_split('/[, ]/', $user_ip);
      foreach ($ips as $ip) {
         if (preg_match('/^(\d{1,3}\.){3}\d{1,3}$/s', $ip) && !$this->isPrivateIP($ip)) {
            $user_ip = $ip;
         }
      }
      return $user_ip;
   }

   function getIP() {
      /* if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
        $ip = $_SERVER['REMOTE_ADDR'];
        } */
      /* $ip = $_SERVER['REMOTE_ADDR'];
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; */
      return $this->check_ip_behind_proxy();
//return $ip;
   }

   function getMacLinux() {
      $ipAddress = $_SERVER['REMOTE_ADDR']; //IP
      exec('netstat -ie', $result);
      if (is_array($result)) {
         $iface = array();
         foreach ($result as $key => $line) {
            if ($key > 0) {
               $tmp = str_replace(" ", "", substr($line, 0, 10));
               if ($tmp <> "") {
                  $macpos = strpos($line, "HWaddr");
                  if ($macpos !== false) {
                     $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos + 7, 17)));
                  }
               }
            }
         }
         return $iface[0]['mac'];
      } else {
         return "notfound";
      }
   }

}

?>