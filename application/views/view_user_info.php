<div id="wrapper">

	<p>You are logged in as <?=$this->user['username']?>. 

	<?php if(isset($submitted) && $submitted == 1) { ?>

		<h2>Your changes have been submitted. </h2><a href="/index.php/admin/get_entries">Return to Home</a>


	<?php } else { ?>


	<p><a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/view_user_info/<?=$user['id'];?>">Edit Employee</a> / <a href="/index.php/user/logout">Log Out</a></p>

	<h1>Edit Employee Information</h1>
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

		<?= form_submit('submit', 'Update') ?>&nbsp;<button><a href="/index.php/admin/get_entries">Cancel</a></button>

	<?= form_close() ?>


<?php } ?>


</div>
