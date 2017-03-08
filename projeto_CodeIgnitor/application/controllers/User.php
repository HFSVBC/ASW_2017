<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('user_model');
	}

	public function register()
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'name',
	                'label' => 'User First Name',
	                'rules' => 'trim|required'
	        ),
	        array(
	                'field' => 'surname',
	                'label' => 'User Last Name',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'username',
	                'label' => 'User username',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'email',
	                'label' => 'User email',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'password',
	                'label' => 'User password',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'birthDate',
	                'label' => 'User birth date',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'sexo',
	                'label' => 'User sex',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'country',
	                'label' => 'User country',
	                'rules' => 'trim|required',
	        ),
	        array(
	                'field' => 'dist',
	                'label' => 'User district if in Portugal',
	                'rules' => 'trim|integer',
	        ),
	        array(
	                'field' => 'con',
	                'label' => 'User county if in Portugal',
	                'rules' => 'trim|integer',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			$createPage = $this->user_model->registerUser();
			if($createPage === true){
				$validator['success']  = true;
				$validator['messages'] = 'Adicionado com sucesso';
			}else{
				$validator['success']  = false;
				$validator['messages'] = 'Erro ao atualizar a base de dados';
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informação';
		}

		echo json_encode($validator);
	}
}