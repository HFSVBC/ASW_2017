<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipajsoap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model("game_model");
		$this->load->library("Nusoap_lib");
		$this->nusoap_server = new soap_server();
		$this->nusoap_server->configureWSDL("Ipajsoap", "urn:Ipajsoap");
		$this->nusoap_server->register(
			"ApostaJogo",
			array("ID"=>"xsd:integer", "username"=>"xsd:string", "password"=>"xsd:string", "jogada"=>"xsd:string", "valor"=>"xsd:integer"), //valor e opcional
			array("return"=>"xsd:string"), //mudar o tipo de retorno conforme pretendido
			"urn:Ipajsoap",
			"urn:Ipajsoap#ApostaJogo",
			"rpc",
			"encoded",
			"Returns 'aceite' if play is acceptable, else returns 'Nao aceite'"
		);
		$this->nusoap_server->register(
			"InfoPartida",
			array(),
			array("return"=>"xsd:string"), //mudar o tipo de retorno conforme pretendido
			"urn:Ipajsoap",
			"urn:Ipajsoap#InfoPartida",
			"rpc",
			"encoded",
			"Returns the information of a game"
		);
	}

	public function index()
	{
		if($this->uri->segment(3) == "wsdl") {
			$_SERVER['QUERY_STRING'] = "wsdl";
		} else {
			$_SERVER['QUERY_STRING'] = "";
		}

		public function InfoPartida()
		{
			$this->game_model->gameInfo();
		}

		public function ApostaJogo($ID, $username, $password, $jogada, $valor)
		{
			if($jogada === "raise"){
				$this->game_model->PlayerRaised($username, $ID); //FALTA A FLAG E O VALOR ESTA A SER BUSCADO LA
			} elseif ($jogada === "fold"){
				$this->game_model->PlayerFolded($username, $ID);
			} else{
				$this->game_model->PlayerCalled($username, $ID);
			}
		}

		$this->nusoap_server->service(file_get_contents("php://input"));
	}


}
?>
