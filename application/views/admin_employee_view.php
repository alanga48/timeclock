<h3>EMPLOYEE NAME: <?=$user['first_name'] ." ". $user['last_name']; ?></h3>
<?php $i = 0; 
foreach($entries as $week) { $i++; ?>

	<div class="week_title">
		<h4>WEEK OF: <?=date("m/d/y", strtotime($week['start'])) . " - " . date("m/d/y", strtotime($week['end']))?>, <?=sec_to_output($week['total_seconds']) ?>. <a href="#details_<?=$i?>" class="details">Details</a></h4>
	</div>

	<div class="details_box" id="details_<?=$i?>">
		<div class="button"><a href="#insert_entry_<?=$user['id'];?>" class="modal_popup">Add New Time Entry</a></div>
		<table class="table">
			<tr>
				<th>CLOCK IN</th>
				<th>CLOCK OUT</th>
				<th>DAILY TOTAL</th>
				<th>ACTIONS</th>
			</tr>
			<?php foreach($week['entries'] as $entry) { ?>
			

			<tr>
				<td>
					<div class = "hidden">
						<?= form_open('time_entry/update', $attributes = array('id' => 'update_entry_' . $entry['id'], 'input type' => 'text'), array('id' => $entry['id'], 'user_id' => $entry['user_id']) ) ?>
							<label for="start">Start</label>
							<?= form_input('start', date("m/d/Y H:i", strtotime($entry['start']) ), 'class="datetimepicker clearable"') ?>
							<label for="end">End</label>
							<?= form_input('end', date("m/d/Y H:i", strtotime($entry['end']) ), 'class="datetimepicker clearable"') ?>
							<a href="#" class="clear">clear</a>
							<?= form_submit('submit', 'Submit') ?>
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
				<td><a href="#update_entry_<?=$entry['id']?>" class ="modal_popup" class="edit_entry">Update</a> | 
				<a href="/index.php/time_entry/delete/<?=$entry['id']?>" onclick="return confirm('Are you sure you want to delete this time entry?')">Delete</a></td>

			</tr>
			<?php } ?>

		</table>
	</div>
<?php } ?>


<div class = "hidden">
	<?= form_open('time_entry/insert_entry', $attributes = array('id' => 'insert_entry_' . $entry['user_id']), array('user_id' => $entry['user_id']) ) ?>
		<label for="start">Start</label>
		<?= form_input('start', date("m/d/Y H:i"), 'class="datetimepicker clearable"') ?>
		<label for="end">End (Optional)</label>
		<?= form_input('end', date("m/d/Y H:i"), 'class="datetimepicker clearable"') ?>
		<a href="#" class="clear">Clear</a>
		<?= form_submit(array('name' => 'submit','value' => 'Submit','id' => 'submit')) ?>
	<?= form_close() ?>
</div>
