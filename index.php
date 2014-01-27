<?php 
session_start();
include_once 'conn.php';
?>
<html>
<head>
	<title>Select Student</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<style type="text/css">
	.form {
		width: 40%;
	}
	</style>
</head>
<body>
	<div class="container">
		<h1>Welcome, Teacher!</h1>
		<h3>Select Student:</h3>
		<div class="form">
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="show_records">
				<select name="student" class="form-control">
				<?php 
				$query = 'SELECT id, name FROM students ORDER BY name ASC';
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_assoc($result))
				{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
				 ?>
				</select>
				<input type="submit" value="Show Exam Record">
			</form>
	</div>
</body>
</html>
