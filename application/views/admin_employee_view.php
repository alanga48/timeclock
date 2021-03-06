<script type="text/javascript" src="/assets/js/employee_admin.js"></script>

<h2>EMPLOYEE NAME: <?=$user['first_name'] ." ". $user['last_name']; ?></h2>
<?php if($entries) { ?> <i class="icon-plus"></i> <a href="#insert_entry_<?=$user['id'];?>" class="modal_popup link">New Entry</a> | <?php } ?>
<i class="icon-arrow-left"></i><a class="link" href="/index.php/admin/get_entries"> Go Back</a> 
<?php if ($this->session->flashdata('message')) { ?>
    <div class = "flash">
	<h3><i class="icon-exclamation-sign"> </i><?= $this->session->flashdata('message'); ?></h3>
	</div>
<?php } ?>
<?php 
foreach($entries as $week) { 

	$week_number = date("W", strtotime($week['start'])); ?>

	<div class="title" id="week_<?=$week_number?>">
		<div class="float_right">
			<?php foreach($week['projects'] as $project) { ?>
			<h4><?=$project['title'] ?>: <?=sec_to_output($project['total_seconds']) ?></h4>
			<?php } ?>
			
		</div>

		<h3>WEEK OF: <?=date("M d, Y", strtotime($week['start'])) . " - " . date("M d, Y", strtotime($week['end']))?></h3> 
		<h4 class="name">WEEK TOTAL: <?=sec_to_output($week['total_seconds']) ?> | <a href="#details_<?=$week_number?>" class="details"><i class="icon-expand"></i> Details</a></h4>

	</div>

	<div class="details_box" id="details_<?=$week_number?>">
		<table>
			<tr>
				<th>ENTRY</th>
				<th>CLOCK IN</th>
				<th>CLOCK OUT</th>
				<th>PROJECT</th>
				<th>DAILY TOTAL</th>
				<th>COMMENT</th>
				<th>ACTIONS</th>
			</tr>
			<?php foreach($week['entries'] as $entry) { ?>
			<tr>
				<td>#<?=$entry['id'] ?></td>
				<td>
					<div class = "hidden">
						
						<?= form_open('time_entry/update', $attributes = array('id' => 'update_entry_' . $entry['id'], 'input type' => 'text'), array('id' => $entry['id'], 'user_id' => $entry['user_id']) ) ?>
							<label for="start">Start</label>
							<?= form_input('start', date("m/d/Y H:i:s", strtotime($entry['start']) ), 'class="datetimepicker clearable"') ?>
							<label for="end">End</label>
							<?= form_input('end', date("m/d/Y H:i:s", strtotime($entry['end']) ), 'class="datetimepicker clearable"') ?>
							<label>Project</label>
							<?= form_dropdown('project', $projects) ?>
							<a href="#" class="clear">Clear</a>
							<?= form_submit('submit', 'Submit') ?>
						<?= form_close() ?>
					</div>
		
					<?=date("D, m/d/Y, g:i a", strtotime($entry['start']))?>
				</td>
				<td>
					<?php if($entry['end'] == NULL) { 
						echo ' - ';
						} else { 
							echo date("D, m/d/Y, g:i a", strtotime($entry['end']) ); 
						}
					?>
				</td>
				<td>
					<?= $entry['title']; ?>
				</td>
				<td>
					<?php if($entry['end'] == NULL) { 
						echo ' - ';
						} else {  
							echo gmdate("H:i:s", $entry['total_seconds']);
						} 
					?>
				</td>
				<td class = "comment_column">
					<?= substr($entry['comment'], 0, 100)?>
					<?php if(strlen($entry['comment']) > 100) { ?> 

						<div id = "comment_full_<?=$entry['id']?>" class="hidden">
							<?= substr($entry['comment'], 101)?>
						</div>

						<a href="#comment_full_<?=$entry['id']?>" class="comment">View Full Comment</a> 

					<?php } ?>

				</td>
				<td class = "action_column">
					<a href="#update_entry_<?=$entry['id']?>" class ="modal_popup week_links" class="edit_entry">Update</a> | 
				<a href="/index.php/time_entry/delete/<?=$entry['id']?>"  class ="week_links" onclick="return confirm('Are you sure you want to delete this time entry?')">Delete</a>
				</td>
			</tr>
			<?php } ?>

		</table>
	</div>
<?php } ?>
	<?php if($entries) { ?>
	<div class="hidden">
	<?php } else { ?>
	<div class="first_entry">
		<p>There are currently no time entries for this employee.</p>
		<h4>Insert a New Time Entry for <?=$user['first_name'] ." ". $user['last_name']; ?></h4>
	<?php } ?>
	<?= form_open('time_entry/insert_entry', $attributes = array('id' => 'insert_entry_' . $user['id']), array('user_id' => $user['id']) ) ?>
		<label for="start">Start</label>
		<?= form_input('start', date("m/d/Y H:i:s"), 'class="datetimepicker clearable"') ?>
		<label for="end">End (Optional)</label>
		<?= form_input('end', date("m/d/Y H:i:s"), 'class="datetimepicker clearable"') ?>
		<a href="#" class="clear">Clear</a>
		<?= form_submit(array('name' => 'submit','value' => 'Submit','id' => 'submit')) ?>
	<?= form_close() ?>
	</div>

