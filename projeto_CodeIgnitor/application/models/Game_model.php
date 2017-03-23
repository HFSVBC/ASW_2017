<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Game_model extends CI_Model {
    public function create($username)
    {
      // fazer jogos privados
      $name      = $this->db->escape($this->input->post('name'));
			$username  = $this->db->escape($username);
			$numPeople = $this->db->escape($this->input->post('numberPeople'));
      if (isset($this->input->post('startDate'))){
			   $startDate = $this->db->escape($this->input->post('startDate'));
         $sql       = "INSERT INTO proj_users (name, username, numPeople, startDate)
   					           VALUES($name, $username, $numPeople, $startDate)";
      }else{
        $sql = "INSERT INTO proj_users (name, username, numPeople)
  					    VALUES($name, $username, $numPeople)";
      }


			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return false;
			}
    }
  }
?>
