<?php 
session_start();
include_once 'conn.php';

function add_record($conn, $post)
{
	foreach ($post as $name => $value) 
	{
		if(empty($value))
		{
			$_SESSION['error'][$name] = "Sorry, " . $name . " cannot be blank";
		}
	}
	if(!isset($_SESSION['error']))
	{
		$insert_query = "INSERT INTO exams (students_id, subject, grade, teachers_note, created_at, updated_at) VALUES ('".$_SESSION['student_id']."', '".$post['subject']."', '".$post['grade']."', '".$post['teachers_note']."', now(), now())";
		mysqli_query($conn, $insert_query);			
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'show_records')
{
	$_SESSION['student_id'] = $_POST['student'];
    header('Location: exams.php');
}
else if(isset($_POST['action']) && $_POST['action'] == 'add_record')
{
    add_record($conn, $_POST);
    header('Location: exams.php');
}

?>