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

			$sql = "INSERT INTO proj_game_request (owner, name, description, max_players, first_bet, max_bet)
					VALUES($owner, $game_name, $description, $max_players, $first_bet, $max_bet)";

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
		public function getPlayersInGame($game_id)
		{
			$sql = "SELECT player_id
					FROM proj_game_players
					WHERE id=$game_id";

			$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
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
		public function getGameOwner($id)
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
		public function getGameState($id)
		{
			$sql   = "SELECT started_at, ended_at
					  FROM proj_game_status
					  WHERE id='$id'";
			$query = $this->db->query($sql);
			$row   = $query->row();

			if(!empty($row)){
				if($row->ended_at === NULL){
					return 'A decorrer';
				}else{
					return 'Terminado';
				}
			}else{
				return 'Em espera';
			}
		}
		public function getGameHistory($game_id)
		{
			$sql    = "SELECT player_id, operation
					   FROM proj_game_hist
					   WHERE game_id=$game_id";
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
			$gameId     = $this->db->escape($this->input->post('id_jogo'));
		 	$playersNow = $this->playersCount($gameId);
		 	if($playersNow < 2){
				return $this->db->_error_message();
		 	}

			$timeNow        = date('Y-m-d H:i:s');
			$deck           = array("As de paus","Rei de paus","Dama de paus","Valete de paus", "10 de paus","9 de paus","8 de paus","7 de paus","6 de paus",
							   "5 de paus","4 de paus","3 de paus","2 de paus","As de copas","Rei de copas","Dama de copas","Valete de copas", "10 de copas","9 de copas",
							   "8 de copas","7 de copas","6 de copas","5 de copas","4 de copas","3 de copas","2 de copas","As de espadas","Rei de espadas","Dama de espadas",
							   "Valete de espadas", "10 de espadas","9 de espadas","8 de espadas","7 de espadas","6 de espadas","5 de espadas","4 de espadas","3 de espadas",
							   "2 de espadas","As de ouros","Rei de ouros","Dama de ouros","Valete de ouros", "10 de ouros","9 de ouros","8 de ouros","7 de ouros","6 de ouros",
							   "5 de ouros","4 de ouros","3 de ouros","2 de ouros");
			shuffle($deck);
			$table_cards    = array();
			for($i=0; $i<5; $i++){
				$x = rand(0, 52);
				array_push($table_cards, $deck[$x]);
			}
			$deck           = json_encode($deck);
			$table_cards    = json_encode($table_cards);
			$current_player = $this->getGameOwner($gameId);
			$current_bet    = $this->getGameMinBet($gameId);

			$sql = "INSERT INTO proj_game_status (id, started_at, deck, table_cards, current_player, current_bet, current_pot)
			 		 VALUES ($gameId, '$timeNow', '$deck', '$table_cards', $current_player, $current_bet, 0)";
			
			if($this->db->query($sql)){
				return $deck;
			}else{
				return $this->db->_error_message();
			}
		}
		public function giveCardsToPlayers($deck)
		{
			$deck   = json_decode($deck);
			$i      = 0;
			$gameId = $this->input->post('id_jogo');
			$sql    = "SELECT player_id
					   FROM proj_game_players
					   WHERE id=$gameId";
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $row) {
				$playerCards = json_encode(array($deck[$i], $deck[$i+1]));
				$i           = $i+2;
				$sql         = "UPDATE proj_game_players
								SET player_cards='$playerCards', player_bet=0
								WHERE id=$gameId AND player_id=".$row['player_id'];
				$query = $this->db->query($sql);
			}
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
		public function checksPlayerBet($id_jogo)
		{
			$sql  = "SELECT last_bet
					 FROM proj_game_players
					 WHERE id=$id_jogo AND player_folded=0";

			$query = $this->db->query($sql);
			$bet   = $this->getGameCurrentBet($id_jogo);
			$check = false;
			foreach ($query->result_array() as $row){
				if($row['last_bet'] == $bet){
					$check = true;
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
	  	public function PlayerRaised($player_id, $id_jogo, $all){
	  		$userBalance = $this->getPlayerBalance($player_id);
	  		$currentBet  = $this->getGameCurrentBet($id_jogo);
	  		if($all==0){
	  			$raise =  $userBalance;
	  		} else{
	  			$raise = $this->input->post('raiseAmount');
	  		}
	  		if ($raise > $currentBet){
	  			if($userBalance >= $raise){
	  				$sql = "UPDATE proj_game_players
	  						SET player_bet=player_bet+$raise, last_bet = $raise, betted=1
	  						WHERE id=$id_jogo AND player_id=$player_id";
		  			if($this->db->query($sql)){
		  				$result = $this->setCurrentPlayer($player_id, $id_jogo, $raise);
		  				$this->updateHist($player_id, $id_jogo, "$raise creditos");
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
	  		$next_player = $this->getGameOwner($id_jogo);
	  		$sql = "SELECT player_id, betted
					FROM proj_game_players
					WHERE id=$id_jogo AND player_folded=0
					ORDER BY player_id ASC";
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $row){
				if($row['betted'] == 0){
					$next_player = $row['player_id'];
					break;
				}
			}
			$sql = "UPDATE proj_game_status
					SET current_player = $next_player, current_pot=current_pot+$value
					WHERE id=$id_jogo";
			if($this->db->query($sql)){
				if($next_player == $this->getGameOwner($id_jogo)){
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
					if($checkBet && $round < 3){
						$sql = "UPDATE proj_game_status
								SET round = round+1
								WHERE id=$id_jogo";
						$this->db->query($sql);
					}
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
	  				WHERE game_id='$gameId'";

	  		$query = $this->db->query($sql);
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
	  	}

	  	public function updateBalance($id,$user)
	  	{
	  		//Partimos do inicio que o pagamento a casa
	  		//e igual ao minBet
	  		$tax = $this->getGameMinBet($id);
	  		$sql = "UPDATE proj_users 
	  				SET balance=balance-$tax
	  				WHERE id=$user ";
	  		$this->db->query($sql);
	  	}

  	}
?>
