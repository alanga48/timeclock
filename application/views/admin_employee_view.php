<h3>EMPLOYEE NAME: <?=$user['first_name'] ." ". $user['last_name']; ?></h3>
<?php foreach($entries as $week) { ?>
	<h3>WEEK OF: <?=date("m/d/y", strtotime($week['start'])) . " - " . date("m/d/y", strtotime($week['end']))?></h3>
	<h3>WEEKLY TOTALS: <?=sec_to_output($week['total_seconds']) ?></h3>
	<div class="button"><a href="#insert_entry_<?=$user['id'];?>" class="modal_popup">Add New Time Entry</a></div>
	<table id="table">
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
						<?= form_input('start', date("m/d/Y H:i", strtotime($entry['start']) ), 'class="datetimepicker"') ?>
						<label for="end">End</label>
						<?= form_input('end', date("m/d/Y H:i", strtotime($entry['end']) ), 'class="datetimepicker"') ?>
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

	

<?php } ?>


<div class = "hidden">
	<?= form_open('time_entry/insert_entry', $attributes = array('id' => 'insert_entry_' . $entry['user_id']), array('user_id' => $entry['user_id']) ) ?>
		<label for="start">Start</label>
		<?= form_input('start', date("m/d/Y H:i"), 'class="datetimepicker"') ?>
		<label for="end">End (Optional)</label>
		<?= form_input('end', date("m/d/Y H:i"), 'class="datetimepicker"') ?>
		<?= form_submit('submit', 'Submit') ?>
	<?= form_close() ?>
</div>
