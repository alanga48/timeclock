<!-- $this->db->select('*');
$this->db->from('blogs');
$this->db->join('comments', 'comments.id = blogs.id');

$query = $this->db->get();

// Produces: 
// SELECT * FROM blogs
// JOIN comments ON comments.id = blogs.id

SELECT *

FROM `time_entry`

JOIN project ON time_entry.project_id = project.id

 -->
<?php

	class Time_entry_model extends CI_Model {

		
		public function get_employee_entries($user_id) {
			
			// $this->db->where('user_id', $user_id);
			// $this->db->order_by('start', 'desc');
			// $result = $this->db->get('time_entry');

			$this->db->select('t.*, p.id AS project_id, p.title as title');
			$this->db->from('time_entry as t');
			$this->db->join('project as p', 't.project_id = p.id', 'left outer');
			$this->db->where('user_id', $user_id);
			$this->db->order_by('start', 'desc');
			$result = $this->db->get();
			
			$entries = $result->result_array();

			//print_rr($entries);
			$grouped_entries = array();

			foreach($entries as $entry) {

				$week_number = date('W',strtotime($entry['start']));

				if(!isset($grouped_entries[$week_number])) {
					$grouped_entries[$week_number] = array();
				}

				$entry['total_seconds'] = $this->_calculate_entry_seconds($entry);

				$grouped_entries[$week_number]['entries'][] = $entry; 

			}

			foreach($grouped_entries as $key => $week) {
				$result = $this->_calculate_week($week['entries']);
				$grouped_entries[$key] = $grouped_entries[$key] + $result;
			}

			return $grouped_entries;

		}

		public function get_all_entries() {

			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('role','employee');
			$this->db->join('time_entry', 'user.id = time_entry.user_id');

			$result = $this->db->get();

			$entries = $result->result_array();

			//print_rr($entries);

			// Organize by user
			foreach ($entries as $entry) {

				$user_id = $entry['user_id'];

				if(!isset($all_entries[$user_id])) {
					$all_entries[$user_id] = array();
				}

				$all_entries[$user_id]['entries'][] = $entry;

			}

			foreach($all_entries as $key => $user) {

				$result = $this->_calculate_week($user['entries']);		
				$all_entries[$key] = $all_entries[$key] + $result;
			}

			//print_rr($all_entries);

			exit();

			
			return $all_entries;
		}

		public function open_entry() {

			$this->db->where('user_id', $this->user['id']);
			$this->db->where('end IS NULL');
			$query = $this->db->get('time_entry');

			$open_entry = $query->result_array();

			//print_rr($open_entry);

			
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


		public function end_time($user_id, $comment) {

			$today = date("Y-m-d H:i:s");
			
			$data = array('end'=> $today, 'comment' => $comment);

			$this->db->where('user_id', $this->user['id']);
			$this->db->where('end IS NULL');

			$this->db->update('time_entry', $data);
			
		}

		public function insert_comment($id, $comment, $project) {

			$this->db->where('id', $id);

			$this->db->set('comment', $comment);

			$this->db->set('project_id', $project);

			$this->db->update('time_entry');
		}

		public function delete_comment($id) {

			$this->db->where ('id', $id);
			$this->db->set('comment', NULL);
			$this->db->update('time_entry');
		}


		public function get_entry($id) {

			$this->db->where('id', $id);
			$result = $this->db->get('time_entry');

			$entry = $result->row_array();

			return $entry;

		}

		public function update_entry($id, $start, $end) {

			$this->db->where('id', $id);
			$this->db->set('start', $start);
			$this->db->set('end', $end);
			$this->db->update('time_entry');

		}


		public function delete_entry($id) {

			$this->db->where('id', $id);
			$this->db->delete('time_entry');

		}

		public function insert_entry($user_id, $start, $end) {

			$array = array('user_id' => $user_id,
					       'start' => $start,
					       'end' => $end);
			

			$this->db->insert('time_entry', $array);

		}

		private function _calculate_week($week_entries) {

			$return = array();
			$return['total_seconds'] = 0;
			
			foreach($week_entries as $entry) {

				$week_number = date('W',strtotime($entry['start']));
				$year = date('Y',strtotime($entry['start']));
				
				$start_timestamp = strtotime("{$year}-W{$week_number}-1");
				$end_timestamp = strtotime("{$year}-W{$week_number}-7");

				$start = date('Y-m-d', $start_timestamp);
				$end = date('Y-m-d', $end_timestamp);
					
				// Calculate total seconds for entry
				$seconds = $this->_calculate_entry_seconds($entry);

				$return['total_seconds'] += $seconds;
				$return['start'] = $start;
				$return['end'] = $end;			
				 
			}

			return $return;

		}

		private function _calculate_entry_seconds($entry) {

			if(!$entry['end'] || $entry['end'] == '0000-00-00 00:00:00') {
				return 0;
			}
			// Calculate total seconds for entry
			$start_sec = strtotime($entry['start']);
			$end_sec = strtotime($entry['end']);
			$seconds = $end_sec- $start_sec;	
			return $seconds;			
		}

}