<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userpages extends CI_Controller {
	
	public function view($page='home')
	{
		if(!file_exists('application/views/frontEnd/'.$page.'.php')){
		 	show_404();
		}

		$data['name']     = ucfirst($page);
		$data['loggedIn'] = False;
		if(isset($this->session->asw4LoggedIN)){
			$data['loggedIn'] = True;
		}
		$this->load->view("frontEnd/templates/header", $data);
		$this->load->view("frontEnd/".$page, $data);
		$this->load->view("frontEnd/templates/footer", $data);
	}
}