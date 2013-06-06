<div id="wrapper">
	
	<p>You are logged in as <?=$this->user['username']?>
	<p><a href="/index.php/admin/get_entries">Home</a> / 
	   <a href="#insert_employee" class = "insert_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a></p>

	<h1>Timeclock Entries for <?=$user['first_name'] ." ". $user['last_name']; ?></h1>
	<a href="#insert_entry_<?=$user['id'];?>" class="insert_entry">Add New Time Entry</a> 

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
							<?= form_open('time_entry/update', $attributes = array('id' => 'update_entry_' . $entry['id'], 'input type' => 'text'), array('id' => $entry['id'], 'user_id' => $entry['user_id']) ) ?>
								<label for="start">Start</label>
								<?= form_input('start', '', 'id="start"') ?>
								<label for="end">End</label>
								<?= form_input('end', '', 'id="end"') ?>
								<?= form_submit('submit', 'Submit') ?>
							<?= form_close() ?>
						</div>
						<div class = "hidden">
							<?= form_open('time_entry/insert_entry', $attributes = array('id' => 'insert_entry_' . $entry['user_id']), array('user_id' => $entry['user_id']) ) ?>
								<label for="start">Start</label>
								<?= form_input('start', $entry['start'], 'id="start"') ?>
								<label for="end">End (Optional)</label>
								<?= form_input('end', $entry['end'], 'id="end"') ?>
								<?= form_submit('submit', 'Submit') ?>
							<?= form_close() ?>
						</div>
						<div class = "hidden">
							<?= form_open('admin/insert_employee', $attributes = array('id' => 'insert_employee') ) ?>
								<label for="first_name">First Name </label>			
								<?= form_input('first_name') ?>
								<label for="last_name">Last Name</label>
								<?= form_input('last_name') ?>
								<label for="username">Username</label>
								<?= form_input('username') ?>
								<label for="password">Password</label>
								<?= form_password('password'); ?>
								<label for="role">Role</label>
								<?= form_dropdown('role', array('employee' => 'Employee', 'administrator' => 'Administrator'), 'employee' ); ?>
								<br><br><button type='submit'>Submit</button>
							<?= form_close() ?>
						</div>

						<?=date("m/d/y, g:i a", strtotime($entry['start']))?>
					</td>
					<td>
						<?php if($entry['end'] == '0000-00-00 00:00:00') { 
							echo ' - ';
							} else { 
								echo date("m/d/y, g:i a", strtotime($entry['end']) ); 
							}
						?>
					</td>
					<td>
						<?php if($entry['end'] == '0000-00-00 00:00:00') { 
							echo ' - ';
							} else { 
								echo date("H:i:s", $entry['total_seconds']);
							}
						?>
					</td>
					<td><a href="#update_entry_<?=$entry['id']?>" class="edit_entry">Update</a></td>
					<td><a href="/index.php/time_entry/delete/<?=$entry['id']?>" onclick="return confirm('Are you sure you want to delete this time entry?')">Delete</a></td>

				</tr>
				<?php } ?>

				<tr>
					
					<!--Need to doublecheck the math on this-->
					<td colspan="3">WEEKLY TOTALS: 
						<?php 
							$count = time() + $week['total_seconds'];
							if($week['total_seconds'] < 0) {
								echo sec_to_output($count);
							
							} else {
								echo sec_to_output($week['total_seconds']);

							} ?>   
						</td>
				</tr>

			</table>

		<?php } ?>


</div>
