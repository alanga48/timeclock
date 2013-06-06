<div id="login_form">
	
	<h1 div id="login_heading">Welcome</h1>

	<?php

	echo form_open('user/verify_credentials');
	echo form_input('username', 'Username');
	echo form_password('password', 'Password');
	echo form_submit('submit', 'Log In');

	?>

</div>