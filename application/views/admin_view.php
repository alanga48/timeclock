<div id="wrapper">

		<div class = "flash">
			<h3><?= $this->session->flashdata('message'); ?></h3>
		</div>

		<p>You are logged in as <?=$this->user['username']?>.<br><br> 
		<a href="/index.php/admin/get_entries">Home</a> / <a href="#insert_employee" class = "insert_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a> 

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
						<?= form_password('password',$user['password'], 'id="password"') ?>
					<?= form_submit('submit', 'Update') ?>
				<?= form_close() ?>

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

			<h3><?=$user['first_name'] . " " . $user['last_name'] . " #" . $user['id']?></h3> 
			<p>
				<a href="/index.php/admin/delete_employee/<?=$user['id']?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete Employee</a> /
				<a href="#update_form_<?=$user['id']?>" class="edit_employee">Edit Employee</a> /
				<a href="/index.php/admin/view_employee/<?=$user['id']?>">View TimeClock Detail</a>

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


