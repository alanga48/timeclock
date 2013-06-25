<?php date_default_timezone_set('America/Denver'); ?>
<?php foreach($entries as $week) { ?>

<h3>WEEK OF: <?=date("M d, Y", strtotime($week['start'])) . " - " . date("M d, Y", strtotime($week['end']))?></h3>
<h4><?=sec_to_output($week['total_seconds'])?> </h4>
<br>
<table class="employee_table">
		<tr>
			<th>CLOCK IN</th>
			<th>CLOCK OUT</th>
			<th>DAILY TOTAL</th>
		</tr>

		<?php $c = true; ?>
		
		<?php foreach($week['entries'] as $entry) { ?>
		<?php 
		if($c) { 
			$c = false;
     		$class = 'row_1';
		} else {
     		$c = true;
    	 	$class = 'row_2';
		} ?>

		<tr class="<?= $class ?>">

			<td><?=date("M d, Y, g:i a", strtotime($entry['start']))?></td>
			<td>
				<?php 
				if($entry['end'] == NULL) { 
					echo ' - ';
				} else { 
					echo date("M d, Y, g:i a", strtotime($entry['end']));
				}?>
			</td>
			<td>
				<?php 
				if($entry['end'] == NULL) { 
					echo ' - ';
				} else { 
					echo gmdate("H:i:s", $entry['total_seconds']);
				}?>
			</td>
		</tr>

		<tr class="<?= $class ?>">

			<td colspan="3">
				<div class="comment">
					<?php
					if($entry['end'] == NULL) { 
						echo '';
					} else {
						if($entry['comment']) { ?> 
						<?= $entry['comment'];?><br><br>
						<a href="#insert_comment<?=$entry['id']?>" class="modal_popup"><i class="icon-pencil"></i> Edit Comment</a> | 
						<a href="/index.php/time_entry/delete_comment/<?=$entry['id']?>" onclick="return confirm('Are you sure you want to delete this comment?')"><i class="icon-remove"></i> Delete Comment</a> 
						<?php } else { ?>
						<a  href="#insert_comment<?=$entry['id']?>" class="modal_popup"><i class="icon-star"></i> Add a Comment</a>
						<?php } 
					} ?>
					<div class = "hidden">
				   	<?php $placeholder = "placeholder='Enter a comment about what you did today'"; ?>
				   	<?= form_open('time_entry/insert_comment', $attributes = array('id' => 'insert_comment' . $entry['id']) ); ?>
				   		<?= form_hidden('id', $entry['id']) ?>
				   		<label for "Daily Comment" </label>
				   		<?= form_textarea('comment', '', $placeholder); ?>
				   		<?= form_submit('submit', 'Submit'); ?>
				   	<?= form_close(); ?>
   					</div>
				</div>

			</td>

		</tr>
		
	
	<?php } ?>

</table>


<?php } ?>



