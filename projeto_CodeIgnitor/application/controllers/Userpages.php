<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userpages extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('user_model');
	}

	public function view($page='home')
	{
		if(!file_exists('application/views/frontEnd/'.$page.'.php')){
		 	show_404();
		}

		$protectedPages = array(
			'dashboard' => 1,
			'game'      => 1,
			'profile'   => 1,
			'admin'     => 0
		);

		if(isset($this->session->userdata['loggedIn_asw004']) && $this->session->userdata['loggedIn_asw004']['logged_in'] === TRUE){
			$data['loggedIn']      = True;
			$data['loggedIn_user'] = $this->session->userdata['loggedIn_asw004']['username'];
			$data['loggedIn_email'] = $this->session->userdata['loggedIn_asw004']['email'];
			$data['loggedIn_level'] = $this->session->userdata['loggedIn_asw004']['level'];
			if($data['loggedIn_level'] > $protectedPages[$page]){
				show_404();
			}
			if($page == 'profile'){
				$result            = $this->getLoggedInUserData($data['loggedIn_user']);
				$data['fName']     = $result ->fName;
				$data['lName']     = $result ->lName;
				$data['birthDate'] = $result ->birthDate;
				$data['sex']       = $result ->sex;
				$data['country']   = $result ->country;
				$data['district']  = $result ->district;
				$data['county']    = $result ->county;
				$data['balance']   = $result ->balance;
				$data['avatar']    = $result ->avatar;
			}
		}else if(array_key_exists($page, $protectedPages)){
			show_404();
		}else{
			$data['loggedIn']  = False;
		}

		$data['name']      = ucfirst($page);
		$data['districts'] = $this->getDistricts();
		$data['counties']  = $this->getCounties();

		$this->load->view("frontEnd/templates/header", $data);
		$this->load->view("frontEnd/".$page, $data);
		$this->load->view("frontEnd/templates/footer", $data);
	}

	private function getDistricts()
	{
		$result     = "";
		$data       = $this->user_model->getDistricts();
		foreach ($data as $row) {
			$result .="<option value='".$row['id']."'>".$row['nome']."</option>";
		}
		return $result;
	}

	private function getCounties()
	{
		$result     = "";
		$data       = $this->user_model->getCounties();
		foreach ($data as $row) {
			$result .="<option value='".$row['id']."' data-parentDist='".$row['parent_id']."'>".$row['nome']."</option>";
		}
		return $result;
	}

	private function getLoggedInUserData($id)
	{	
		return $this->user_model->getUser($id);
	}
}