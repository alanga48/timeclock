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

		public function update_user() {

			//print_rr($this->input->post() );
			
			$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
			
			$this->db->where('id', $this->input->post('id'));
			$query = $this->db->update('user',$data);

			$this->db->where('id', $this->input->post('id') );
			$result = $this->db->get('user');

			if($result) {

				return $result->result_array();

			}

		}

		public function delete_user($id) {

			$this->db->where('id', $id);
			$query = $this->db->delete('user');

			if($query) {

				return true;
			}
		}

		public function get_all() {

			return $this->db->get_where('user', array('role' => 'employee'))->result_array();

		}

	


}