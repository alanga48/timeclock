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

		$data = $this->time_entry_model->start_time($this->user['id']);

		redirect('time_entry/all_entries');
		
		
	}
		

	public function end() {

		$comment = $this->input->post('comment');

		$end = $this->time_entry_model->end_time($this->user['id'], $comment);

		redirect('time_entry/all_entries');

	}

	public function insert_comment() {

		$id = $this->input->post('id');
		$comment = $this->input->post('comment');

		$this->time_entry_model->insert_comment($id, $comment);

		redirect('time_entry/all_entries');
	}

	public function delete_comment($id) {

		$this->time_entry_model->delete_comment($id);
		
		$this->session->set_flashdata('message', 'Your Comment Has Been Deleted');

		redirect('time_entry/all_entries');

	}

	public function get_entry($id) {

		$this->load->model('time_entry_model');
		$entry = $this->time_entry_model->get_entry($id);
		
		//print_rr($entry);

		$this->template->load('default','update_entry', $entry);


	}

	public function update() {

		//print_rr($this->input->post() );

		$id = $this->input->post('id');
		
		$start = DateTime::createFromFormat('m/d/Y h:i', $this->input->post('start'));
		$start = $start->format('Y-m-d h:i');

		if(!$this->input->post('end')) {
			
			$end = NULL;
		}
		
		else {

			$end = DateTime::createFromFormat('m/d/Y h:i', $this->input->post('end'));
			$end = $end->format('Y-m-d h:i');
		}

		$entry = $this->time_entry_model->get_entry($id);

		$this->time_entry_model->update_entry($id, $start, $end);

		$week_number = date("W", strtotime($start));

		$this->session->set_flashdata('message', 'Your Changes Have Been Made');

		redirect('admin/view_employee/' . $entry['user_id'] . '/#details_' . $week_number);


	}
 
	public function insert_entry() {
		
		$user_id = $this->input->post('user_id');
		
		$start = DateTime::createFromFormat('m/d/Y h:i', $this->input->post('start'));
		$start = $start->format('Y-m-d h:i');
		
		if(!$this->input->post('end')) {
			
			$end = NULL;
			
		} else {
			
			$end = DateTime::createFromFormat('m/d/Y h:i', $this->input->post('end'));
			$end = $end->format('Y-m-d h:i');
		}

		$this->time_entry_model->insert_entry($user_id, $start, $end);

		$week_number = date("W", strtotime($start));

		$this->session->set_flashdata('message', 'Your Changes Have Been Made');

		redirect('admin/view_employee/' . $this->input->post('user_id') . '/#details_' . $week_number );
	}


	public function delete($id) {

		$this->load->model('time_entry_model');

		$entry = $this->time_entry_model->get_entry($id);

		$this->time_entry_model->delete_entry($id);

		$week_number = date("W", strtotime($entry['start']));

		$this->session->set_flashdata('message', 'Your Changes Have Been Made');

		redirect('admin/view_employee/' . $entry['user_id'] . '/#details_' . $week_number);

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
