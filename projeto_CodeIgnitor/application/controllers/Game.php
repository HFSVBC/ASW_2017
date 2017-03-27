<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Europe/Lisbon");
		$this->load->model('user_model');
		$this->load->model('game_model');

	}

	public function create()
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'name',
	                'label' => 'Game Name',
	                'rules' => 'trim|required|strip_tags',
	        ),
	        array(
	                'field' => 'numberPeople',
	                'label' => 'Number of people for this game',
	                'rules' => 'trim|integer|required|strip_tags',
	        ),
					array(
	                'field' => 'startDate',
	                'label' => 'Date when game starts',
	                'rules' => 'trim|strip_tags',
	        ),
					array(
	                'field' => 'minVal',
	                'label' => 'Date when game starts',
	                'rules' => 'trim|numeric|strip_tags',
	        ),
					array(
	                'field' => 'maxVal',
	                'label' => 'Date when game starts',
	                'rules' => 'trim|numeric|strip_tags',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			$result = $this->game_model->create($this->session->userdata['loggedIn_asw004']['username']);
			if($result === true){
				$validator['success']  = true;
				$validator['messages'] = 'Jogo creado com sucesso';

			}else{
				$validator['success']  = false;
				$validator['messages'] = 'Erro ao atualizar a base de dados';
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o';
		}

		echo json_encode($validator);
	}
}
?>
