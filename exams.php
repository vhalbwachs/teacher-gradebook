<?php 
session_start();
include_once 'conn.php';
?>
<html>
<head>
	<title>Select Student</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<style type="text/css">
	thead {
		font-weight: bold;
	}
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
	<hr><!-- End Of Select Student -->
	<!-- Get Name Of Current Student -->
	<?php 
	$query3 = "SELECT name FROM students where id=".$_SESSION['student_id'];
	$result3 = mysqli_query($conn, $query3);
	$student = mysqli_fetch_assoc($result3);
	 ?>
		<h4>Exam Record For <strong><?= $student['name']; ?></strong>:</h4>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>Exam ID</td>
					<td>Subject</td>
					<td>Grade</td>
					<td>Status (Passed/Failed)</td>
					<td>Teacher's Notes</td>
				</tr>
			</thead>
			<tbody>
				<?php 

		function getStatus($grade)
		{
			if ($grade >= 75) 
			{
				return "Passed";
			}
			else
			{
				return "Failed";
			}
		}

		$query2 = "SELECT id, subject, grade, teachers_note FROM exams WHERE students_id =".$_SESSION['student_id'];

		$result2 = mysqli_query($conn, $query2);

		while($row = mysqli_fetch_assoc($result2))
			{
				echo "<tr>\n";
				echo "<td>".$row['id']."</td><td>".$row['subject']."</td><td>".$row['grade']."</td><td>".getStatus($row['grade'])."</td><td>".$row['teachers_note']."</td>\n";
				echo "</tr>\n";
			}
		 ?>
			</tbody>
		</table><!-- End Of Results -->
		<hr>
		<h4>Add Record for <strong><?= $student['name']; ?></strong>:</h4>
		<!-- Warn user of any errors with form -->
		<?php 
		if (isset($_SESSION['error'])) 
		{
			foreach ($_SESSION['error'] as $name => $message) 
			{
				echo "<p class='text-danger'>".$message."</p>";
			}
			unset($_SESSION['error']);
		} 
		?>
		<div class="form"><!-- Post Exam -->
			<form action="process.php" method="post" class="form-group">
				<input type="hidden" name="action" value="add_record">
				Subject: <input type="text" name="subject" class="form-control"><br>
				Grade: 	<select name="grade" class="form-control">
						<?php  
						for ($i=100; $i>0; $i--) 
						{ 
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						?>
						</select><br>
				Teacher's Notes: <textarea name="teachers_note" class="form-control"></textarea><br>
				<input type="submit" value="Add Record">
			</form>
		</div>
	</div>
</body>
</html>
