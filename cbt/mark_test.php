<?php session_start();

$username = @$_SESSION['user_username'];
$cat_name = @$_POST['cat_name'];
$subject = @$_POST['subject'];
$mode = @$_POST['mode'];
$conn = mysqli_connect("localhost", "root", "", "jakomita");

if ($mode != 'game') {
    $get_questions = mysqli_query($conn, " SELECT * FROM cbt_selected_questions WHERE `question_category`= '$cat_name' AND `question_subject_name` = '$subject' AND `username` = '$username'");

    $_SESSION['number_of_questions'] = mysqli_num_rows($get_questions);
    $_SESSION['cat_name'] = $cat_name;
    $_SESSION['subject'] = $subject;

    $score = 0;

    while ($row = mysqli_fetch_array($get_questions)) {
        $answer_chosen = $row['answer_chosen'];
        $correct_answer = $row['correct_answer'];
        if (trim($answer_chosen) == trim($correct_answer)) {
            $score++;
        }
    }

}

$delete_time = mysqli_query($conn, "DELETE FROM `cbt_current_time` WHERE `cbt_current_time`.`username` = '$username' AND `cbt_current_time`.`sub_name` = '$subject' AND `cbt_current_time`.`category` = '$cat_name'");
$_SESSION['score'] = $score;

//insert in score table
//$insert_questions = mysqli_query($conn,"INSERT INTO cbt_selected_questions (username,question_id,question,option_a,option_b,option_c,option_d,image,question_category,question_subject_name,correct_answer,explanation) VALUES ('$username','$question_id','$question','$option_a','$option_b','$option_c','$option_d','$image','$category','$subject_name','$correct_answer','$description')");

$number_of_questions = $_SESSION['number_of_questions'];
$score_sql = "INSERT INTO scores (`user_name`, `category`,`subject`,`score`,`number_of_questions`) VALUES ('$username','$cat_name','$subject','$score','$number_of_questions')";
$insert_score = mysqli_query($conn,$score_sql);

if($insert_score){

	echo "yes";

}


