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
		<h2>
			Project List:
		</h2>
	</div>

  <!-- as we centered the page i guess class="left" is useless now?? anyways.. -->
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
						echo '<a href="index.php" class="home_button">🏠Home</a>'; //echo "<li><a href='index.php'>Create a project</a>";
					}
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
		mysqli_free_result($result);
		?>

	</div>

	<div class="content">
		<?php
		if (isset($_GET['project_id']))
		{
			$sql = "SELECT * FROM events WHERE  id = '{$_GET['project_id']}'";
			$result = mysqli_query($link,$sql);

			if ($result)
			{
				if (mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_assoc($result);
					echo "<h2>Current Project: {$row['name']}</h2>";
					echo "<a href='delete_project.php?project_id=" . $row['id'] . "' type='button' class='delete-button'>❌Delete project</a>"; //echo "<a href='delete_project.php?project_id={$row['id']}'>Delete project</a>";
				}
				else
				{
					echo "<h2 class='error-msg'>⚠The project you selected does not exist</h2>";
				}
			}
			else
			{
				echo "<p class='error-msg'>⚠Could not make a query request</p>";
			}

		}
		else
		{
			echo "<h2>Create a project</h2>";
			echo '<form action="add_project.php">
			<input type="text" name="project_name" placeholder="Type a project name">
			<input type="submit" name="create_project_button" value="Create Project">
			</form>';
		}
		?>
	</div>

	<div class="footer">
		This is a footer which also goes right across the page.
	</div>

</div>
</body>
</html>
