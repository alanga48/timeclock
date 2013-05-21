<?php

	class time_entry_model extends CI_Model {

		
		public function get_all_records() {
			
			$this->db->where('user_id', $this->user['id']);
			$this->db->where('end !=', 'NULL');
			$result = $this->db->get('time_entry');
			
			$records = $result->result_array();

			foreach($records as $record) {

				$week_number = date('W',strtotime($record['start']));
				$year = date('Y',strtotime($record['start']));

				
				$start_timestamp = strtotime("{$year}-W{$week_number}-1");
				$end_timestamp = strtotime("{$year}-W{$week_number}-7");


				$start = date('Y-m-d', $start_timestamp);
				$end = date('Y-m-d', $end_timestamp);
				

				if( !isset($weeks[$week_number]) ) {
					
					$weeks[$week_number] = array();
					
				}

				$weeks[$week_number]['start'] = $start;
				$weeks[$week_number]['end'] = $end;
				$weeks[$week_number]['records'][] = $record;
				
				 
			}

			//print_rr($weeks);
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