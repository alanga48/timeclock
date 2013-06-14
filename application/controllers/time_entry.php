<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time_entry extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->_is_logged_in();
		//$this->output->enable_profiler(TRUE);
	}

	public function all_entries() {

		if($session_id = $this->session->userdata('role') == 'admin') {

			redirect('/admin/get_entries');
		}
		
		$data['entries'] = $this->time_entry_model->get_employee_entries($this->user['id']);
		$data['open_entry'] = $this->time_entry_model->open_entry();


		$this->template->load('default','home_view', $data);
		
	}
	

	public function start() {

		$this->load->model('time_entry_model');
		$data = $this->time_entry_model->start_time($this->user['id']);

		redirect('time_entry/all_entries');
		
		
	}
		

	public function end() {

		$this->load->model('time_entry_model');
		$end = $this->time_entry_model->end_time($this->user['id']);

		redirect('time_entry/all_entries');

	}

	public function get_entry($id) {

		$this->load->model('time_entry_model');
		$entry = $this->time_entry_model->get_entry($id);
		
		//print_rr($entry);

		$this->template->load('default','update_entry', $entry);


	}

	public function update() {

		// print_rr($this->input->post());

		$id = $this->input->post('id');
		
		$start = DateTime::createFromFormat('m/d/Y H:i', $this->input->post('start'));
		$start = $start->format('Y-m-d H:i:s');
		
		if(!$this->input->post('end')) {
			
			$end = '0000-00-00 00:00:00';
		}
		
		else {

			$end = DateTime::createFromFormat('m/d/Y H:i', $this->input->post('end'));
			$end = $end->format('Y-m-d H:i:s');
		}

		
		
		$entry = $this->time_entry_model->get_entry($id);

		$this->time_entry_model->update_entry($id, $start, $end);

		redirect('admin/view_employee/' . $entry['user_id']);


	}
 

	public function delete($id) {

		$this->load->model('time_entry_model');

		//print_rr($id);
		$entry = $this->time_entry_model->get_entry($id);
		$this->time_entry_model->delete_entry($id);

		redirect('admin/view_employee/' . $entry['user_id']);

	}

	public function insert_entry() {
		
		$user_id = $this->input->post('user_id');
		
		$start = DateTime::createFromFormat('m/d/Y H:i', $this->input->post('start'));
		$start = $start->format('Y-m-d H:i:s');
		
		$end = DateTime::createFromFormat('m/d/Y H:i', $this->input->post('end'));
		$end = $end->format('Y-m-d H:i:s');

		$this->time_entry_model->insert_entry($user_id, $start, $end);

		redirect('admin/view_employee/' . $this->input->post('user_id') );
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
