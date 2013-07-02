<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<title>TimeClock</title>

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/reset.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/style.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/colorbox.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/jquery-ui-1.10.3.custom.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/jquery-ui-timepicker.css" />
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.css" rel="stylesheet">
		<script type="text/javascript" src="/assets/js/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="/assets/js/jquery-validation.js"></script>
		<script type="text/javascript" src="/assets/js/script.js"></script>
	</head>
 
   <body>

   		<div id="wrapper">

   			<div class="company_heading">
			<p><?= $this->user['company']; ?> Timeclock Entries</p>
       		</div>
			
			<div class="nav_bar"
				<ul>
					<li><a href="/index.php/admin/get_entries">Home</a></li> |
					<li><a href="#insert_employee" class ="modal_popup">Add a New Employee</a></li> |
					<li><a href="#project" class = "modal_popup"><?= $this->user['company']; ?> Projects</a></li> | 
					<li>Logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></li>
				</ul> 
			</div>


	        <?php echo $body; ?>
          
    	</div> 

	 	<div class = "hidden">
			<?= form_open('admin/insert_employee', $attributes = array('name' => 'insert_employee', 'id' => 'insert_employee', 'class' => 'validate') ) ?>
				<label for='first_name_new'>First Name</label>
				<?= form_input(array('name'=>'first_name', 'id' =>'first_name_new', 'class'=>'required')) ?>
			<label for='last_name_new'>Last Name</label>
				<?= form_input(array('name'=>'last_name', 'id' =>'last_name_new', 'class'=>'required')) ?>
			<label for='username_new'>Username</label>
				<?= form_input(array('name'=>'username', 'id' =>'username_new', 'class'=>'required')) ?>
			<label for='password_new'>Password</label>
				<?= form_password(array('name'=>'password', 'id' =>'password_new', 'class'=>'required')) ?>
				<label for="role">Role</label> 
				<?= form_dropdown('role', array('employee' => 'Employee', 'admin' => 'Administrator'), 'employee' ); ?>
				<br><br>
				<label for="company">Company</label>
				<?= form_dropdown('company', array('By The Pixel' => 'By The Pixel', 'Reyniers Audio' => 'Reyniers Audio'), '' ); ?>
				<?= form_submit('submit', 'Submit'); ?>
			<?= form_close() ?>
		</div>

		<div class = "hidden">
   			<div id = "project" class="content">
				<h2>Current Projects for <?= $this->user['company']; ?></h2>
				<?php foreach($projects as $key => $project) { ?>
					<?php if($key != 0) { ?>
					<ul>
						<li><?=$project ?></li>
					</ul>
					<?php } ?>
				<?php } ?>
				<a href="#insert_project" class ="modal_popup link"><i class="icon-plus"></i> Add a New Project</a>
				<a href="#delete_project" class ="modal_popup link"><i class="icon-remove"></i> Delete a Project</a>
			</div>
		</div>      


		<div class = "hidden">
			<?= form_open('admin/insert_project', $attributes = array('name' => 'insert_project', 'id' => 'insert_project', 'class' => 'validate') ) ?>
			<label>Create a New Project for <?= $this->user['company']; ?></label>
			<?= form_input( array('name'=>'project', 'class' => 'required') );  ?>
			<?= form_submit('submit', 'Submit'); ?>
			<a href="#project" class = "modal_popup link">Go Back</a>
			<?= form_close() ?>
		</div>

		 <div class = "hidden">
	   	<?= form_open('admin/delete_project', $attributes = array('id' => 'delete_project', 'input type' => 'text') ); ?>
		   		<label for='project_task'>Select the Project You Would Like to Delete</label>
		   		<?= form_dropdown('project', $projects ); ?>
	   		<?= form_submit('submit', 'Submit'); ?>
	   		<a href="#project" class = "modal_popup link">Go Back</a>
	   	<?= form_close(); ?>
   		</div>

   </body>
    
</html>