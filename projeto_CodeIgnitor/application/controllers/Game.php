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
					$this->game_model->updateBalance($this->input->post('id_jogo'), $this->session->userdata['loggedIn_asw004']['id']);
					if($this->game_model->checksConditionstoStart()){
						$this->game_model->startGame();
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
			$players = $this->game_model->getPlayersInGame($row['id']);
			foreach ($players as $value) {
				if($value['player_id'] == $this->session->userdata['loggedIn_asw004']['id'] && $game_state!='Terminado'){
					$button_state = "<button class='btn btn-info gameJoin gameJoin-BTN' data-gameId='".$row['id']."'><span ><i class='glyphicon glyphicon-play' aria-hidden='true'></i></span></button>";
				}
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
				$result = $this->game_model->PlayerFolded($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'));
				$validator['success']  = $result;
				$validator['messages'] = "You folded your hand";
			} elseif($action=="Cobrir"){
				$result = $this->game_model->PlayerCalled($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'));
				$validator['success']=$result;
				$validator['messages'] = "You called the bet";
			} elseif($action=="Aumenta"){
				$result = $this->game_model->PlayerRaised($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'),0);
				$validator['success']=$result;
				$validator['messages']="You raised the bet";
			} elseif($action=="AllIn"){
				$result = $this->game_model->PlayerRaised($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo'),1);
				$validator['success']=$result;
				$validator['messages']="You're all in";
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o'.validation_errors();
		}

		echo json_encode($validator);
	}
	public function getGamesDataAdmin($state_op)
	{
		$outputData = array('data' => array());

		$result = $this->game_model->getGamesDataAdmin();
		foreach ($result as $row) {
			if ($this->checkAdvSearch($row['id'], $state_op)){
				$data = [
					$row['name'],
					$row['description'],
					$this->game_model->getUsernameById($row['owner']),
					$this->game_model->getGameState($row['id']),
					$this->game_model->playersCount($row['id']),
					"<button type='button' class='btn btn-info details-game' data-toggle='modal' data-gameId='".$row['id']."' data-target='#gameDetails'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button>"
				];
				array_push($outputData['data'], $data);
			}
		}
		echo json_encode($outputData);
	}
	public function checkAdvSearch($id_jogo, $state_op)
	{
		$result = $this->game_model->getGameState($id_jogo);
		switch ($state_op) {
			case 'NULL':
				return true;
				break;
			case '1':
				return $result == 'Em espera';
				break;
			case '0':
				return $result == 'A decorrer';
				break;
			case '-1':
				return $result == 'Terminado';
				break;
		}
	}
	public function gameAdmInfo()
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

			$requestGameInfo = $this->game_model->requestGameInfoAdm();
			$gameStatusInfo  = $this->game_model->gameStatusInfoAdm();
			$gamePlayersInfo = $this->game_model->gamePlayersInfoAdm();
			$gameHistInfo    = $this->gameHistory($this->input->post('id_jogo'));
			
			$validator['success']  = true;
			$validator['messages'] = array();
			$data = [
				$requestGameInfo->name,
				$requestGameInfo->description,
				$this->game_model->getUsernameById($requestGameInfo->owner),
				$this->game_model->getUsernameById($gameStatusInfo->current_player),
				$gameStatusInfo->started_at,
				$gameStatusInfo->ended_at,
				$gameStatusInfo->current_pot,
				$gameStatusInfo->current_bet,
				$gameStatusInfo->table_cards,
				$this->playersTablePerGameAdm($gamePlayersInfo),
				$gameHistInfo,
			];
			array_push($validator['messages'], $data);
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o'.validation_errors();
		}

		echo json_encode($validator);
	}
	public function playersTablePerGameAdm($info)
	{
		$output = "";
		foreach ($info as $row) {
			$output .= "
						<tr>
							<td>".$this->game_model->getUsernameById($row['player_id'])."</td>
							<td>".$row['player_cards']."</td>
							<td>".$row['player_bet']."</td>
							<td>".$this->playerFoldedToString($row['player_folded'])."</td>
						</tr>";
		}
		return $output;
	}
	public function playerFoldedToString($value){
		if($value == 0){
			return "Não";
		}else{
			return "Sim";
		}
	}
}
?>
