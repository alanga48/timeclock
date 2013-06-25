<div id="login_form">
	<?php if ($this->session->flashdata('message')) { ?>
  	<div class = "wronglogin_flash"><?= $this->session->flashdata('message'); ?></div>
	<?php } ?>
	
	<div class="login_heading">
		<p>Welcome</p>
	</div>

	<?php

	$user_placeholder = 'placeholder="Username"';
	$password_placeholder = 'placeholder="Password"';
	echo form_open('user/verify_credentials');
	echo form_input('username', '',  $user_placeholder);
	echo form_password('password', '', $password_placeholder);
	echo form_submit('submit', 'Log In');

	?>

