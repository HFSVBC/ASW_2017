<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Game_model extends CI_Model {
    // redo method with new database schema
    public function create($username)
    {
      // fazer jogos privados
      $name      = $this->db->escape($this->input->post('name'));
			$username  = $this->db->escape($username);
			$numPeople = $this->db->escape($this->input->post('numberPeople'));

      $sql =  "INSERT INTO proj_users (name, username, numPeople";
      if (isset($this->input->post('startDate'))){
			     $startDate = $this->db->escape($this->input->post('startDate'));
           $sql .= " startDate";
      }
      if (isset($this->input->post('minVal'))){
			     $minVal = $this->db->escape($this->input->post('minVal'));
           $sql .= " minVal";
      }
      if (isset($this->input->post('startDate'))){
			     $startDate = $this->db->escape($this->input->post('startDate'));
           $sql .= " maxVal";
      }
      $sql .= ")";

      $sql .= "VALUES($name, $username, $numPeople";
      if (isset($this->input->post('startDate'))){
           $sql .= " $startDate";
      }
      if (isset($this->input->post('minVal'))){
           $sql .= " $minVal";
      }
      if (isset($this->input->post('startDate'))){
           $sql .= " $maxVal";
      }
      $sql .= ")";

			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return false;
			}
    }
  }
?>
