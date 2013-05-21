<?php

	class time_entry_model extends CI_Model {

		
		public function get_all_records() {
			
			$this->db->where('user_id', $this->user['id']);
			$this->db->where('end !=', 'NULL');
			$result = $this->db->get('time_entry');
			
			$records = $result->result_array();

			foreach($records as $record) {

				$week_number = date('W',strtotime($record['start']));

				if( !isset($weeks[$week_number]) ) {
					$weeks[$week_number] = array();
				}

				$weeks[$week_number][] = $record; 
			}

			return $weeks;

	}

		public function open_entry() {

			$this->db->where('user_id', $this->user['id']);
			$this->db->where('end IS NULL');
			$query = $this->db->get('time_entry');

			$open_entry = $query->result_array();

			
			if(empty($open_entry)) {

				return false;

			}
			else {

				return true;
			}


			
		}

		public function start_time($user_id) {

			$today= date("Y-m-d H:i:s");

			$data=array('user_id' =>$this->user['id'],
						'start'=>$today);

			$this->db->insert('time_entry', $data);

		}


		public function end_time($user_id) {

			$today = date("Y-m-d H:i:s");
			
			$data = array('end'=> $today);

			$this->db->where('user_id', $this->user['id']);
			$this->db->where('end IS NULL');

			$this->db->update('time_entry', $data);
			
		}
}