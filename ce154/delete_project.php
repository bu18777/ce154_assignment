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
		if (isset($_GET['project_id']))
		{
			$project_id = $_GET['project_id'];
			$project_exists = false;
			// Check if project exist
			$checktasks = "SELECT * FROM events WHERE id = '{$project_id}'";
			$checkresult = mysqli_query($link,$checktasks);
			if($checkresult)
			{
				if(mysqli_num_rows($checkresult) <= 0)
				{
					echo "<h2 class='error-msg'>⚠No such project exists!</h2>";
				}
				else
				{
						$project_exists = true;
				}
			}

			if($project_exists)
			{
			// Delete the project from events
			$deletetasks = "DELETE FROM events WHERE id = '{$project_id}'";
			$deleteresults = mysqli_query ($link,$deletetasks);

			if ($deleteresults)
			{
				echo "<h2 class='success-msg'>✅Project successfully deleted</h2>";
			}
			else
			{
				echo "<h2 class='error-msg'>⚠Failed to delete the project!</h2>";
			}


			// Check the tasks of the project
			$checktasks = "SELECT * FROM tasks WHERE event_id = '{$project_id}'";
			$checkresult = mysqli_query($link,$checktasks);
			$deleteProject = false;
			if ($checkresult)
			{
				if (mysqli_num_rows($checkresult) > 0)
				{
							// Delete the remaining tasks of the project.
							$sql = "DELETE FROM events WHERE id = '{$project_id}'";
							$result = mysqli_query($link,$sql);
							if(!$result)
							{
								echo "<h2 class='error-msg'>⚠WARNING failed to delete the tasks of the project!</h2>";
							}
				}
			}
			else
			{
					echo "<h3 class='error-msg'>⚠Failed on executing the select query command!</h2>";
			}
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
