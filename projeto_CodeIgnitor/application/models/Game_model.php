<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Game_model extends CI_Model {
		public function create($username)
		{
			$result      = false;

			$owner       = $this->getIdByUsername($username);
			$game_name   = $this->db->escape($this->input->post('name'));
			$description = $this->db->escape($this->input->post('description'));
			$max_players = $this->db->escape($this->input->post('numberPeople'));
			$first_bet 	 = $this->db->escape($this->input->post('firstBet'));
			$max_bet 	 = $this->db->escape($this->input->post('maxBet'));
			$TimeOut 	 = $this->db->escape($this->input->post('TimeOut'));

			if (isset($TimeOut)){
				$sql = "INSERT INTO proj_game_request (owner, name, description, max_players, first_bet, max_bet, timeOut)
						VALUES($owner, $game_name, $description, $max_players, $first_bet, $max_bet, $TimeOut)";
			}else{
				$sql = "INSERT INTO proj_game_request (owner, name, description, max_players, first_bet, max_bet)
						VALUES($owner, $game_name, $description, $max_players, $first_bet, $max_bet)";
			}
			if($this->db->simple_query($sql)){
			 	$owner_id = $this->getIdByUsername($username);
				$last_id  = $this->db->insert_id();
				$result = $this->createGameP($last_id, $owner_id);
				if($result!==true){
					$sql_del = "DELETE FROM proj_game_request WHERE id = $last_id";
					$this->db->simple_query($sql_del);
				}
			}else{
				$result = $this->db->_error_message();
			}
			return $result;
		}
		public function createGameP($gameid ,$id)
		{			
			$gameid        = $this->db->escape($gameid);
			$gameMinBet    = $this->getGameMinBet($gameid);
			$playerBalance = $this->getPlayerBalance($id);

			if ($playerBalance >= $gameMinBet){
				$sql = "INSERT INTO proj_game_players (id, player_id, player_folded)
						VALUES($gameid, $id, false)";

				if($this->db->query($sql)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function checksIfAlreadyAdded($gameid ,$id)
		{
			$gameid = $this->db->escape($gameid);
			$sql = "SELECT id
					FROM proj_game_players
					WHERE id=$gameid AND player_id=$id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return true;
			}else{
				return false;
			}
		}
		public function getAllGames()
		{
			$sql   = "SELECT * FROM proj_game_request";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		public function getAllGamesByUser($id)
		{
			$sql   = "SELECT * FROM proj_game_request WHERE id IN (SELECT id FROM proj_game_players WHERE player_id='$id')";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		public function gameInfo()
		{
			$gameId = $this->db->escape($this->input->post('id_jogo'));

			$sql = "SELECT *
					FROM proj_game_status
					WHERE id=$gameId";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row;
			}else{
				return false;
			}
		}
		public function getGameInit($id)
		{
			$sql = "SELECT started_at
					FROM proj_game_status
					WHERE id=$id
					LIMIT 1";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->started_at;
			}else{
				return "";
			}
		}
		public function getPlayersInGame($game_id)
		{
			$sql = "SELECT player_id
					FROM proj_game_players
					WHERE id=$game_id AND player_id!=(SELECT owner FROM proj_game_request WHERE id=$game_id)
					ORDER BY player_id ASC";

			$query = $this->db->query($sql);
			if($query){
				$result = array();
				array_push($result, $this->getGameOwner($game_id));
				foreach ($query->result_array() as $row) {
					array_push($result, $row['player_id']);
				}
				return $result;
			}else{
				return false;
			}
		}
		public function PlayerOnGame($playerId)
		{
			$gameId = $this->db->escape($this->input->post('id_jogo'));

			$sql = "SELECT player_cards, player_bet, player_folded
					FROM proj_game_players
					WHERE id=$gameId AND player_id='$playerId'
					LIMIT 1";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row;
			}else{
				return false;
			}
		}
		public function getGamesOwner()
		{
			$sql = "SELECT owner
					FROM proj_game_request";

			$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
		}
		private function getGameOwner($id)
		{
			$sql = "SELECT owner
					FROM proj_game_request
					WHERE id=$id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->owner;
			}else{
				return false;
			}
		}
		public function getGameLastRaised($id){
			$sql = "SELECT last_to_raise
					FROM proj_game_status
					WHERE id=$id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->last_to_raise;
			}else{
				return false;
			}
		}
		public function getGameRound($id)
		{
			$sql = "SELECT round
					FROM proj_game_status
					WHERE id=$id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->round;
			}else{
				return false;
			}
		}
		public function getPlayerBalance($id)
		{
			$sql = "SELECT balance
					FROM proj_users
					WHERE id=$id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->balance;
			}else{
				return false;
			}
		}
		public function getPlayerBet($player_id, $game_id)
		{
			$sql = "SELECT player_bet
					FROM proj_game_players
					WHERE id=$game_id AND player_id=$player_id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->player_bet;
			}else{
				return false;
			}
		}
		public function getGameMinBet($id)
		{
			$sql = "SELECT first_bet
					FROM proj_game_request
					WHERE id=$id";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->first_bet;
			}else{
				return false;
			}
		}
		public function getGameCurrentBet($id)
  		{
  			$sql = "SELECT current_bet
					FROM proj_game_status
					WHERE id='$id'";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->current_bet;
			}else{
				return false;
			}
  		}
		private function getGameMaxPlayers($id)
		{
			$sql = "SELECT max_players
					FROM proj_game_request
					WHERE id='$id'";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->max_players;
			}else{
				return false;
			}
		}
		public function playersCount($id)
		{
			$sql   = "SELECT count(player_id) as total
					  FROM proj_game_players
					  WHERE id='$id'";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->total;
			}else{
				return false;
			}
		}
		public function activePlayersCount($id)
		{
			$sql   = "SELECT count(player_id) as total
					  FROM proj_game_players
					  WHERE id='$id' AND player_folded=0";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->total;
			}else{
				return false;
			}
		}
		public function getGameState($id)
		{
			$sql   = "SELECT started_at, ended_at
					  FROM proj_game_status
					  WHERE id='$id'";
			$query = $this->db->query($sql);
			$row   = $query->row();

			$sql2   = "SELECT active
					  FROM proj_game_request
					  WHERE id='$id'";
			$query2 = $this->db->query($sql2);
			$row2   = $query2->row();

			if(!empty($row)){
				if($row->ended_at === NULL){
					if($row2->active == '0'){
						return 'Jogo Invalidado';
					}else{
						return 'A decorrer';
					}
				}else{
					return 'Terminado';
				}
			}else{
				if($row2->active == '0'){
					return 'Jogo Invalidado';
				}else{
					return 'Em espera';
				}
			}
		}
		public function getGameHistory($game_id)
		{
			$sql    = "SELECT player_id, operation
					   FROM proj_game_hist
					   WHERE game_id=$game_id
					   ORDER BY time_stamp DESC";
			$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
		}
		public function checksConditionstoStart()
		{
			$gameId = $this->input->post('id_jogo');

		 	$playersNow = $this->playersCount($gameId);
		 	$maxPlayers = $this->getGameMaxPlayers($gameId);

		 	if($playersNow == $maxPlayers){
		 		return true;
		 	}else{
		 		return false;
		 	}

		}
		public function startGame()
        {
            $gameId         = $this->db->escape($this->input->post('id_jogo'));
            $timeNow        = date('Y-m-d H:i:s');
            $deck           = array("As de paus","Rei de paus","Dama de paus","Valete de paus", "10 de paus","9 de paus","8 de paus","7 de paus","6 de paus",
                               "5 de paus","4 de paus","3 de paus","2 de paus","As de copas","Rei de copas","Dama de copas","Valete de copas", "10 de copas","9 de copas",
                               "8 de copas","7 de copas","6 de copas","5 de copas","4 de copas","3 de copas","2 de copas","As de espadas","Rei de espadas","Dama de espadas",
                               "Valete de espadas", "10 de espadas","9 de espadas","8 de espadas","7 de espadas","6 de espadas","5 de espadas","4 de espadas","3 de espadas",
                               "2 de espadas","As de ouros","Rei de ouros","Dama de ouros","Valete de ouros", "10 de ouros","9 de ouros","8 de ouros","7 de ouros","6 de ouros",
                               "5 de ouros","4 de ouros","3 de ouros","2 de ouros");
            shuffle($deck);
            $table_cards    = array();
            //Dar cartas a players
            $deck = $this->giveCardsToPlayers($deck);
            //Enviar table cards, falta queimar cartas --> EXTRA
            array_push($table_cards, array_shift($deck), array_shift($deck), array_shift($deck), array_shift($deck), array_shift($deck));
            $deck           = json_encode($deck);
            $table_cards    = json_encode($table_cards);
            $current_player = $this->getGameOwner($gameId);
            $current_bet    = $this->getGameMinBet($gameId);
            $timeNow		= date('Y-m-d H:i:s');

            $sql = "INSERT INTO proj_game_status (id, started_at, deck, table_cards, current_player, initTurnTime, current_bet, current_pot)
                      VALUES ($gameId, '$timeNow', '$deck', '$table_cards', $current_player, '$timeNow', $current_bet, 0)";

            if($this->db->query($sql)){
                return true;
            }else{
                return false;
            }
        }

		public function endGame(){
			$gameId = $this->db->escape($this->input->post('id_jogo'));
			$timeNow        = date('Y-m-d H:i:s');

			$sql = "UPDATE proj_game_status
					SET ended_at=$timeNow
					id=$id";
			if($this->db->query($sql)){
                return true;
            }else{
                return false;
            }		
		}
        private function giveCardsToPlayers($deck)
        {
            $gameId = $this->input->post('id_jogo');
            $sql    = "SELECT player_id
                       FROM proj_game_players
                       WHERE id=$gameId";
            $query = $this->db->query($sql);
            foreach ($query->result_array() as $row) {
                //isto da 2 cartas de cada vez para cada jogador
                $playerCards = array(array_shift($deck), array_shift($deck));
                $playerCards = json_encode($playerCards);
                $sql         = "UPDATE proj_game_players
                                SET player_cards='$playerCards', player_bet=0
                                WHERE id=$gameId AND player_id=".$row['player_id'];
                $query = $this->db->query($sql);
            }
            return $deck;
		}
		private function getIdByUsername($username)
		{
			$sql   = "SELECT id FROM proj_users WHERE username='$username' LIMIT 1";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->id;
			}else{
				return false;
			}

		}
		public function getUsernameById($id)
		{
			$sql   = "SELECT username FROM proj_users WHERE id='$id' LIMIT 1";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return $row->username;
			}else{
				return false;
			}
		}
		public function checksIfPotExceding()
		{
			$sql   = "SELECT name FROM proj_game_request WHERE id=(SELECT id FROM proj_game_status WHERE current_bet > 10000)";
			$query = $this->db->query($sql);
			$exceding_ids = array();

			foreach ($query->result_array() as $row){
				array_push($exceding_ids, $row['name']);
			}
			if(!empty($exceding_ids)){
				return array(true, $exceding_ids);
			}else{
				return array(false, NULL);
			}
		}
		public function checksPlayerBet($id_jogo)
		{
			$sql  = "SELECT last_bet
					 FROM proj_game_players
					 WHERE id=$id_jogo AND player_folded=0";

			$query = $this->db->query($sql);
			$bet   = $this->getGameCurrentBet($id_jogo);
			$check = true;
			foreach ($query->result_array() as $row){
				if($row['last_bet'] != $bet){
					$check = false;
				}
			}
			return $check;
		}
		public function checksPlayerFolded($player_id, $id_jogo)
		{
			$sql   = "SELECT * 
					  FROM proj_game_players
					  WHERE id=$id_jogo AND player_id=$player_id AND player_folded=1";

			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return true;
			}else{
				return false;
			}
		}
		public function checksAllIn($id_jogo)
		{
			$sql = "SELECT allin
					FROM proj_game_players
					WHERE id=$id_jogo AND allin=1
					LIMIT 1";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return true;
			}else{
				return false;
			}
		}
		public function checksAllInPlayer($player_id, $id_jogo)
		{
			$sql = "SELECT allin
					FROM proj_game_players
					WHERE id=$id_jogo AND player_id=$player_id AND allin=1
					LIMIT 1";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return true;
			}else{
				return false;
			}
		}
		public function PlayerFolded($player_id, $id_jogo)
		{
			$currentBet  = $this->getGameCurrentBet($id_jogo);
			$sql = "UPDATE proj_game_players 
					SET player_folded=1 
					WHERE player_id=$player_id AND id=$id_jogo";
			if($this->db->query($sql)){
  				$this->setCurrentPlayer($player_id, $id_jogo, $currentBet);
  				$this->updateHist($player_id, $id_jogo, "desistiu");
  				return true;
  			}else{
  				return false;
  			}
		}
	  	public function PlayerCalled($player_id, $id_jogo)
	  	{
	  		$currentBet  = $this->getGameCurrentBet($id_jogo);
	  		$userBalance = $this->getPlayerBalance($player_id);
	  		if ($userBalance>=$currentBet){
	  			$sql = "UPDATE proj_game_players
	  					SET player_bet=player_bet+$currentBet, last_bet = $currentBet, betted=1
	  					WHERE id=$id_jogo AND player_id=$player_id";
	  			if($this->db->query($sql)){
	  				$this->setCurrentPlayer($player_id, $id_jogo, $currentBet);
	  				$this->updateHist($player_id, $id_jogo, "$currentBet creditos");
	  				return true;
	  			}else{
	  				return false;
	  			}
	  		}else{
	  			$this->PlayerFolded($player_id, $id_jogo);
	  		}

	  	}
	  	public function PlayerRaised($player_id, $id_jogo, $flag){
	  		$userBalance = $this->getPlayerBalance($player_id);
	  		$currentBet  = $this->getGameCurrentBet($id_jogo);
	  		$raise   = $this->input->post('raiseAmount');
	  		if ($flag == 1 || $raise > $currentBet){
	  			if($flag == 1 || $userBalance >= $raise){
	  				$sql = "UPDATE proj_game_players
	  						SET player_bet=player_bet+$raise, last_bet = $raise, betted=1, allIn=$flag
	  						WHERE id=$id_jogo AND player_id=$player_id";
		  			if($this->db->query($sql)){
		  				$result = $this->setCurrentPlayer($player_id, $id_jogo, $raise);
		  				if ($flag == 0){
		  					$this->updateHist($player_id, $id_jogo, "$raise creditos");
		  				}else{
		  					$this->updateHist($player_id, $id_jogo, "$raise creditos, AllIn");
		  				}
		  				$sql = "UPDATE proj_game_status
								SET last_to_raise = $player_id, current_bet = $raise
								WHERE id=$id_jogo";
						$this->db->query($sql);
		  				return $result;
		  			}else{
		  				return false;
		  			}
	  			}else{
	  				return false;
	  			}
	  		}else{
	  			return false;
	  		}
	  	}
	  	public function setCurrentPlayer($player_id, $id_jogo, $value)
	  	{
	  		$next_player = NULL;
	  		if($this->activePlayersCount($id_jogo) > 1){
	  			$next_player = $this->getGameOwner($id_jogo);
		  		$sql = "SELECT player_id, betted
						FROM proj_game_players
						WHERE id=$id_jogo AND player_folded=0 AND allIn=0
						ORDER BY player_id ASC";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0){
					foreach ($query->result_array() as $row){
						if($row['betted'] == 0){
							$next_player = $row['player_id'];
							break;
						}
					}
				}else{
					$next_player = NULL;
				}
			}
			$timeNow = date('Y-m-d H:i:s');
			if($next_player != NULL){
				$sql = "UPDATE proj_game_status
						SET current_player = $next_player, current_pot=current_pot+$value, initTurnTime='$timeNow'
						WHERE id=$id_jogo";
			}else{
				$sql = "UPDATE proj_game_status
						SET current_player = NULL, current_pot=current_pot+$value, initTurnTime='$timeNow'
						WHERE id=$id_jogo";
			}
			if($this->db->query($sql)){
				if($next_player != NULL && ($next_player == $this->getGameLastRaised($id_jogo) || $next_player == $this->getGameOwner($id_jogo))){
					$sql = "UPDATE proj_game_players
							SET betted = 0
							WHERE id=$id_jogo";
					$this->db->query($sql);
					$result = $this->checksPlayerFolded($next_player, $id_jogo);
					if($result){
						$this->setCurrentPlayer($player_id, $id_jogo, 0);
					}
					$checkBet = $this->checksPlayerBet($id_jogo);
					$round    = $this->getGameRound($id_jogo);
					if($checkBet && $round < 5){
						$sql = "UPDATE proj_game_status
								SET round = round+1
								WHERE id=$id_jogo";
						$this->db->query($sql);
					}
				}else if ($next_player == NULL){
					$sql = "UPDATE proj_game_status
							SET round = 4
							WHERE id=$id_jogo";
					$this->db->query($sql);
				}
				return true;
			}else{
				return false;
			}
	  	}
	  	public function updateHist($player_id, $id_jogo, $op)
	  	{
	  		$sql = "INSERT INTO proj_game_hist (game_id, player_id, operation)
	  				VALUES ($id_jogo, $player_id, '$op')";
	  		if($this->db->query($sql)){
				return true;
			}else{
				return false;
			}
	  	}
	  	public function getGamesDataAdmin()
	  	{
	  		$sql = "SELECT *
	  				FROM proj_game_request";

	  		$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
	  	}
	  	public function requestGameInfoAdm()
	  	{
	  		$gameId = $this->input->post('id_jogo');
	  		$sql = "SELECT *
	  				FROM proj_game_request
	  				WHERE id=$gameId";

	  		$query = $this->db->query($sql);
	  		$row   = $query->row();
			if(!empty($row)){
				return $row;
			}else{
				return false;
			}
	  	}
	  	public function gameStatusInfoAdm()
	  	{
	  		$gameId = $this->input->post('id_jogo');
	  		$sql = "SELECT *
	  				FROM proj_game_status
	  				WHERE id='$gameId'";

	  		$query = $this->db->query($sql);
	  		$row   = $query->row();
			if(!empty($row)){
				return $row;
			}else{
				return false;
			}
	  	}
	  	public function gamePlayersInfoAdm()
	  	{
	  		$gameId = $this->input->post('id_jogo');
	  		$sql = "SELECT player_id, player_cards, player_bet, player_folded
	  				FROM proj_game_players
	  				WHERE id='$gameId'";

	  		$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
	  	}
	  	public function gameHistInfo()
	  	{
	  		$gameId = $this->input->post('id_jogo');
	  		$sql = "SELECT *
	  				FROM proj_game_hist
	  				WHERE game_id='$gameId'
	  				ORDER BY time_stamp DESC";

	  		$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
	  	}

	  	public function updateBalance($id,$user)
	  	{
	  		//a casa recebeo valor da minBet
	  		$tax = $this->getGameMinBet($id);
	  		$sql = "UPDATE proj_users
	  		 		SET balance=balance-$tax 
	  		 		WHERE id=$user";
	  		$this->db->query($sql);
	  	}
	  	public function timeOutActive(){
	  		$gameId = $this->db->escape($this->input->post('id_jogo'));
	  		$sql = "SELECT timeOut
	  				FROM proj_game_request
	  				WHERE id=$gameId
	  				LIMIT 1";

	  		$query = $this->db->query($sql);
	  		$row   = $query->row();
	  		if(!empty($row)){
	  			if(isset($row->timeOut)){
	  				return array(true, true);
	  			}else{
	  				return array(true, false);
	  			}
	  		}else{
	  			return array(false, false);
	  		}
	  	}
	  	public function getTimeLeftforTimeOut(){
	  		$gameId = $this->db->escape($this->input->post('id_jogo'));
	  		$sql = "SELECT initTurnTime
	  				FROM proj_game_status
	  				WHERE id=$gameId
	  				LIMIT 1";

	  		$query = $this->db->query($sql);
	  		$row   = $query->row();
			if(!empty($row)){
				$timeStarted = strtotime($row->initTurnTime);
				$timeNow     = strtotime(date('Y-m-d H:i:s'));
				$timePassedSiceBeginning = $timeNow - $timeStarted;

				$sql = "SELECT timeOut
		  				FROM proj_game_request
		  				WHERE id=$gameId
		  				LIMIT 1";

		  		$query = $this->db->query($sql);
		  		$row   = $query->row();
		  		if(!empty($row)){
		  			return $row->timeOut - $timePassedSiceBeginning;
		  		}else{
		  			return false;
				}
			}else{
				return false;
			}

	  	}
	  	public function makeGameUnavailable(){
	  		$gameId = $this->db->escape($this->input->post('id_jogo'));
	  		$active = $this->db->escape($this->input->post('active'));
	  		$sql    = "UPDATE proj_game_request
	  				   SET active = $active
	  				   WHERE id=$gameId"; 

	  		if($this->db->query($sql)){
	  			return true;
	  		}else{
	  			return flase;
	  		}
	  	}
	  	public function getGameActiveStatus($id){
	  		$sql = "SELECT active
	  				FROM proj_game_request
	  				WHERE id='$id'
	  				LIMIT 1";

	  		$query = $this->db->query($sql);
	  		$row   = $query->row();
	  		if(!empty($row)){
	  			return $row->active;
	  		}else{
	  			return false;
			}
	  	}
	  	public function getAdvanceSearchResult($id, $jogMin, $jogMax, $betMin, $betMax, $dateMin, $dateMx, $user)
	  	{
	  		$sql = "SELECT gs.id 
	  				FROM proj_game_status gs 
	  				WHERE id=$id"; 
	  				// "1 <= (SELECT count(player_id) as total FROM proj_game_players WHERE id=gs.id) <= 2 ";
	  		if($jogMin != 'NULL'){
	  			$sql .= " AND $jogMin <= (SELECT count(player_id) as total FROM proj_game_players WHERE id=gs.id)";
	  		}
	  		if($jogMax != 'NULL'){
	  			$sql .= " AND (SELECT count(player_id) as total FROM proj_game_players WHERE id=gs.id) <= $jogMax";
	  		}
	  		if($betMin != 'NULL'){
	  			$sql .= " AND $betMin <= (SELECT first_bet FROM proj_game_request WHERE id=gs.id)";
	  		}
	  		if($betMax != 'NULL'){
	  			$sql .= " AND (SELECT first_bet FROM proj_game_request WHERE id=gs.id) <= $betMax";
	  		}
	  		if($dateMin != "NULL"){
				$sql .= " AND DATEDIFF(started_at, '$dateMin') >= 0";
			}
			if($dateMx != "NULL"){
				$sql .= " AND DATEDIFF('$dateMx', started_at) >= 0";
			}
			if($user != "NULL"){
				$sql .= " AND $user = (SELECT owner FROM proj_game_request WHERE id=gs.id)";
			}
			
			$sql .= " LIMIT 1";

			$query  = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				return true;
			}else{
				return false;
			}
	  	}
  	}
?>
