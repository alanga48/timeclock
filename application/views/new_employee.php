<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">

			<p>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></p>
			<a href="/index.php/admin/get_entries">Return to all employees</a>

			<h3>Update Time Entry</h3>

			<?= form_open('admin/insert_user') ?>
			
				<label for="first_name">First Name </label>			
				<?= form_input('first_name') ?>

				<label for="last_name">Last Name</label>
				<?= form_input('last_name') ?>

				<label for="username">Username</label>
				<?= form_input('username') ?>

				<label for="password">Password</label>
				<?= form_input('password'); ?>

				<label for="role">Role</label>
				<?= form_dropdown('role', array('employee' => 'Employee', 'administrator' => 'Administrator'), 'employee' ); ?>

				<button type='submit'>Submit</button>

			<?= form_close() ?>

		</div>

	</body>
</html>

