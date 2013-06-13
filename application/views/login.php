<div id="login_form">
	
	<h1 div id="login_heading">Welcome</h1>

	<?php

	$user_placeholder = 'placeholder="Username"';
	$password_placeholder = 'placeholder="Password"';
	echo form_open('user/verify_credentials');
	echo form_input('username', '',  $user_placeholder);
	echo form_password('password', '', $password_placeholder);
	echo form_submit('submit', 'Log In');

	?>

</div>