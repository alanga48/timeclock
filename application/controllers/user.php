<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function login()	{

		if($this->session->userdata('is_logged_in')) {

			if($this->session->userdata('role') == 'admin') { 

				redirect('/admin/get_entries');

			} else {
			
				redirect('/time_entry/all_entries');

			}

		} else {
			
			$this->session->set_flashdata('message', 'Incorrect Username/Password');
			$this->template->load('default','login');

		}

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

			if($user_info['role'] == 'admin') { 

				redirect('/admin/get_entries');

			} else {
			
				redirect('/time_entry/all_entries');

			}
		
		} else {

			$this->login();
		}


	}

	public function logout() {

		$this->session->sess_destroy();
		redirect('/user/login');

	}	
}
