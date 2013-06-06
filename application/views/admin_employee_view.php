<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/style.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/colorbox.css" />
		<script type="text/javascript" src="/assets/js/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="/assets/js/script.js"></script>
	</head>

	<body>
			
		<div id="wrapper">
		
		<p>You are logged in as <?=$this->user['username']?>
		<p><a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/view_user_info/<?=$user['id'];?>">Edit This Employee</a> / 
		   <a href="/index.php/admin/new_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a></p>

		<h1>View Employee</h1>
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
						<td>EDIT</td>
					</tr>
					<?php foreach($week['entries'] as $entry) { ?>


					<tr>
						<td>
							<div class = "hidden">
								<?= form_open('time_entry/update', $attributes = array('id' => 'update_entry_' . $entry['id']), array('id' => $entry['id'], 'user_id' => $entry['user_id']) ) ?>
									<label for="start">Start</label>
									<?= form_input('start', $entry['start'], 'id="start"') ?>
									<label for="end">End</label>
									<?= form_input('end', $entry['end'], 'id="end"') ?>
									<?= form_submit('submit', 'Submit') ?>
								<?= form_close() ?>
							</div>
							<?=date("m/d/y, g:i a", strtotime($entry['start']))?>
						</td>
						<td><?=date("m/d/y, g:i a", strtotime($entry['end']))?></td>
						<td><?=date("H:i:s", $entry['total_seconds']);?></td>
						<td><a href="#update_entry_<?=$entry['id']?>" class="edit_entry">Update</a></td>
						<td><a href="/index.php/time_entry/delete/<?=$entry['id']?>" onclick="return confirm('Are you sure you want to delete this time entry?')">Delete</a></td>

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

