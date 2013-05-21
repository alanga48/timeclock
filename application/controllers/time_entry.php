<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time_entry extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->_is_logged_in();
	}

	public function all_records() {

		$this->load->model('time_entry_model');
		
		//store the result in a multidemensional array in order to access the first
		//level as variables in the view
		
		$data['records'] = $this->time_entry_model->get_all_records();

		//print_rr($data);

		$data['open_entry'] = $this->time_entry_model->open_entry();

		//print_rr($data); exit();
		$this->load->view('home_view', $data);
		
	}
	

	public function start() {

		$this->load->model('time_entry_model');
		$data = $this->time_entry_model->start_time($this->user['id']);

		redirect('time_entry/all_records');
		
		
	}
		

	public function end() {

		$this->load->model('time_entry_model');
		$end = $this->time_entry_model->end_time($this->user['id']);

		redirect('time_entry/all_records');

	}

	private function _is_logged_in() {

		$session = $this->session->all_userdata();

		//echo '<pre>'; print_r($session); exit();

		if( isset($session['is_logged_in']) && $session['is_logged_in'] == 1 ) {
			$logged_in = true;
			
			$this->user = $this->user_model->get($session['user_id']);

		} 

		else {
			$logged_in = false;
			redirect('/user/login'); exit();
		}

	}

}
