<?php
require ('db_connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Events Management System</title>
	<link rel="stylesheet" href="css/assignment.css">
	<link rel="stylesheet" href="css/table.css">
	<link rel="stylesheet" href="css/create-task.css">
</head>
<body>
<div class="container">
	<div class="header">
		<h1 class="header-title">
			Events Management System
		</h1>
	</div>
</br>
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
					else
					{
					echo '<h2 class="header">Project List:</h2>';
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

					echo "<table class='table-1' align='center'>";
					echo "<tr>";
					echo "<th class='table-column-headers'>Task Name</th>";
					echo "<th class='table-column-headers'>Priority</th>";
					echo "<th class='table-column-headers'>Due Date</th>";
					echo "<th class='table-column-headers'>Update Task</th>";
					echo "<th class='table-column-headers'>Delete Task</th>";
					echo "</tr>";

					$fetch = "SELECT * FROM tasks WHERE event_id = '{$_GET['project_id']}'";
					$tasksresult = mysqli_query($link,$fetch);
					if ($tasksresult)
					{
						if (mysqli_num_rows($tasksresult) > 0)
						{
							while($row2 = mysqli_fetch_assoc($tasksresult))
							{
								echo "<tr>";
								echo "<td class='table-element'>" .$row2['name'] . "</td>";
								echo "<td class='table-element-". $row2['priority'] ."'>" .$row2['priority'] . "</td>";
								echo "<td class='table-element'>" .$row2['date'] . "</td>";
								echo "<td class='table-element'>" . "<a href='update_task.php?id={$row2['id']}&project_id={$_GET['project_id']}'>Update Task</a>" . "</td>";
								echo "<td class='table-element'>" . "<a href='delete_task.php?id={$row2['id']}&project_id={$_GET['project_id']}'>Delete Task</a>" . "</td>";
								echo "</tr>";
							}
						}
					}
					else
					{
						echo "No tasks found for this project";
					}
					echo "</table>";
					$currentDate = date("Y-m-d");
					echo "</br><form method='get' action='add_task.php' class='create-task-border'>";
					echo "<h3 class='create-task-header'>Create a Task</h3>";
					echo "<div class='create-task-labels'>Task Name: <input type='text' name='name' class='create-task-inputs' placeholder='Task Name'> </div>";
					echo "<div class='create-task-labels'>Priority: <select name='Priority' class='create-task-inputs'>";
					echo "<option value='Low'>Low</option>";
					echo "<option value='Medium'>Medium</option>";
					echo "<option value='High'>High</option>";
					echo "</select></div>";
					echo "<div class='create-task-labels'>Due date: <input type='date' name='date' class='create-task-inputs' value=".$currentDate."></div>";
					echo "<br>";
					echo "<input type='hidden' name='project_id' value='" . $_GET['project_id']."'/>";
					echo "<input type='submit' value='Create Task' name='submit' class='create-task-button'>";
					echo "</form></br></br>";

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
			// In case you are wondering why onclick="return checkNameLength();",
			// lets say we wrote onclick="return false" here the onclick function returns instantly false before the submit() function gets called,
			// so this prevents the submit() function from being called, and we return this value from our javascript function depending on the namelength.
			echo '<form action="add_project.php">
			<input type="text" class="create-project-input" minlength=2 name="project_name" placeholder="Type a project name">
			<input type="submit" name="create_project_button" class="create-project-button" value="Create Project" onclick="return checkNameLength();">
			</form>';
		}
		?>
	</div>


</div>
<div class="footer">
	This is a footer which also goes right across the page.
</div>

<!-- Javascript Starts here -->
<script>
// Check if the project name is too short. Above we put the minlength attribute in code but this is only HTML5 supported and is not supported by older-browsers
// so just in case if the user is using a older browser that does not support HTML5 we will also check the name length via javascript.
function checkNameLength()
{
	var projectName = document.getElementsByName("project_name")[0].value;
	if(projectName.length < 2)
	{
		alert("The project name needs to be atleast 2 characters long.");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<!-- Javascript Ends here -->
</body>
</html>
