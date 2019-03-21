<?php
require ('db_connect.php');

if (!isset($_GET['submit']) && empty($_GET['submit']))
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
		<p>
			Area for buttons
		</p>
	</div>

	<div class="content">
		<?php
			echo "Step 1</br>";
			if (isset($_GET['name']) && !empty($_GET['name']) && isset($_GET['priority']) && !empty($_GET['priority']) && isset($_GET['date']) && !empty($_GET['date']))
			{
				echo "Step 2</br>";
				$date = date("Y-m-d H:i:s", strtotime($_GET['date']));
				echo "Step 3 - date: " . $date . "</br>";
				$sql = "INSERT INTO tasks VALUES (DEFAULT, '" .$_GET['name'] . "', '" . $_GET['priority'] . "', '" . $date . "', '" . $_GET['project_id'] . "')";
				echo "Step 4 - Query Command:" . $sql . "</br>";
				$query = mysqli_query($link,$sql);
				echo "Query Result:" . $query;
				if ($query)
				{
					echo "Successfully added new task to Project: " . $_GET['project_id'];
				}
				else
				{
					echo "<p class='error-msg'>⚠Error occured: ". mysqli_error($link) . "</p>";
				}
			}
				else {
					echo "Some of the firstt checks failed.</br>";
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
