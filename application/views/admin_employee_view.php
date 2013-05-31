<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">
		
		<p>You are logged in as <?=$this->user['username']?>. 
		<p><a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/view_user_info/<?=$user['id'];?>">Edit This Employee</a> / 
		   <a href="/index.php/admin/new_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a></p>

		<h2>Timeclock Entries for <?=$user['first_name'] ." ". $user['last_name']; ?></h2>


		<?php foreach($entries as $week) { ?>
			<table id="table">
				<tr>
					<td div id= "title" colspan="3"><strong>WEEK OF: 
						<?=date("m/d/y", strtotime($week['start'])) . " - " . date("m/d/y", strtotime($week['end']))?></strong>
					</td>
				</tr>
				<tr>
					<td>CLOCK IN</td>
					<td>CLOCK OUT</td>
					<td>DAILY TOTAL</td>
				</tr>
				<?php foreach($week['entries'] as $entry) { ?>
				<tr>
					<td><?=date("m/d/y, g:i a", strtotime($entry['start']))?></td>
					<td><?=date("m/d/y, g:i a", strtotime($entry['end']))?></td>
					<td><?=date("H:i:s", $entry['total_seconds']);?></td>
					<td><button><a href="/index.php/time_entry/get_entry/<?=$entry['id']?>">Update</a></button></td>
					<td><button><a href="/index.php/time_entry/delete/<?=$entry['id']?>">Delete</a></button></td>

				</tr>
				<?php } ?>

				<tr>
					<td colspan="3">WEEKLY TOTALS: <?=sec_to_output($week['total_seconds'])?></td>
				</tr>


			</table>

		<?php } ?>

		</div>

	</body>
</html>

