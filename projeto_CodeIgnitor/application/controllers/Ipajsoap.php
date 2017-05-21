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
			"getInfoPartida", 
			array("return"=>"xsd:string"), //mudar o tipo de retorno conforme pretendido
			"urn:Ipajsoap",
			"urn:Ipajsoap#getInfoPartida",
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
		$this->nusoap_server->service(file_get_contents("php://input"));
	}

	public function getInfoPartida()
	{
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
		}
	}
}
?>