<?php
require ('db_connect.php');

if (!isset($_GET['project_id']) && empty($_GET['project_id']))
{
	header('Location: index.php');
	die();
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Events Management System</title>
	<link rel="stylesheet" href="css/assignment.css">
</head>
<body>
<div class="container">
	<div class="header">
		<h1 class="header">
			Events Management System
		</h1>
	</div>

	<div class="left">
		<p>
			Area for buttons
		</p>
	</div>

	<div class="content">
		<?php
			$project_id = $_GET['project_id'];

			$sql = "DELETE FROM events WHERE id = '{$project_id}'";
			$result = mysqli_query($link,$sql);

			if ($result)
			{
				echo "<h2 class='success-msg'>✅Project successfully deleted</h2>";
			}
			else
			{
				echo "<h2 class='error-msg'>⚠Could not delete project</h2>";
			}
			echo "<a href='index.php' class='home_button'>🏠Return to homepage</a>";
		?>
	</div>

	<div class="footer">
		This is a footer which also goes right across the page.
	</div>
</div>
</body>
</html>
