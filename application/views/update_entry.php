<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/assets/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">

			<p>You are logged in as <?=$this->user['username']?>.<br><br>
			<a href="/index.php/admin/get_entries">Home</a> / <a href="/index.php/admin/new_employee">Add a New Employee</a> / <a href="/index.php/user/logout">Log Out</a> 


			<h1>Update Time Entry</h1>
			<p>Employee ID: <?= $user_id ?> </p>
			<p>Record ID: <?= $id ?> </p>
			<p>Previous Entry: <?= $start . " - " . $end ?></p>

			<br><h3>Update Entry:</h3>
			
			<?= form_open('time_entry/update', '', array('id' => $id, 'user_id' => $user_id) ) ?>
			
				<label for="start">Start </label>
				<?= form_input('start', $start, 'id="start"') ?>

				<label for="end">End</label>
				<?= form_input('end', $end, 'id="end"') ?>

				<?= form_submit('submit', 'Submit') ?>&nbsp;<button action ="/index.php/admin/view_employee/<?=$user_id?>">Cancel</button>

			<?= form_close() ?>

		</div>

	</body>
</html>

