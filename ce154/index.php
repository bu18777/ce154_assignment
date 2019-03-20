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
		<h1 class="header">
			Events Management System
		</h1>
	</div>
	
	<div class="left">
		
		<?php
			$sql = "SELECT * FROM events";
			$result = mysqli_query($link,$sql);
			
			if ($result) {
				if (mysqli_num_rows($result) > 0) {
					echo "<ul>";
					echo "<li><a href='index.php'>Create a project</a>";
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<li>" . "<a href='index.php?project_id={$row['id']}'>{$row['name']}</a>" . "</li>";
					}
					echo "</ul>";
				}
			}
		mysqli_free_result($result);
		?>
		
	</div>
	
	<div class="content">
		<?php
		
		if (isset($_GET['project_id'])){
			
			$sql = "SELECT * FROM events WHERE  id = '{$_GET['project_id']}'";
			$result = mysqli_query($link,$sql);
			
			if ($result) {
				if (mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_assoc($result);
					
					echo "<h2>Current Project: {$row['name']}</h2>";
					echo "<a href='delete_project.php?project_id={$row['id']}'>Delete project</a>";
				}
				else {
					echo "<h2>The project you selected does not exist</h2>";
				}
			}
			else {
				echo "Could not make a query request";
			}
			
		}
		else {
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