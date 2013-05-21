<?php

function print_rr($array, $exit = true) {
	
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	if($exit) exit();

}