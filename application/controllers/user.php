<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function login()	{

		$this->load->view('login');
	
	}

	public function verify_credentials() {

		$this->load->model('user_model');
		$user_info = $this->user_model->verify(); 

		if($user_info) {
			$data = array (
				'user_id' => $user_info['id'],
				'is_logged_in' => true
				);

			$this->session->set_userdata($data);
			redirect('/');
		}
		else {

			echo 'Incorrect Login';
			$this->login();
		}


	}

	public function logout() {

		$this->session->sess_destroy();
		redirect('/user/login');

	}	
}
