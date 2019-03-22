<?php
require ('db_connect.php');

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
		<h1 class="header-title">
			Events Management System
		</h1>
	</div>

	<div class="content">
		<?php
		if (isset($_GET['project_id']) && isset($_GET['id']))
		{
			$sql = "DELETE FROM tasks WHERE id = '{$_GET['id']}'";
			$result = mysqli_query($link,$sql);

			if ($result)
			{
				echo "<h2 class='success-msg'>✅Task successfully deleted</h2>";
				echo "Redirecting to the project page after 3 seconds.";
				header('refresh: 3; url= index.php?project_id=' . $_GET['project_id']);
			}
			else
			{
				echo "<h2 class='error-msg'>⚠Could not delete task</h2>";
			}
		}
		else
		{
			echo "<h2 class='error-msg'>⚠Some of the get parameters in the url are missing..</h2>";
		}
		echo "</br><a href='index.php' class='home_button'>🏠Return to homepage</a>";
		?>
	</div>

	<div class="footer">
		This is a footer which also goes right across the page.
	</div>
</div>
</body>
</html>
