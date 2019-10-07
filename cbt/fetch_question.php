<style type="text/css">
.nextbutton {
    text-align: center;
    border-radius: 0;
    background-color: #1976D2;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: 'Roboto Slab', serif;
    font-weight: 700;
    letter-spacing: 0.65px;
    line-height: 26px;
    transition: all 1s ease 0s;
    -webkit-transition: all 1s ease 0s;
    -moz-transition: all 1s ease 0s;
    -o-transition: all 1s ease 0s;
}

.nextbutton:hover {
    background-color: #333;
    color: #fff;
}
</style>
<?php session_start();

	$username = @$_SESSION['user_username'];
	$cat_name = @$_POST['cat_name'];
	$subject = @$_POST['subject'];
	$mode = @$_POST['mode'];
	$question_number =@$_POST['question_no'];
	$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 
    
    //check if this bave written this exam
    $check_user = mysqli_query($conn," SELECT * FROM scores WHERE `user_name`= '$username'");
    $check_user_count =  mysqli_num_rows($check_user);
    if($check_user_count > 0){

        echo "<script> 
            alert('You have taken this test, you can only take it once')
            window.location = 'result'

        
        </script>";
    }else{

        //check for already existing questions
        $select_questions = mysqli_query($conn," SELECT * FROM cbt_selected_questions WHERE `question_category`= '$cat_name' AND `question_subject_name` = '$subject' AND `username` = '$username' ");
        $number_of_questions =  mysqli_num_rows($select_questions);


        if (mysqli_num_rows($select_questions) < 1) {

                $select_new_questions = mysqli_query($conn," SELECT * FROM cbt_questions WHERE `category`= '$cat_name' AND  `subject` ='$subject'order by  rand() limit 30 ");

                $cbt_time = mysqli_query($conn," SELECT * FROM cbt_time WHERE `category`= '$cat_name' AND  `subject` ='$subject' ");

                $time_array = mysqli_fetch_array($cbt_time);
                
                $time_given = $time_array['time_duration_minutes'];
                $insert_time = mysqli_query($conn,"INSERT INTO cbt_current_time (username,sub_name,category,time_written) VALUES ('$username','$subject','$cat_name','$time_given')");


                while ($row = mysqli_fetch_array($select_new_questions)) {
                    $question_id = $row['question_id'];
                    $question = $row['question'];
                    $category = $row['category'];
                    $subject_name = $row['subject'];
                    $correct_answer = $row['answer'];
                    $image = $row['image'];
                    $option_a = $row['option_a'];
                    $option_b = $row['option_b'];
                    $option_c = $row['option_c'];
                    $option_d = $row['option_d'];
                    $description = $row['description'];
                    $insert_questions = mysqli_query($conn,"INSERT INTO cbt_selected_questions (username,question_id,question,option_a,option_b,option_c,option_d,image,question_category,question_subject_name,correct_answer,explanation) VALUES ('$username','$question_id','$question','$option_a','$option_b','$option_c','$option_d','$image','$category','$subject_name','$correct_answer','$description')");
                }
        }

    }

	
    

	if ((!isset($_POST['updateanswer'])&& (!isset($_POST['updatetime'])) && (!isset($_POST['gamemode'])))) {
				$get_questions = mysqli_query($conn," SELECT * FROM cbt_selected_questions WHERE `question_category`= '$cat_name' AND `question_subject_name` = '$subject' AND `username` = '$username' LIMIT 5 offset $question_number ");
	 	while ($values = mysqli_fetch_array($get_questions)) {
			
		?>

        <div class="event-box"
            style="border: 2px solid #ECECEC;padding-top:2%;padding-bottom:2%;margin-top: 20px;margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-12" style="padding:5%">
                    <h3><?php echo($values['question']) ?></h3>
                    <div class="event-meta">
                        <p>
                            <input class="answer" question_number="<?php echo($values['selected_question_id']) ?>" type="radio"
                                name="answer<?php echo($values['selected_question_id']) ?>"
                                value="<?php echo($values['option_a']) ?>" <?php if ((!is_null($values['answer_chosen']) && ($values['answer_chosen'] == $values['option_a']))) {
                    echo "checked";
                } ?>>
                            <label for="first">A:<?php echo($values['option_a']) ?></label>
                        </p>
                        <p>
                            <input class="answer" question_number="<?php echo($values['selected_question_id']) ?>" type="radio"
                                name="answer<?php echo($values['selected_question_id']) ?>"
                                value="<?php echo($values['option_b']) ?>" <?php if ((!is_null($values['answer_chosen']) && ($values['answer_chosen'] == $values['option_b']))) {
                    echo "checked";
                } ?>>
                            <label for="second">B:<?php echo($values['option_b']) ?></label>
                        </p>
                        <p>
                            <input class="answer" question_number="<?php echo($values['selected_question_id']) ?>" type="radio"
                                name="answer<?php echo($values['selected_question_id']) ?>"
                                value="<?php echo($values['option_c']) ?>" <?php if ((!is_null($values['answer_chosen']) && ($values['answer_chosen'] == $values['option_c']))) {
                    echo "checked";
                } ?>>
                            <label for="third">C: <?php echo($values['option_c']) ?></label>
                        </p>
                        <p>
                            <input class="answer" question_number="<?php echo($values['selected_question_id']) ?>" type="radio"
                                name="answer<?php echo($values['selected_question_id']) ?>"
                                value="<?php echo($values['option_d']) ?>" <?php if ((!is_null($values['answer_chosen']) && ($values['answer_chosen'] == $values['option_d']))) {
                    echo "checked";
                } ?>>
                            <label for="fourth">D:&nbsp<?php echo($values['option_d']) ?></label>
                        </p>
                    </div>
                </div>
                <?php if ($mode =='game') {
                    
                ?>
                <div class="clearfix"></div>
                <button style="margin-left: 5%" onclick="gamemarker('<?php echo($values['selected_question_id']); ?>')"
                    class="btn btn-info" id="showanswer<?php echo($values['selected_question_id']);  ?>">MARK</button>


                <button style="display: none;" onclick="gamemarker('<?php echo($values['selected_question_id']); ?>')"
                    class="btn btn-info" id="more<?php echo($values['selected_question_id']);  ?>" data-toggle="collapse"
                    data-target="#tellmmemore<?php echo($values['selected_question_id']);  ?>">Tell me more!</button>

                <div id="tellmmemore<?php echo($values['selected_question_id']);  ?>" class="collapse"
                    style="border: 2px solid #ECECEC; padding-left:3%; width:85%; padding-top:2%;padding-bottom:2%;margin:20px auto">
                    <?php echo($values['explanation']); ?>
                </div>


                <button style="display: none;" onclick="gamemarker('<?php echo($values['selected_question_id']); ?>')"
                    class="btn btn-info" id="why<?php echo($values['selected_question_id']);  ?>" data-toggle="collapse"
                    data-target="#whythis<?php echo($values['selected_question_id']);  ?>">Why?</button>
                <div id="whythis<?php echo($values['selected_question_id']);  ?>" class="collapse"
                    style="border: 2px solid #ECECEC; padding-left:3%; width:85%; padding-top:2%;padding-bottom:2%;margin:20px auto">
                    <?php echo($values['explanation']); ?>
                </div>






                <?php } ?>
            </div>

        </div>


<?php }}

		if (isset($_POST['updateanswer'])) {
			$answer = $_POST['answer'];
			$question_number = $_POST['question_number'];
			$updateanswer = mysqli_query($conn,"UPDATE cbt_selected_questions SET answer_chosen = '$answer' WHERE selected_question_id = '$question_number'");

		}
		if (isset($_POST['updatetime'])) {
			$username = @$_SESSION['user_username'];
			$cat_name = @$_POST['cat_name'];
			$subject = @$_POST['subject'];
			$ctime = @$_POST['ctime'];
			$updatetime = mysqli_query($conn,"UPDATE cbt_current_time SET time_written = '$ctime' WHERE sub_name = '$subject' AND category = '$cat_name' AND username = '$username'");

		}
		if (isset($_POST['gamemode'])) {
			echo "ok";
		}
	
 ?>
<nav class="ow-pagination">
    <ul class="pagination">
        <?php 
       		if ($question_number != 0) {
       			echo '<input style="margin-bottom:20px; margin-right:1em;" onclick="previous('.$question_number.')" class="nextbutton" value="Previous" readonly>';
       		}
       		if (($question_number + 5) < $number_of_questions) {
       			echo '<input style="margin-bottom:20px" onclick="next('.$question_number.')" class="next nextbutton"  value="Next" readonly><br>';
       		}
       	 ?>
    </ul>


</nav>

<script type="text/javascript">
$('.answer').click(function() {
    var answer = $(this).val();
    var question_number = $(this).attr('question_number');
    updateanswer(answer, question_number);
})

$(".submit").click(function(e) {

})
</script>