<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IpajSoapServer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('game_model');

		$this->load->library("Nusoap_lib"); //load the library here
		$this->nusoap_server = new soap_server();
		$wsdl = base_url() . 'SOAP/IpajSoapServer?wsdl';
		$this->nusoap_server->configureWSDL("Poker Online SOAP Server", $wsdl, $wsdl);
		$this->nusoap_server->wsdl->schemaTargetNamespace = $wsdl;
		$this->nusoap_server->register(
			"InfoPartida",
			array("ID"=>"xsd:integer"),
			array("return"=>"xsd:string"), //mudar o tipo de retorno conforme pretendido
			"urn:IpajSoapServer",
			"urn:IpajSoapServer#InfoPartida",
			"rpc",
			"encoded",
			"Returns the information of a game"
		);
		$this->nusoap_server->register(
			"ApostaJogo",
			array("ID"=>"xsd:integer", "username"=>"xsd:string", "password"=>"xsd:string", "jogada"=>"xsd:string", "valor"=>"xsd:integer"), //valor e opcional
			array("return"=>"xsd:string"), //mudar o tipo de retorno conforme pretendido
			"urn:IpajSoapServer",
			"urn:IpajSoapServer#ApostaJogo",
			"rpc",
			"encoded",
			"Returns 'aceite' if play is acceptable, else returns 'Nao aceite'"
		);

		function InfoPartida($ID)
		{
			$ci =& get_instance();
			
			// $data = [
			// 	$info_game->id,
			// 	$info_game->started_at,
			// 	$info_game->ended_at,
			// 	$info_game->current_player,
			// 	$info_game->current_bet,
			// 	$info_game->current_pot,
			// 	$info_game->last_to_raise,
			// 	$info_game->deck,
			// 	$info_game->table_cards,

			// ];
			$resultGame    = $ci->game_model->gameInfo($ID);
			$cardsRound    = $ci->game_model->getGameRound($ID);

			$data = array(
				'inicio'              => $resultGame->started_at,
				'jogadorAtual'        => $ci->game_model->getUsernameById($resultGame->current_player),
				'cartasNaMesa'        => _cardsOnTableNow($resultGame->table_cards, $cardsRound),
				'apostaAtual'         => $resultGame->current_bet,
				'apostaDeCadaJogador' => _gameHistory($ID), //pedido ao modelo
			);
			

			return json_encode($data);
		}

		function _cardsOnTableNow($cards, $round)
		{
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
		function _gameHistory($game_id)
		{
			$ci =& get_instance();
			$result = $ci->game_model->getGameHistory($game_id);
			$output = "";
			foreach ($result as $row) {
				$username = $ci->game_model->getUsernameById($row['player_id']);
				$output  .=$username.": ".$row['operation'].",";
			}
			return substr($output, 0, -1);
		}

		function ApostaJogo($ID, $username, $password, $jogada, $valor)
		{
			$ci =& get_instance();
			if($jogada === "raise"){
				$result = $ci->game_model->PlayerRaised($username, $ID); //FALTA A FLAG E O VALOR ESTA A SER BUSCADO LA
			} elseif ($jogada === "fold"){
				$result = $ci->game_model->PlayerFolded($username, $ID);
			} else{
				$result = $ci->game_model->PlayerCalled($username, $ID);
			}
			if($result){
				return json_encode("Aceite");
			}
			return json_encode("Nao aceite");
		}
	}
	function index() {
        $this->nusoap_server->service(file_get_contents("php://input")); //shows the standard info about service
    }
}
?>
