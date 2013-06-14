<script type="text/javascript" src="/assets/js/employee_admin.js"></script>

<h2>EMPLOYEE NAME: <?=$user['first_name'] ." ". $user['last_name']; ?></h2>
<i class="icon-arrow-left"></i><a class="link" href="/index.php/admin/get_entries">Go Back</a>
<?php 
foreach($entries as $week) { 

	$week_number = date("W", strtotime($week['start'])); ?>

	<div class="title" id="week_<?=$week_number?>">
		<h4>WEEK OF: 
			<?=date("m/d/y", strtotime($week['start'])) . " - " . date("m/d/y", strtotime($week['end']))?>, 
			<?=sec_to_output($week['total_seconds']) ?>. | 
			<i class="icon-plus"></i> <a href="#insert_entry_<?=$user['id'];?>" class="modal_popup">New Entry </a> |
			<i class="icon-expand-alt"></i> <a href="#details_<?=$week_number?>" class="details">Details</a> 
		</h4>
	</div>

	<div class="details_box" id="details_<?=$week_number?>">
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
							<a href="#" class="clear">Clear</a>
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
							echo gmdate("H:i:s", $entry['total_seconds']);
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
