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
			$hash      = password_hash($username+time(), PASSWORD_BCRYPT, $options);

			$sql = "INSERT INTO proj_users (fName, lName, username, email, password, birthDate, sex, country, district, county, hash)
					VALUES($fName, $lName, $username, $email, '$password', $birthDate, $sex, $country, $district, $county, '$hash')";

			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return false;
			}
		}

		public function updateUser($avatarName = 'NULL'){
			$fName     = $this->db->escape($this->input->post('name'));
			$lName     = $this->db->escape($this->input->post('surname'));
			$username  = $this->db->escape($this->input->post('username'));
			$email     = $this->db->escape($this->input->post('email'));
			$birthDate = $this->db->escape($this->input->post('birthDate'));
			$sex       = $this->db->escape($this->input->post('sex'));
			$country   = $this->db->escape($this->input->post('country'));
			$district  = $this->db->escape($this->input->post('district'));
			$county    = $this->db->escape($this->input->post('county'));

			if ($avatarName != 'NULL'){
				$sql = "UPDATE proj_users
						SET fName=$fName, lName=$lName, email=$email, birthDate=$birthDate, sex=$sex, country=$country, district=$district, county=$county, avatar='$avatarName'
						WHERE username = $username";
			}else{
				$sql = "UPDATE proj_users
						SET fName=$fName, lName=$lName, email=$email, birthDate=$birthDate, sex=$sex, country=$country, district=$district, county=$county
						WHERE username = $username";
			}

			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return $this->db->_error_message();
			}
		}

		public function chageUserPassword($user)
		{
			$options   = ['cost' => 9];
			$password  = password_hash($this->input->post('passNew'), PASSWORD_BCRYPT, $options);

			$sql = "UPDATE proj_users
					SET password = '$password'
					WHERE username = '$user'";

			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return $this->db->_error_message();
			}

		}

		public function updateUserBalance($user)
		{
			$balance  = $this->db->escape($this->input->post('balanceCharge'));

			$sql = "UPDATE proj_users
					SET balance = balance + $balance
					WHERE username = '$user'";

			if($this->db->simple_query($sql)){
        		return true;
			}else{
        		return $this->db->_error_message();
			}

		}

		public function loginUser(){
			$validator = array('success' => false, 'messages' => array());

			$username  = $this->db->escape($this->input->post('username'));
			$password  = $this->input->post('password');
			$remember_me = $this->input->post('rememberMe');
			$my_cookie = $this->load->helper('cookie');
			$cookie = array(
			        'name'   => 'remember',
							'value' => $password.';'.$username,
			        'expire' => time()+86400,
			        );

			$sql   = "SELECT username, email, password, level
					  FROM proj_users
					  WHERE (username = $username OR email = $username) AND level >= 0 AND active = 0
					  LIMIT 1";
			$query = $this->db->query($sql);
			$row = $query->row();
			if(!empty($row)){
        		if(password_verify($password, $row->password)){
        			$data = array(
        				'username' => $row->username,
        				'email'    => $row->email,
        				'level'    => $row->level
        			);
        			$validator['success']  = true;
        			$validator['messages'] = $data;
        		}else{
        			$validator['success']  = false;
        			$validator['messages'] = 'Nome de utilizador / email e ou password errado(s)';
        		}
			}else{
				$validator['success']  = false;
        		$validator['messages'] = "Utilizador não encontrado";
			}
			if($validator['success'] == true && isset($remember_me)){
						set_cookie($cookie);
			}
			return $validator;
		}



		public function getUser($username)
		{
			$validator = array('success' => false, 'messages' => array());

			$sql   = "SELECT fName, lName, username, email, balance, birthDate, sex, country, district, county, creationDate, activationDate, level, avatar
					  FROM proj_users
					  WHERE username = '$username'
					  LIMIT 1";
			$query = $this->db->query($sql);

			return $query->row();
		}

		public function getUserDataAdmin()
		{
			$sql   = "SELECT fName, lName, username, email, balance, birthDate, sex, country, district, county, creationDate, activationDate, level
					  FROM proj_users";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getGamesDataAdmin()
		{
			$sql   = "SELECT name, createdBy, active, creationDate, endedDate, totalUsers, winner
					  FROM proj_game";
			$query = $this->db->query($sql);
			return $query->result_array();
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

		public function checkEmail(){

			$email     = $this->db->escape($this->input->post('email'));

			$sql   = "SELECT email
					  FROM proj_users
					  WHERE email = $email
					  LIMIT 1";


			$query = $this->db->query($sql);
			$row = $query->row();

			if(empty($row)){
        		return false;
			}else{
				return true;
			}
		}

		public function checkUsername(){

			$username = $this->db->escape($this->input->post('username'));

			$sql   = "SELECT username
					  FROM proj_users
					  WHERE username = $username
					  LIMIT 1";


			$query = $this->db->query($sql);
			$row = $query->row();

			if(empty($row)){
        		return false;
			}else{
				return true;
			}
		}

		public function checkUserPassword($user){

			$password = $this->input->post('password');

			$sql   = "SELECT username, password
					  FROM proj_users
					  WHERE username = '$user'
					  LIMIT 1";


			$query = $this->db->query($sql);
			$row = $query->row();

			if(!empty($row)){
        		if(password_verify($password, $row->password)){
        			return true;
        		}else{
        			return false;
        		}
        	}else{
        		return "Erro ao validar a password";
        	}
		}
	}
?>
