<?php

class User_model extends CI_Model {

	public function verify() {

		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', $this->input->post('password'));

		$query = $this->db->get('user');

		if($query->num_rows == 1) {
			
			$user_info = $query->row_array();
			
			return $user_info;
		}
		
		else {
			
			return false;
		}
	}
		
		public function get() {

			$session = $this->session->all_userdata();

			$result = $this->db->get_where('user', array('id' => $session['user_id']));
			
			$user = $result->row_array();

			return $user;

		}

	


}