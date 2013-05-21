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
	<?//php print_rr($records); exit();?>

	<?php foreach($records as $week) { ?>
	<table id="table">
			<tr>
				<td colspan="3"><strong>WEEK OF: <?=date("m/d/y", strtotime($week['start'])) . " - " . date("m/d/y", strtotime($week['end']))?></strong></td>
			</tr>
			<tr>
				<td>CLOCK IN</td>
				<td>CLOCK OUT</td>
				<td>DAILY TOTAL</td>
			</tr>
				
			<?php

			$seconds = 0; 

			foreach($week['records'] as $entry) { 

				$start_sec = strtotime($entry['start']);
				$end_sec = strtotime($entry['end']);
				
				$diff_sec = ($end_sec) - ($start_sec);

				$seconds += $diff_sec;

				$hours = floor($seconds / 3600);
				$mins = floor(($seconds - ($hours*3600)) / 60);

			?>
			
			<tr>
				<td><?=date("m/d/y, g:i a", strtotime($entry['start']))?></td>
				<td><?=date("m/d/y, g:i a", strtotime($entry['end']))?></td><br>
				<td><?=date("H:i:s", $diff_sec);?></td>
			</tr>
			<?php } ?>

			<tr>
				<td colspan="3">WEEKLY TOTALS: <?php echo $hours .' hours and ' . $mins . ' minutes'; ?></td>
			</tr>

		</table>

	<?php } ?>

	</div>

</body>
</html>

