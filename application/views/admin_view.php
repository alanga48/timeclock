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

	<p class="employee_info">
		EMPLOYEE NAME: <?=$user['first_name'] . " " . $user['last_name'] . " #" . $user['id']?>
		<i class="icon-pencil"> </i><a href="#update_form_<?=$user['id']?>" class ="modal_popup" class="edit_employee">Edit</a> |
		<i class="icon-remove"> </i><a href="/index.php/admin/delete_employee/<?=$user['id']?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
	</p> 

	<table id="table_admin">
		<thead id="thead_admin">		
			<tr>
				<th>WEEK OF</th>
				<th>WEEK TOTAL: </th>
			</tr>
		</thead>

		<tbody>
		<?php foreach($user['weeks'] as $week) { ?>
			<?php $week_number = date("W", strtotime($week['start']) )?>
			<tr>
				<td><?=$week['start'] . " - " . $week['end']?></td>
				<td><a href="/index.php/admin/view_employee/<?=$user['id']?>/#details_<?=$week_number?>"><?=sec_to_output($week['total_seconds'])?></a></td>
			</tr>
		<?php } ?>
		</tbody>				
	</table>
<?php } ?>
		
