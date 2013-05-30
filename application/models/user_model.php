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
		
		public function get($user_id = false) {

			if(!$user_id) {
				$session = $this->session->all_userdata();
				$user_id = $session['user_id'];
			}

			$result = $this->db->get_where('user', array('id' => $user_id));			

			return $result->row_array();

		}

		public function get_all() {

			return $this->db->get_where('user', array('role' => 'employee'))->result_array();

		}

	


}