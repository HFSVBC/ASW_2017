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
	        ),
			array(
                'field' => 'TimeOutCheck',
                'label' => 'Time out',
                'rules' => 'trim|strip_tags',
	        ),
	        array(
                'field' => 'TimeOut',
                'label' => 'Time out',
                'rules' => 'trim|strip_tags|integer',
	        ),

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
				if($value['player_id'] == $this->session->userdata['loggedIn_asw004']['id'] && $game_state!='Terminado' && $game_state!='Jogo Invalidado'){
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
				$this->writeTimeOut($row['timeOut']),
				$game_state,
				$button_state
			];
			array_push($outputData['data'], $data);
		}
		echo json_encode($outputData);
	}
	private function writeTimeOut($data)
	{
		if ($data != NULL){
			return $data;
		}else{
			return "Sem timeout";
		}
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
				$validator['success']  = true;
				$resultPlayer  = $this->game_model->PlayerOnGame($this->session->userdata['loggedIn_asw004']['id']);
				$cardsRound    = $this->game_model->getGameRound($this->input->post('id_jogo'));
				$playerCards   = $resultPlayer->player_cards;
				$data = [
					strtotime(date('Y-m-d H:i:s'))-strtotime($resultGame->started_at),
					$resultGame->current_bet,
					$resultGame->current_pot,
					// array($playerCards[0], $playerCards[1]),
					$playerCards,
					$resultPlayer->player_folded,
					$cardsRound,

					$this->gameHistory($this->input->post('id_jogo')),
					$this->playersInGame($this->input->post('id_jogo')),
					$this->cardsOnTableNow($resultGame->table_cards, $cardsRound),

					$this->game_model->getUsernameById($resultGame->current_player),
					$this->game_model->getPlayerBalance($this->session->userdata['loggedIn_asw004']['id']) - $this->game_model->getPlayerBet($this->session->userdata['loggedIn_asw004']['id'], $this->input->post('id_jogo')),
				];
				array_push($validator['messages'], $data);
			}else{
				$validator['success']  = false;
				$validator['messages'] = array('Em Espera', 
												$this->playersInGame($this->input->post('id_jogo')),
												$this->game_model->getPlayerBalance($this->session->userdata['loggedIn_asw004']['id'])
											  );
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = array('Erro a validar a informa&ccedil;&atilde;o');
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
		$output = array();
		foreach ($result as $row) {
			$username = $this->game_model->getUsernameById($row['player_id']);
			$avatar   = "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
			array_push($output, array($username, $avatar));
		}
		return $output;
	}
	private function cardsOnTableNow($cards, $round){
		$cards = json_decode($cards);
		switch($round){
	    	case 1:
	            return [$cards[0],$cards[1],$cards[2]];
	    	case 2:
	            return [$cards[0],$cards[1],$cards[2],$cards[3]];
	    	case 3:

	        case 4:
	            return [$cards[0],$cards[1],$cards[2],$cards[3],$cards[4]];
    	}
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
				$deactivateButton = "";
				if($this->game_model->getGameActiveStatus($row['id']) == 1){
					$deactivateButton = "<button type='button' class='btn btn-danger deactivate-game active' data-gameId='".$row['id']."' data-activeUpdateStatus='0'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
				}else{
					$deactivateButton = "<button type='button' class='btn btn-danger deactivate-game' data-gameId='".$row['id']."' data-activeUpdateStatus='1'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
				}
				$data = [
					$row['name'],
					$row['description'],
					$this->game_model->getUsernameById($row['owner']),
					$this->game_model->getGameState($row['id']),
					$this->game_model->playersCount($row['id']),
					"<button type='button' class='btn btn-info details-game' data-toggle='modal' data-gameId='".$row['id']."' data-target='#gameDetails'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button>".$deactivateButton,
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
	public function ExcedingPot()
	{
		$result = $this->game_model->checksIfPotExceding();
		echo json_encode(array("sucess" => $result[0], "messages" => $result[1]);
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
	public function checkIfTimeOutActive(){
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
			$result = $this->game_model->timeOutActive();
			if($result[0] != False){
				$validator['success']  = true;
				$validator['messages'] = $result[1];
			}else{
				$validator['success']  = false;
				$validator['messages'] = 'Erro a obter o tempo restante para time out';
			}
		}else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o';
		}
		echo json_encode($validator);
	}
	public function checkTimeLeftForTimeOut()
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
			$result = $this->game_model->getTimeLeftforTimeOut();
			if($result != False){
				$validator['success']  = true;
				$validator['messages'] = $result;
			}else{
				$validator['success']  = false;
				$validator['messages'] = 'Erro a obter o tempo restante para time out';
			}
		}else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o';
		}
		echo json_encode($validator);
	}
	public function deactivateGame(){
		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'id_jogo',
	                'label' => 'Game id',
	                'rules' => 'trim|integer|required|strip_tags',
	        ),
	        array(
	                'field' => 'active',
	                'label' => 'active status',
	                'rules' => 'trim|integer|required|strip_tags',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			$result = $this->game_model->makeGameUnavailable();
			if($result != False){
				$validator['success']  = true;
				$validator['messages'] = "Jogo desativado com sucesso";
			}else{
				$validator['success']  = false;
				$validator['messages'] = 'Erro a desativar o jogo';
			}
		}else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informa&ccedil;&atilde;o';
		}
		echo json_encode($validator);
	}
}
?>
