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
		<h1 class="header-title">
			Events Management System
		</h1>
	</div>

	<div class="left">
		<?php
			$sql = "SELECT * FROM events";
			$result = mysqli_query($link,$sql);

			if ($result)
			{
				if (mysqli_num_rows($result) > 0)
				{
					// Check if we are viewing the Homepage or a project.
					if(isset($_GET['project_id']))
					{
						// If we are in a project display the home button.
						echo '<a href="index.php" class="home_button">ğ Home</a>'; //echo "<li><a href='index.php'>Create a project</a>";
					}
					else {
					echo "<ul>";
					while ($row = mysqli_fetch_assoc($result))
					{
						// Check if we are viewing the Homepage or a project.
						if(isset($_GET['project_id']))
						{
							// Check if this is the current project that we are viewing.
							if($_GET['project_id'] == $row['id'])
							{
								// If it is then assign the active class.
								echo "<li>" . '<a href="#" class="list-item-active">' . $row['name'] . '</a>' . "</li>";//echo "<li>" . "<a href='index.php?project_id={$row['id']}'>{$row['name']}</a>" . "</li>";
							}
							else
							{
								// If not assign a normal item class.
								echo "<li>" . '<a href="index.php?project_id=' . $row['id'] . '" class="list-item">' . $row['name'] . '</a>'. "</li>";
							}
						}
						else
						{
								// We are viewing the homepage, print as a normal item.
								echo "<li>" . '<a href="index.php?project_id=' . $row['id'] . '" class="list-item">' . $row['name'] . '</a>'. "</li>";//echo "<li>" . "<a href='index.php?project_id={$row['id']}'>{$row['name']}</a>" . "</li>";
						}
					}
					echo "</ul>";
					}
				}
			}
		mysqli_free_result($result);
		?>
	</div>

	<div class="content">
		<?php
			$project_id = $_GET['project_id'];
			
			$checktasks = "SELECT * FROM tasks WHERE event_id = '{$project_id}'";
			$checkresult = mysqli_query($link,$checktasks);
			
			if ($checkresult){
				if (mysqli_num_rows($checkresult) > 0){
					$deletetasks = "DELETE FROM tasks WHERE '{$project_id}'";
					$deleteresults = mysqli_query ($link,$deletetasks);
					
					if ($deleteresults){
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
					}
					else {
						echo "Could not delete tasks and project.";
					}
				}
			}
				else {
					echo "Could not fetch results";
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
