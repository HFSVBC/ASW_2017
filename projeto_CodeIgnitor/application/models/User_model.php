<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User_model extends CI_Model {

		public function registerUser(){
			$fName     = $this->db->escape($this->input->post('name'));
			$lName     = $this->db->escape($this->input->post('surname'));
			$username  = $this->db->escape($this->input->post('username'));
			$email     = $this->db->escape($this->input->post('email'));
			$options   = ['cost' => 9];
			$password  = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
			$birthDate = $this->db->escape($this->input->post('birthDate'));
			$sex       = $this->db->escape($this->input->post('sexo'));
			$country   = $this->db->escape($this->input->post('country'));
			$district  = $this->db->escape($this->input->post('dist'));
			$county    = $this->db->escape($this->input->post('con'));
			$hash      = md5($username+$birthDate);

			$sql = "INSERT INTO proj_users (fName, lName, username, email, password, birthDate, sex, country, district, county, hash)
					VALUES($fName, $lName, $username, $email, '$password', $birthDate, $sex, $country, $district, $county, '$hash')";

			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return false;
			}
		}

		public function getDistricts()
		{
			$query = $this->db->query("SELECT nome, id FROM dist_con WHERE tipo = 0");
			return $query->result_array();
		}

		public function getCounties()
		{
			$query = $this->db->query("SELECT nome, id, parent_id FROM dist_con WHERE tipo = 1");
			return $query->result_array();
		}
	}
?>