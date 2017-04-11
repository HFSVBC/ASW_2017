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
                'field' => 'description',
                'label' => 'Game Description',
                'rules' => 'trim|strip_tags',
	        ),
	        array(
                'field' => 'numberPeople',
                'label' => 'Number of people for this game',
                'rules' => 'trim|integer|required|strip_tags',
	        ),
			array(
                'field' => 'firstBet',
                'label' => 'First bet in the game',
                'rules' => 'trim|numeric|required|strip_tags',
	        )
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
				$validator['messages'] = 'Erro ao atualizar a base de dados<br>'.json_encode($result);
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o'.validation_errors();
		}

		echo json_encode($validator);
	}

	public function createGameP()
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'id_jogo',
	                'label' => 'Game id',
	                'rules' => 'trim|integer|required|strip_tags',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			$result = $this->game_model->createGameP($this->input->post('id_jogo'), $this->game_model->getIdByUsername($this->session->userdata['loggedIn_asw004']['username']));
			if($result === true){
				$validator['success']  = true;
				$validator['messages'] = 'Utilizador adicionado ao jogo com sucesso';

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

	public function getGames()
	{
		$outputData = array('data' => array());

		$result = $this->game_model->getAllGames();
		foreach ($result as $row) {
			$data = [
				$row['name'],
				$row['description'],
				$this->game_model->getUsernameById($row['owner']),
				$this->game_model->playersCount($row['id']),
				$row['max_players'],
				$row['first_bet'],
				$this->game_model->getGameState($row['id']),
				"<button type='button' class='btn btn-success gameJoin' data-gameId='".$row['id']."'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>"
			];
			array_push($outputData['data'], $data);
		}
		echo json_encode($outputData);
	}
}
?>
