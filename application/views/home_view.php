<html>
<head>
<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
</head>
<body>
		
	<div id="wrapper">

	<p>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></p>

	<h2>Timeclock Entries for <?=$this->user['first_name'] ." ". $this->user['last_name']; ?></h2>

<?php


	if($open_entry == 1) {

		echo '<button type="button"><a href="end">CLOCK OUT</a></button>';
	}

	else {

		echo '<button type="button"><a href="start">CLOCK IN</a></button>';
	}

	//var_dump($records); exit();

?>

	<?php foreach($records as $week) { ?>
	<table id="table">
			<tr>
				<td><strong>Week Of:</strong></td>
			</tr>
			<tr>
				<td>CLOCK IN</td>
				<td>CLOCK OUT</td>
			</tr>
				
			<?php foreach($week as $entry) { ?>
			
			<tr>
				<td><?=date("m/d/y, g:i a", strtotime($entry['start']))?></td>
				<td><?=date("m/d/y, g:i a", strtotime($entry['end']))?></td><br>
			</tr>

			<?php } ?>

		</table>

	<?php } ?>

	</div>

</body>
</html>

