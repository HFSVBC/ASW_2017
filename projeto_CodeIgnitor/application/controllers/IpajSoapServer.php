<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IpajSoapServer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model("game_model");
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
		// $this->nusoap_server->register(
		// 	"ApostaJogo",
		// 	array("ID"=>"xsd:integer", "username"=>"xsd:string", "password"=>"xsd:string", "jogada"=>"xsd:string", "valor"=>"xsd:integer"), //valor e opcional
		// 	array("return"=>"xsd:string"), //mudar o tipo de retorno conforme pretendido
		// 	"urn:IpajSoapServer",
		// 	"urn:IpajSoapServer#ApostaJogo",
		// 	"rpc",
		// 	"encoded",
		// 	"Returns 'aceite' if play is acceptable, else returns 'Nao aceite'"
		// );
		
	}

	public function InfoPartida($ID)
	{
		return json_encode($this->game_model->gameInfo($ID));
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
	function index() {
        $this->nusoap_server->service(file_get_contents("php://input")); //shows the standard info about service
    }


}
?>
