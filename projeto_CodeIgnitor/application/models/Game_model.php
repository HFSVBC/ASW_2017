<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Game_model extends CI_Model {
	// redo method with new database schema
	public function create($username)
	{
		$result      = false;

		$owner       = $this->getIdByUsername($username);
		$game_name   = $this->db->escape($this->input->post('name'));
		$description = $this->db->escape($this->input->post('description'));
		$max_players = $this->db->escape($this->input->post('numberPeople'));
		$first_bet 	 = $this->db->escape($this->input->post('firstBet'));

		$sql = "INSERT INTO proj_game_request (owner, name, description, max_players, first_bet)
				VALUES($owner, $game_name, $description, $max_players, $first_bet)";

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
			$gameid = $this->db->escape($gameid);
			$sql = "INSERT INTO proj_game_players (id, player_id, player_folded)
			VALUES($gameid, $id, false)";

			if($this->db->simple_query($sql)){
				return true;
			}else{
				return $this->db->_error_message();
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
	public function checksConditionstoStart()
	{
		$sql = "SELECT max_players FROM proj_game_request";

	}
	// private function checksToBeAdded()
	// {
	//
//	}
  }
?>
