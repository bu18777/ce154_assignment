<?php
require ('db_connect.php');


?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Events Management System</title>
	<link rel="stylesheet" href="css/assignment.css">
	<link rel="stylesheet" href="css/create-task.css">
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
		if (isset($_GET['id'])  && isset($_GET['project_id']))
		{
			$sql = "SELECT * FROM tasks WHERE id = '{$_GET['id']}'";
			$result = mysqli_query($link,$sql);

			if ($result){
				if (mysqli_num_rows($result) == 1) {
					while ($row = mysqli_fetch_assoc($result))
					{
						$date = date('Y-m-d',strtotime($row['date']));

						echo "</br><form method='get' action='edit.php' class='create-task-border'>";
						echo "<h3 class='create-task-header'>Update a Task</h3>";
						echo "<div class='create-task-labels'>Task Name: <input type='text' name='name' class='create-task-inputs' placeholder='Task Name' value=".$row['name']."> </div>";
						echo "<div class='create-task-labels'>Priority: <select name='Priority' class='create-task-inputs'>";
						if($row['priority'] === "Low")
						{
							echo "<option value='Low' selected>Low</option>";
						}
						else
						{
							echo "<option value='Low'>Low</option>";
						}
						if($row['priority'] === "Medium")
						{
							echo "<option value='Medium' selected>Medium</option>";
						}
						else
						{
							echo "<option value='Medium'>Medium</option>";
						}
						if($row['priority'] === "High")
						{
							echo "<option value='High' selected>High</option>";
						}
						else
						{
							echo "<option value='High'>High</option>";
						}
						echo "</select></div>";
						echo "<div class='create-task-labels'>Due date: <input type='date' name='date' class='create-task-inputs' value=".$row['date']."></div>";
						echo "<br>";
						echo "<input type='hidden' name='task_id' value='" . $_GET['id']."'/>";
						echo "<input type='hidden' name='project_id' value='" . $_GET['project_id']."'/>";
						echo "<input type='submit' value='Update' name='submit' class='create-task-button'>";
						echo "</form></br></br>";
					}
				}
				else {
					echo "Task does not exist";
				}
			}
			else {
				echo "Could not execute the query.";
			}
			}
			else
			{
				echo "<h2 class='error-msg'>⚠Some of the get parameters in the url are missing..</h2>";
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
