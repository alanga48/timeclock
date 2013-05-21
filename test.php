<?php

$date = "2013-05-16 22:33:51";
$week = date('W',strtotime($date));
$year = date('Y',strtotime($date));

$start_timestamp = strtotime("{$year}-W{$week}-1");

$end_timestamp = strtotime("{$year}-W{$week}-7");

echo date('Y-m-d',$start_timestamp);
echo '<br />';
echo date('Y-m-d',$end_timestamp);




$entries = array("2013-01-25 12:33:51",
			     "2013-05-16 22:33:51",
			     "2013-05-17 22:33:51",
			     "2013-11-25 02:33:51");

foreach($entries as $entry) {

	$week_number = date('W',strtotime($entry));

	if( !isset($weeks[$week_number]) ) {
		$weeks[$week_number] = array();
	}

	$weeks[$week_number][] = $entry; 

}


$clients = array();

$clients[2] = array(
	'name'=>'john',
	'email'=>'john@aol.com',
	'pets'=>array()
);
$clients[3] = array(
	'name'=>'bob',
	'email'=>'bob@aol.com',
	'pets'=>array()
);
$clients[4] = array(
	'name'=>'lisa',
	'email'=>'lisa@aol.com',
	'pets'=>array()
);

$clients[2]['pets'] = array();
$clients[2]['pets'][] = array('name' => 'bruce');
$clients[2]['pets'][] = array('name' => 'maggie');


$pets = array();
$pets[3] = array('name'=>'roger');
$pets[5] = array('name'=>'sam');

$clients[3]['pets'] = $pets;



foreach($clients as $client) {

	echo '<h1>' . $client['name'] . '</h1>';

	foreach($client['pets'] as $pet) {
		echo $pet['name'] . '<br />';
	}

}

exit();
print_r($clients); exit();

print_r($clients[2]['pets']);
foreach($clients[2]['pets'] as $pet) {

	echo $pet['name'];
	echo $pet['species'];

}


echo '<br />---<br />';

echo '<pre>';
print_r($clients);



