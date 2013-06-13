<?php foreach($entries as $week) { ?>

<h3>WEEK OF: <?=date("m/d/y", strtotime($week['start'])) . " - " . date("m/d/y", strtotime($week['end']))?></h3>
	<table>
		<tr>
			<th>CLOCK IN</th>
			<th>CLOCK OUT</th>
			<th>DAILY TOTAL</th>
		</tr>
		<?php foreach($week['entries'] as $entry) { ?>
		<tr>

			<td><?=date("m/d/y, g:i a", strtotime($entry['start']))?></td>
			<td>
				<?php 
				if($entry['end'] == NULL) { 
					echo ' - ';
				} else { 
					echo date("m/d/y, g:i a", strtotime($entry['end']));
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
		<?php } ?>

		<tr>

			<td colspan="3">
				WEEKLY TOTALS: <?=sec_to_output($week['total_seconds'])?>   
			</td>
		</tr>


	</table>


<?php } ?>



