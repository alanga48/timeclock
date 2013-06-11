<h2>Weekly Timeclock Summary By Employee</h2>
<?php foreach($users as $key => $user) { ?>

	<div class="hidden">

		<?= form_open('admin/edit_employee', $attributes = array('name' => 'edit_employee', 'id' => 'update_form_' . $user['id'], 'class' => 'validate'), array('id'=>$user['id']) ) ?>
			<label for='first_name_<?=$user['id']?>'>First Name</label>
				<?= form_input(array('name'=>'first_name', 'value'=>$user['first_name'], 'id' =>'first_name_' . $user['id'], 'class'=>'required')) ?>
			<label for='last_name_<?=$user['id']?>'>Last Name</label>
				<?= form_input(array('name'=>'last_name', 'value'=>$user['last_name'], 'id' =>'last_name_' . $user['id'], 'class'=>'required')) ?>
			<label for='username_<?=$user['id']?>'>Username</label>
				<?= form_input(array('name'=>'username', 'value'=>$user['username'], 'id' =>'username_' . $user['id'], 'class'=>'required')) ?>
			<label for='password_<?=$user['id']?>'>Password</label>
				<?= form_password(array('name'=>'password', 'value'=>$user['password'], 'id' =>'password_' . $user['id'], 'class'=>'required')) ?>
			<?= form_submit('submit', 'Update') ?>
		<?= form_close() ?>

	</div>

	<h3>EMPLOYEE NAME: <?=$user['first_name'] . " " . $user['last_name'] . " #" . $user['id']?></h3> 
		
	<div class="nav_bar">
		<ul>
		<li><a href="#update_form_<?=$user['id']?>" class ="modal_popup" class="edit_employee">Edit Employee Info</a></li> |
		<li><a href="/index.php/admin/delete_employee/<?=$user['id']?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete Employee</a></li> |
		<li><a href="/index.php/admin/view_employee/<?=$user['id']?>">View TimeClock Detail</a></li> 
		</ul>
	</div>

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
		
