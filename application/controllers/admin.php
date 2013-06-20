<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->_is_logged_in();
		//$this->output->enable_profiler(TRUE);
	}


	function get_entries() {

		$users = $this->user_model->get_all();

		foreach($users as $key => $user) {
			$employee_entries = $this->time_entry_model->get_employee_entries($user['id']);
			$users[$key]['weeks'] = $employee_entries;
		}

		$data['users'] = $users;

		//print_rr($data);

		$this->template->load('admin', 'admin_view', $data);


	}

	function view_employee($user_id) {

		$data['user'] = $this->user_model->get($user_id);
		$data['entries'] = $this->time_entry_model->get_employee_entries($user_id);

		//print_rr($data);
		$this->template->load('admin','admin_employee_view', $data);

	}

	// function view_user_info($user_id) {

	// 	$data['user'] = $this->user_model->get($user_id);

	// 	//print_rr($data);

	// 	$this->template->load('admin','view_user_info', $data);

	// }

	function edit_employee() {

		$data = $this->user_model->update_user( $this->input->post() );

		$this->session->set_flashdata('message', 'Employee Updated Successfully');

		redirect('admin/get_entries');
	}

	
	function insert_employee() {

		//print_rr($this->input->post() );
		$this->user_model->insert_user($this->input->post()) ;

		$this->session->set_flashdata('message', 'Employee Added Successfully');

		redirect('admin/get_entries');


	}


	function delete_employee($id) {

		$result = $this->user_model->delete_user($id);

		$this->session->set_flashdata('message', 'Employee Deleted Successfully');

		redirect('admin/get_entries');
		
	}

	private function _is_logged_in() {

		$session = $this->session->all_userdata();

		//print_rr($session);

		if( isset($session['is_logged_in']) && $session['is_logged_in'] == 1 && $session['role'] == 'admin') {
			
			$logged_in_admin = true;

			$this->user = $this->user_model->get($session['user_id']);

		} 

		else {
			
			$logged_in_admin = false;
			redirect('/user/login'); exit(); 
		}

	}

}