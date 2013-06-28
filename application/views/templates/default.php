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

		<div class="company_heading">
			<p><?= $this->user['company']; ?> Timeclock Entries</p>
        </div>

		<div class="nav_bar">
			<ul>
				<li>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></li>
			</ul>
		</div>
		
		<?php if ($this->session->flashdata('message')) { ?>
	   	<div class = "flash_employee">
	   	<h3><i class="icon-exclamation-sign"></i><?= $this->session->flashdata('message'); ?></h3>
	   	</div>
	    <?php } ?>

		<h3>Employee Name: <?=$this->user['first_name'] ." ". $this->user['last_name']; ?></h3>
		<?php if($open_entry == 1) { ?>
			<div class="button"><a href="#end_comment" class="modal_popup">CLOCK OUT</a></div>
		<?php } else { ?>
			<div class="button"><a href="start">CLOCK IN</a></div>
		<?php } ?>
         
        
        <?php echo $body; ?>
 

      </div>

      <?php } else { echo $body; } ?>
       
    <div class = "hidden project_form">
	   	<?php $placeholder = "placeholder='Enter a comment about what you did today'"; ?>
	   	<?= form_open('time_entry/end', $attributes = array('id' => 'end_comment', 'input type' => 'text') ); ?>
	   		<label for "Daily Comment" </label>
	   		<label for='project_task'>Select a Project</label>
			<?= form_dropdown('project', array('1' => 'Reyniers Audio', '2' => 'Production') ); ?>
	   		<?= form_textarea('comment', '', $placeholder); ?>
	   		<?= form_submit('submit', 'Submit'); ?>
	   	<?= form_close(); ?>
   </div>


   </body>
    
</html>