<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<title>BTP TimeClock</title>

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/style.css" />
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/colorbox.css" />
		<script type="text/javascript" src="/assets/js/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="/assets/js/script.js"></script>
	</head>
 
   <body>
       
      <div class="wrapper">

      	<div id="wrapper">
	
			<p>You are logged in as <?=$this->user['username']?>
			<p><a href="/index.php/admin/get_entries">Home</a> / 
			   <a href="#insert_employee" class = "insert_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a></p>

			<h1>Timeclock Entries for <?=$user['first_name'] ." ". $user['last_name']; ?></h1>
			<a href="#insert_entry_<?=$user['id'];?>" class="insert_entry">Add New Time Entry</a> 
          
         <?php echo $body; ?>
          
        </div>
       
     </div>

   </body>
    
</html>