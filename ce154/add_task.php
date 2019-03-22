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

			if (isset($_GET['submit']) && !empty($_GET['submit']) && isset($_GET['name']) && isset($_GET['Priority']) && !empty($_GET['Priority']) && isset($_GET['date']) && !empty($_GET['date'])){

				$date = date("Y-m-d H:i:s", strtotime($_GET['date']));
				$sql = "INSERT INTO tasks VALUES (DEFAULT, '{$_GET['name']}', '{$_GET['Priority']}', '{$date}', '{$_GET['project_id']}')";
				$query = mysqli_query($link,$sql);

				echo "</br>";
				if ($query)
				{
					echo "Successfully added new task to Project: " . $_GET['project_id'] . "</br>";
					echo "Redirecting to the project page after 3 seconds.";
					header('refresh: 3; url= index.php?project_id=' . $_GET['project_id']);
				}
				else
				{
					echo "<p class='error-msg'>⚠Error occured: ". mysqli_error($link) . "</p>";
				}
			}


			echo "</br></br><a href='index.php' class='home_button'>🏠Return to homepage</a>";
		?>
	</div>

	<div class="footer">
		This is a footer which also goes right across the page.
	</div>
</div>
</body>
</html>
