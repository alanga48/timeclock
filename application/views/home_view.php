<div id="wrapper">

<p>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></p>

<h2>Timeclock Entries for <?=$this->user['first_name'] ." ". $this->user['last_name']; ?></h2>

<?php if($open_entry == 1) { ?>
	<a href="end">CLOCK OUT</a>
<?php } else { ?>
	<a href="start">CLOCK IN</a>
<?php } ?>

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
					echo date("H:i:s", $entry['total_seconds']);
				}?>
			</td>
		</tr>
		<?php } ?>

		<tr>

			<td colspan="3">
				WEEKLY TOTALS: 
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

