<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Game_model extends CI_Model {
	// redo method with new database schema
	public function create($username)
	{
		$owner     = $username
		$game_name     = $this->db->escape($this->input->post('game_name'));
		$description  = $this->db->escape($this->input->post('description'));
		$max_players     = $this->db->escape($this->input->post('max_players'));
		$first_bet 			= $this->db->escape($this->input->post('first_bet'));

		$sql = "INSERT INTO proj_game_resquest (owner, name, description, max_players, first_bet)
				VALUES('$owner', $game_name, $description, $max_players, $first_bet)";

		if($this->db->simple_query($sql)){
					$owner_id = $this->getIdByUsername($username);
					$this-> createGameP($owner_id);
		}else{
					return false;
		}
	}
	public function createGameP($id)
	{
			$sql = "INSERT INTO proj_game_players (player_id,player_folded)
			VALUES($id,false)";
	}
	private function getIdByUsername($username)
	{
		$sql = "SELECT id FROM proj_users WHERE username=$username LIMIT 1";
		$row   = $query->row();

		if(!empty($row)){
			return $row->id;
		}else{
			return False;
		}

	}
  }
?>
