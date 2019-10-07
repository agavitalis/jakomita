<?php 
$conn = mysqli_connect("localhost","root","","jakomita");


if (isset($_POST['gamemode'])) {
	$questionid = $_POST['selected_question_id'];
	$get_questions = mysqli_query($conn," SELECT * FROM cbt_selected_questions WHERE `selected_question_id`= '$questionid' ");
	$row = mysqli_fetch_array($get_questions);
	$answer_chosen = $row['answer_chosen'];
	$correct_answer = $row['correct_answer'];	
	if (trim($answer_chosen) == trim($correct_answer)) {
		echo "ok";
	}else{
		echo 'no';
	}
}
?>