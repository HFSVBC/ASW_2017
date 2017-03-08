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

		$data['name']      = ucfirst($page);
		$data['loggedIn']  = False;
		$data['districts'] = $this->getDistricts();
		$data['counties']  = $this->getCounties();
		if(isset($this->session->asw4LoggedIN)){
			$data['loggedIn'] = True;
		}

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
}