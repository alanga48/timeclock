<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
<div id="login_form">
<h2>Welcome</h2>

<?php

echo form_open('user/verify_credentials');
echo form_input('username', 'Username');
echo form_input('password', 'Password');
echo form_submit('submit', 'Log In');

?>

</div>