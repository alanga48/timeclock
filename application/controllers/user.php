<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function login()	{

		$this->template->load('default','login');
		//$this->output->enable_profiler(TRUE);
	
	}

	public function verify_credentials() {

		$this->load->model('user_model');
		$user_info = $this->user_model->verify(); 

		if($user_info) {
			$data = array (
				'user_id' => $user_info['id'],
				'is_logged_in' => true,
				'role' => $user_info['role'],
				'company' => $user_info['company']
				);

			$this->session->set_userdata($data);

			//print_rr($data);

			if($user_info['role'] == 'admin') { 

				redirect('/admin/get_entries');

			} else {
			
				redirect('/time_entry/all_entries');

			}
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
