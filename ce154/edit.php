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
			echo "</br>";
			if (isset($_GET['submit']) && !empty($_GET['submit']) && isset($_GET['project_id']) &&isset($_GET['task_id']) && isset($_GET['name']) && !empty($_GET['name']) && isset($_GET['Priority']) && !empty($_GET['Priority']) && isset($_GET['date']) && !empty($_GET['date']))
			{
				$date = date("Y-m-d H:i:s", strtotime($_GET['date']));
				$sql = "UPDATE tasks SET name ='{$_GET['name']}', priority ='{$_GET['Priority']}', date ='{$date}' WHERE id = '{$_GET['task_id']}' ";
				$query = mysqli_query($link,$sql);

				if ($query)
				{
					echo "Successfully updated the task: " . $_GET['name'] . "</br>";
					echo "Redirecting to the project page after 3 seconds.";
					header('refresh: 3; url= index.php?project_id=' . $_GET['project_id']);
				}
				else
				{
					echo "<p class='error-msg'>⚠Error occured: ". mysqli_error($link) . "</p>";
				}
			}
			else
			{
					echo "<h2 class='error-msg'>⚠Some of the get parameters in the url are missing..</h2>";
			}
			echo "</br>";

			echo "<br><a href='index.php' class='home_button'>🏠Return to homepage</a>";
		?>
	</div>

	<div class="footer">
		This is a footer which also goes right across the page.
	</div>
</div>
</body>
</html>
