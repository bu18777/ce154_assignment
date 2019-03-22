<?php
require ('db_connect.php');

if (!isset($_GET['id']) && empty($_GET['id']))
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
		
			$sql = "SELECT * FROM tasks WHERE id = '{$_GET['id']}'";
			$result = mysqli_query($link,$sql);
			
			if ($result){
				if (mysqli_num_rows($result) == 1) {
					while ($row = mysqli_fetch_assoc($result)){
						$date = date('Y-m-d\TH:i',strtotime($row['date']));
						
						echo "<h3>Update a Task</h3>";
						echo "<form method='get' action='edit.php'>";
						echo "Task Name: <input type='text' name='name' value='{$row['name']}'>";
						echo "<br>";
						echo "Priority: <select name='Priority'>";
						echo "<option value='Low'>Low</option>";
						echo "<option value='Medium'>Medium</option>";
						echo "<option value='High'>High</option>";
						echo "</select>";
						echo "<br>";
						echo "Due date: <input type='datetime-local' name='{$date}'>";
						echo "<br>";
						echo "<input type='hidden' name='task_id' value='" . $row['id']."'/>";
						echo "<input type='submit' value='Update Task' name='submit'>";
						echo "</form>";
					}
				}
				else {
					echo "Task does not exist";
				}
			}
			else {
				echo "Could not execute the query.";
			}

			echo "<br><a href='index.php' class='home_button'>🏠Return to homepage</a>";
		?>
	</div>

	<div class="footer">
		This is a footer which also goes right across the page.
	</div>
</div>
</body>
</html>
