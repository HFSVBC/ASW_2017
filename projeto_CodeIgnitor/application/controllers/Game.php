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
	        ),
			array(
                'field' => 'maxBet',
                'label' => 'Maximum bet of the round',
                'rules' => 'trim|numeric|strip_tags',
	        )
			// array(
   //              'field' => 'beginHour',
   //              'label' => 'Beggining hour of the game',
   //              'rules' => 'trim|strip_tags',
	  //       ),
			// array(
   //              'field' => 'firstBet',
   //              'label' => 'First bet in the game',
   //              'rules' => 'trim|numeric|required|strip_tags',
	  //       )
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
				$validator['messages'] = 'Jogador com balanço inferior a aposta minima';
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
			if(!$this->game_model->checksIfAlreadyAdded($this->input->post('id_jogo'), $this->session->userdata['loggedIn_asw004']['id'])){
				$result = $this->game_model->createGameP($this->input->post('id_jogo'), $this->session->userdata['loggedIn_asw004']['id']);
				if($result === true){
					$validator['success']  = true;
					$validator['messages'] = 'Utilizador adicionado ao jogo com sucesso';
					if($this->game_model->checksConditionstoStart()){
						$result = $this->game_model->startGame();
						$this->game_model->giveCardsToPlayers($result);
					}
				}else{
					$validator['success']  = false;
					$validator['messages'] = 'Jogador com balanço inferior a aposta minima';
				}
			}else{
				$validator['success']  = true;
				$validator['messages'] = 'Utilizador ja adicionado ao jogo';
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
			$game_state = $this->game_model->getGameState($row['id']);
			if($game_state=='Em espera'){
				$button_state = "<button class='btn btn-success gameJoin gameJoin-BTN' data-gameId='".$row['id']."'><span> <i class='glyphicon glyphicon-ok' aria-hidden='true'></i></span></button>";
			}else{
				$button_state = "<button class='btn btn-danger disabled gameJoin' data-gameId='".$row['id']."'><span ><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></span></button>";
			}
			$data = [
				$row['name'],
				$row['description'],
				$this->game_model->getUsernameById($row['owner']),
				$this->game_model->playersCount($row['id']),
				$row['max_players'],
				$row['first_bet'],
				$row['max_bet'],
				$game_state,
				$button_state
			];
			array_push($outputData['data'], $data);
		}
		echo json_encode($outputData);
	}
	public function getGameInfo()
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
			$resultGame = $this->game_model->gameInfo();
			if($resultGame != false){
				$resultPlayer  = $this->game_model->PlayerOnGame($this->session->userdata['loggedIn_asw004']['id']);
				$playerCredits = $this->game_model->getPlayerBalance($this->session->userdata['loggedIn_asw004']['id'])-$this->game_model->getPlayerBet($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'));
				$cardsRound    = $this->game_model->getGameRound($this->input->post('id_jogo'));
				$history       = $this->gameHistory($this->input->post('id_jogo'));
				if($resultPlayer->player_folded=='1'){
					$validator['success']  = true;
					$validator['messages'] = array();
					$data = [
						$resultGame->started_at,
						$this->game_model->getUsernameById($resultGame->current_player),
						$resultGame->table_cards,
						'Desististe',
						$resultGame->current_bet,
						$playerCredits,
						$cardsRound,
						$history,
						$resultGame->current_pot,
						$this->playersInGame($this->input->post('id_jogo')),
					];
				} else{
					$validator['success']  = true;
					$validator['messages'] = array();
					$data = [
						$resultGame->started_at,
						$this->game_model->getUsernameById($resultGame->current_player),
						$resultGame->table_cards,
						$resultPlayer->player_cards,
						$resultGame->current_bet,
						$playerCredits,
						$cardsRound,
						$history,
						$resultGame->current_pot,
						$this->playersInGame($this->input->post('id_jogo')),
					];
				}
				array_push($validator['messages'], $data);
			}else{
				$validator['success']  = false;
				$validator['messages'] = 'Em Espera';
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o'.validation_errors();
		}

		echo json_encode($validator);
	}
	public function gameHistory($game_id)
	{
		$result = $this->game_model->getGameHistory($game_id);
		$output = "";
		foreach ($result as $row) {
			$username = $this->game_model->getUsernameById($row['player_id']);
			$output  .="<span>".$username.": ".$row['operation']."</span><br>";
		}
		return $output;
	}
	public function playersInGame($game_id)
	{
		$result = $this->game_model->getPlayersInGame($game_id);
		$output = "";
		foreach ($result as $row) {
			$username = $this->game_model->getUsernameById($row['player_id']);
			$output  .=$username."&#8192;";
		}
		return $output;
	}
	public function playerAction($action){

		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'id_jogo',
	                'label' => 'Game id',
	                'rules' => 'trim|integer|required|strip_tags',
	        ),
	        array(
	                'field' => 'raiseAmount',
	                'label' => 'raiseAmount',
	                'rules' => 'trim|numeric|strip_tags',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			if($action=='Desistir'){
				$this->game_model->PlayerFolded($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'));
				$validator['success']  = true;
				$validator['messages'] = "You folded your hand";
			} elseif($action=="Cobrir"){
				$this->game_model->PlayerCalled($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'));
				$validator['success']=true;
				$validator['messages'] = "You called the bet";
			} elseif($action=="Aumenta"){
				$result = $this->game_model->PlayerRaised($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'));
				$validator['success']=true;
				$validator['messages']="You raised the bet";
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o'.validation_errors();
		}

		echo json_encode($validator);
	}
}
?>
