<!DOCTYPE html>
<html lang="en">
	<meta charset="utf-8" />

	<head>
		<link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
	</head>

	<body>
			
		<div id="wrapper">

			<p>You are logged in as <?=$this->user['username']?>. <a href="/index.php/user/logout">Log Out</a></p>
			<a href="/index.php/admin/get_entries">Return to all employees</a>

			<h3>Update Time Entry</h3>
			<br>
			<p>Employee ID: <?= $user_id ?> </p>
			<p>Record ID: <?= $id ?> </p>
			<p>Previous Entry: <?= $start . " - " . $end ?></p>

			<h4>Update Entry:</h4>
			
			<?= form_open('time_entry/update', '', array('id' => $id, 'user_id' => $user_id) ) ?>
			
				<label for="start">Start </label>			
				<?= form_input('start', $start, 'id="start"') ?>

				<label for="end">End</label>
				<?= form_input('end', $end, 'id="end"') ?>

				<?= form_submit('submit', 'Submit') ?>

			<?= form_close() ?>

		</div>

	</body>
</html>

