<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		date_default_timezone_set("Europe/Lisbon");
		$this->load->model('user_model');
		$this->load->library('email');

	}

	public function register()
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'name',
	                'label' => 'User First Name',
	                'rules' => 'trim|required|xss_clean|strip_tags'
	        ),
	        array(
	                'field' => 'surname',
	                'label' => 'User Last Name',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'username',
	                'label' => 'User username',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'email',
	                'label' => 'User email',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'password',
	                'label' => 'User password',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'birthDate',
	                'label' => 'User birth date',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'sexo',
	                'label' => 'User sex',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'country',
	                'label' => 'User country',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'dist',
	                'label' => 'User district if in Portugal',
	                'rules' => 'trim|integer|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'con',
	                'label' => 'User county if in Portugal',
	                'rules' => 'trim|integer|xss_clean|strip_tags',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			$createPage = $this->user_model->registerUser();
			if($createPage === true){
				$validator['success']  = true;
				$validator['messages'] = 'Adicionado com sucesso '.$this->input->post('email');

				$this->email->from('support@pokeronline.com', 'Poker Online');
				$this->email->to($this->input->post('email'));

				$this->email->subject('Confirmação de email');
				$this->email->message("<p>Para terminar o seu registo por favor clique no link abaixo para confirmar o seu e-mail</p>
										<a href='http://appserver-01.alunos.di.fc.ul.pt/~asw004/projeto/index.php/user/confemail'>http://appserver-01.alunos.di.fc.ul.pt/~asw004/projeto/index.php/user/confemail</a>");

				if ( ! $this->email->send()){
        			$validator['messages'].="<br>Email não enviado";
				}

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
	public function login()
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
	        array(
	                'field' => 'username',
	                'label' => 'User username',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
	        array(
	                'field' => 'password',
	                'label' => 'User password',
	                'rules' => 'trim|required|xss_clean|strip_tags',
	        ),
		);

		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true){
			$loginResult = $this->user_model->loginUser();
			if($loginResult['success'] === true){
				$validator['success']  = true;
				$validator['messages'] = 'Utilizador autentificado com sucesso';

				$session_data = array(
				        'username'  => $loginResult['messages']['username'],
				        'email'     => $loginResult['messages']['email'],
				        'level'     => $loginResult['messages']['level'],
				        'logged_in' => TRUE
				);
				$this->session->set_userdata('loggedIn_asw004', $session_data);
			}else{
				$validator['success']  = false;
				$validator['messages'] = $loginResult['messages'];
			}
		} else{
			$validator['success']  = false;
			$validator['messages'] = 'Erro a validar a informação';
		}

		echo json_encode($validator);
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('/', 'refresh');
	}
}