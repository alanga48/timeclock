<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<title>BTP TimeClock</title>

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

		<?php if($this->session->userdata('is_logged_in') == TRUE ) { ?>

		<div id="wrapper">
		<div class="nav_bar">
			<ul>
				<li>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></li>
			</ul>
		</div>

		<h1>By The Pixel Timeclock Entries</h1>

		<h3>Employee Name: <?=$this->user['first_name'] ." ". $this->user['last_name']; ?></h3>
		<?php if($open_entry == 1) { ?>
			<div class="button"><a href="end">CLOCK OUT</a></div>
		<?php } else { ?>
			<div class="button"><a href="start">CLOCK IN</a></div>
		<?php } ?>
         
        
        <?php echo $body; ?>
 

      </div>

      <?php } else { echo $body; } ?>
       
   </body>
    
</html>