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

		<p>You are logged in as <?=$this->user['username']?>.<br><br> 
		<a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/new_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a> 

		<h1>Employee and Timeclock Summary</h1>

		<?php foreach($users as $key => $user) { ?>

			<div class="hidden">

				<?= form_open('admin/edit_employee', $attributes = array('id' => 'update_form_' . $user['id']), $id = array('id'=>$user['id']) ) ?>
					
					<label for='first_name'>First Name</label>
						<?= form_input('first_name',$user['first_name'], 'id="first_name"') ?>
					
					<label for='last_name'>Last Name</label>
						<?= form_input('last_name',$user['last_name'], 'id="last_name"') ?>
					
					<label for='username'>Username</label>
						<?= form_input('username',$user['username'], 'id="username"') ?>
					
					<label for='password'>Password</label>
						<?= form_input('password',$user['password'], 'id="password"') ?>

					<?= form_submit('submit', 'Update') ?>
					

				<?= form_close() ?>

			</div>

			<h3><?=$user['first_name'] . " " . $user['last_name'] . " #" . $user['id']?>.</h3> 
			<p>
				<a href="/index.php/admin/delete_employee/<?=$user['id']?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
				<a href="#update_form_<?=$user['id']?>" class="edit_employee">Edit</a>
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
						<td><?=sec_to_output($week['total_seconds'])?>


						</td>
					</tr>
				<?php } ?>
				</tbody>				
			</table>
		<?php } ?>
		
		</div>



		<script type="text/javascript">

		</script>
		
	</body>
</html>

