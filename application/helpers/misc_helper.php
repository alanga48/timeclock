<?php

function print_rr($array, $exit = true) {
	
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	if($exit) exit();

}

function sec_to_output($seconds) {

	$hours = floor($seconds / 3600);
	$mins = floor(($seconds - ($hours*3600)) / 60);
	return $hours .' hours and ' . $mins . ' minutes';

}



// function end_output() {

// 	if($entry['end']) == '0000-00-00 00:00:00') {
// 		$now = time();
// 		$entry['end'] = date("m/d/Y H:i", strtotime($now) );
// 	}
// 	return $now;
// }

// echo $now;

// ?>
