<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">

			<p>You are logged in as <?=$this->user['username']?>.<br><br> 
				<a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/new_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a> 

			<h1>Add a New Employee</h1>

			<?= form_open('admin/insert_user') ?>
			
				<label for="first_name">First Name </label>			
				<?= form_input('first_name') ?>

				<label for="last_name">Last Name</label>
				<?= form_input('last_name') ?>

				<label for="username">Username</label>
				<?= form_input('username') ?>

				<label for="password">Password</label>
				<?= form_password('password'); ?>

				<label for="role">Role</label>
				<?= form_dropdown('role', array('employee' => 'Employee', 'administrator' => 'Administrator'), 'employee' ); ?>

				<br><br><button type='submit'>Submit</button>&nbsp;<button action="/index.php/admin/get_entries">Cancel</button>


			<?= form_close() ?>
			


		</div>

	</body>
</html>

