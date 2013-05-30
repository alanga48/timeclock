<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">

		<p>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></p>

		<?php foreach($users as $key => $user) { ?>

			<h2><?=$user['first_name'] . " " . $user['last_name'] . " #" . $user['id']?></h2>
			
			<a href="/index.php/admin/view_employee/<?=$user['id']?>">View Employee</a>

			<table id="table_admin">
				<thead id="thead_admin">		
					<tr>
						<th>Week Of:</th>
						<th>Week Total: </th>
					</tr>
				</thead>

				<tbody>
				<?php foreach($user['weeks'] as $week) { ?>
					<tr>
						<td><?=$week['start'] . " - " . $week['end']?></td>
						<td><?=sec_to_output($week['total_seconds'])?></td>
					</tr>
				<?php } ?>
				</tbody>				
			</table>
		<?php } ?>
		
			
			

		</div>

	</body>
</html>

