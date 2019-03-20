<?php
require ('db_connect.php');

if (!isset($_GET['create_project_button']) && empty($_GET['create_project_button'])) {
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
		<h1 class="header">
			Events Management System
		</h1>
	</div>
	
	<div class="left">
		<p>
			Area for buttons
		</p>
	</div>
	
	<div class="content">
		<?php
			$project = $_GET['project_name'];

			$sql = "INSERT INTO events VALUES (DEFAULT, '{$project}')";
			$query = mysqli_query($link,$sql);

			if (!$query) {
				echo "Error occured: ". mysqli_error($link);
			}
			else {
				echo "<h2>Project was successfully created</h2>";
			}
			
			
			echo "<a href='index.php'>Return to homepage</a>";
		?>
	</div>
	
	<div class="footer">
		This is a footer which also goes right across the page.
	</div>
</div>
</body>
</html>