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
		if(isset($_GET['create_project_button']) && !empty($_GET['create_project_button']) && isset($_GET['project_name']))
		{
			$project = $_GET['project_name'];

			$sql = "INSERT INTO events VALUES (DEFAULT, '{$project}')";
			$query = mysqli_query($link,$sql);

			if (!$query)
			{
				echo "<p class='error-msg'>⚠Error occured: ". mysqli_error($link) . "</p>";
			}
			else
			{
				echo "<h2 class='success-msg'>✅Project was successfully created</h2>";
			}
		}
		else
		{
				echo "<h2 class='error-msg'>⚠Some of the get parameters in the url are missing..</h2>";
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
