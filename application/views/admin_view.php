<?php if ($this->session->flashdata('message')) { ?>
    <div class = "flash">
	<h3><i class="icon-exclamation-sign"></i> <?= $this->session->flashdata('message'); ?></h3>
	</div>
<?php } ?>

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
			<label for="company">Company</label>
			<?= form_dropdown('company', array('btp' => 'By The Pixel', 'r_audio' => 'Reyniers Audio'), '' ); ?>
			<?= form_submit('submit', 'Update') ?>
		<?= form_close() ?>

	</div>

	
		<div class="title">
			<h4>
				<div class="name"><?=$user['first_name'] . " " . $user['last_name'] . " #" . $user['id']?></div> 
				<a href="#details_<?=$user['id']?>" class="details"><i class="icon-expand"></i>Week Summary</a> |
				<a href="/index.php/admin/view_employee/<?=$user['id']?>"><i class="icon-time"> </i>Timeclock Details</a> |
				<a href="#update_form_<?=$user['id']?>" class ="modal_popup edit_employee"><i class="icon-pencil"></i>Edit Employee</a> |
				<a href="/index.php/admin/delete_employee/<?=$user['id']?>" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="icon-remove"></i>Delete Employee</a> 
			</h4>
		</div>
		

			<div class="details_box" id="details_<?=$user['id']?>"> 
				<?php if($user['weeks']) { ?>
					<table class="table">
						<thead>		
							<tr>
								<th>WEEK OF</th>
								<th>WEEK TOTAL</th>
							</tr>
						</thead>

						<tbody>
						<?php foreach($user['weeks'] as $week) { ?>
							<?php $week_number = date("W", strtotime($week['start']) )?>
							<tr>
								<td><?=date("M d, Y", strtotime($week['start'])) . "  -  " . date("M d, Y", strtotime($week['end']))?></td>
								<td><a href="/index.php/admin/view_employee/<?=$user['id']?>/#details_<?=$week_number?>" class="week_links"><?=sec_to_output($week['total_seconds'])?></a></td>
							</tr>
						<?php } ?>
						</tbody>				
					</table>
				
				<?php } else { ?>

				<p>There are no time entries for this employee. <a href="view_employee/<?=$user['id']?>/#insert_entry_<?=$user['id']?>" class="link"> Add a New Entry</a></p>

				<?php } ?>

		</div> 

<?php } ?>
		
