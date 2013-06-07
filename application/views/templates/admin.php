<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<title>BTP TimeClock</title>

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/style.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/colorbox.css" />
		<script type="text/javascript" src="/assets/js/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="/assets/js/script.js"></script>
	</head>
 
   <body>


      	<div id="wrapper">
	      	
	      	<?php if ($this->session->flashdata('message')) { ?>
	      	<div class = "flash">
				<h3><?= $this->session->flashdata('message'); ?></h3>
			</div>
			<?php } ?>
		
			<p>You are logged in as <?=$this->user['username']?>
			<a href="/index.php/admin/get_entries">Home</a> / 
			<a href="#insert_employee" class = "insert_employee">Add a New Employee</a> / 
			<a href="/index.php/user/logout">Log Out</a> 
	          
	         <?php echo $body; ?>
          
    	</div>       

	 	<div class = "hidden">
			<?= form_open('admin/insert_employee', $attributes = array('id' => 'insert_employee') ) ?>
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
				<br><br><button type='submit'>Submit</button>
			<?= form_close() ?>
		</div>

   </body>
    
</html>