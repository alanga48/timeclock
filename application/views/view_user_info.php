<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">

			<p>You are logged in as <?=$this->user['username']?>. 

			<?php if(isset($submitted) && $submitted == 1) { ?>

				<h2>Your changes have been submitted. </h2><a href="/index.php/admin/get_entries">Return to Home</a>


			<?php } else { ?>


			<p><a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/view_user_info/<?=$user['id'];?>">Edit Employee</a> / <a href="/index.php/user/logout">Log Out</a></p>

			<h2>Edit Employee Information</h2>
			<h4>Update Existing Employee #<?=$user['id']?></h4>

			<?= form_open('admin/edit_employee', '', $id = array('id'=>$user['id']) ) ?>
				
				<label for='first_name'>First Name</label>
					<?= form_input('first_name', $user['first_name'], 'id="first_name"') ?>
				
				<label for='last_name'>Last Name</label>
					<?= form_input('last_name', $user['last_name'], 'id="last_name"') ?>
				
				<label for='username'>Username</label>
					<?= form_input('username', $user['username'], 'id="username"') ?>
				
				<label for='password'>Password</label>
					<?= form_input('password', $user['password'], 'id="password"') ?>

				<?= form_submit('submit', 'Update') ?>

			<?= form_close() ?>
			<br> <br />
			<h2>Delete this Employee</h2>
			<p>Clicking the following link will permanently delete <?=$user['first_name'] ." ". $user['last_name']?>, Employee ID#<?=$user['id']?>. This action cannot be undone.</p>
			<p><a href="/index.php/admin/delete_employee/<?=$user['id']?>">Delete this Employee</a></p>

		<?php } ?>


		</div>

	</body>
</html>

