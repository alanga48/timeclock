<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->_is_logged_in();
	}


	public function index()	{		
		redirect('time_entry/all_entries');
	}

	private function _is_logged_in() {

		$session = $this->session->all_userdata();

		//print_rr($session);

		if( isset($session['is_logged_in']) && $session['is_logged_in'] == 1 ) {
			
			$logged_in = true;

		} 

		else {
			
			$logged_in = false;
			redirect('/user/login'); exit(); 
		}

	}

}
