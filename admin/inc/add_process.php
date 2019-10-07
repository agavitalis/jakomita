<?php 
session_start();
$admin_username = $_SESSION['admin_username'];
$conn = mysqli_connect("localhost","root","","jakomita");
$checkuser_id = mysqli_fetch_array(mysqli_query($conn,"SELECT * from users where `username` = '$admin_username' "));
$user_id = $checkuser_id['profile_id'];
include 'functions.inc.php';

	//inserts a new forum category
	if (isset($_POST['add_cat'])) {
		$category = strtolower(sanitize($_POST['category']));
		$category_description = sanitize($_POST['category_description']);
		$checkcat = mysqli_query($conn,"SELECT forum_cat_name FROM forum_categories WHERE forum_cat_name = '$category' ");
		if (mysqli_num_rows($checkcat) > 0) {
			echo "Category already exists";
		}else{
			$insertcategory = mysqli_query($conn,"INSERT INTO forum_categories (forum_cat_name,	forum_cat_description) VALUES ('$category','$category_description')");
			if ($insertcategory) {
				echo "New category inserted successfully";
			}else{
				echo "An error has occured while inserting the new category";
			}
		}
	}

	//deletes an exam category
	if (isset($_POST['delete_exam_cat'])) {
		$categorydelete=$_POST['categorydelete'];
		$deletecategory = mysqli_query($conn,"DELETE FROM cbt_categories WHERE cbt_cat_id = '$categorydelete' ");
		if ($deletecategory) {
			echo"yes";
		}else{
			echo"no";
		}

	}

	//adds a new exam category
	if (isset($_POST['add_exam_cat'])) {
		$category = strtolower(sanitize($_POST['category']));
		$level = strtolower(sanitize($_POST['level']));
		$category_description = sanitize($_POST['cat_description']);
		$upload_date= time();
		$random = rand(0,10000);
		$tmp_name = $_FILES['category_picture']['tmp_name'];
				$name = $_FILES['category_picture']['name'];
				$size = $_FILES['category_picture']['size'];
				$type = $_FILES['category_picture']['type'];
				$img_ext = explode('/', $type);
				$img_ext = strtolower(end($img_ext));				
				$customedName = $upload_date.$random.'.'.$img_ext;					
				$file_dir = "../../uploads/".$customedName;
				$filenewpath = "../uploads/".$customedName;

				
		$checkcat = mysqli_query($conn,"SELECT cbt_cat_name FROM cbt_categories WHERE cbt_cat_name = '$category' ");
		if (mysqli_num_rows($checkcat) > 0) {
			echo "Category already exists";
		}else{
			$send = move_uploaded_file($tmp_name, $file_dir);			
			$insertcategory = mysqli_query($conn,"INSERT INTO cbt_categories (cbt_cat_name,	cat_description,`level`,category_picture,picturename) VALUES ('$category','$category_description','$level','$filenewpath','$customedName')");
			if ($insertcategory) {
				echo "New category inserted successfully";
			}else{
				echo "An error has occured while inserting the new category";
			}
		}
	}


	//adds a new exam based on the already existing categories
	if(isset($_POST['registerexam'])){

		$filename=$_FILES["exam"]["tmp_name"];
		$subject= $_POST['examname'];
		$examcategory= $_POST['examcategory'];
		$examtime= $_POST['examtime'];
		$examdescription= $_POST['examdescription'];
		$examinstruction= $_POST['examinstruction'];

		//check for a text file
		$type = $_FILES['exam']['type'];
		$ext = explode('/', $type);
	
		$ext = strtolower(end($ext));

			
		//check the size to ensure the file is not empty
		if($_FILES["exam"]["size"] > 0)
		{
				//check and run this code only for plain stuffs
				if ($ext == 'plain') {

						$myfile=fopen($filename,"r");
						//do this till the end of file
						$counter = 1;
						while(!feof($myfile)) {

							if($counter == 1){

								$chunk = fgets($myfile);
								//insert into the database, the chunk collected
								$insertcategory = mysqli_query($conn,"INSERT INTO cbt_questions (`question`,`subject`,`category`) VALUES ('$chunk','$subject','$examcategory')");
								$selecthim = mysqli_query($conn,"SELECT * FROM cbt_questions ORDER BY question_id DESC LIMIT 1");
								
									while($row = mysqli_fetch_assoc($selecthim)) {
									$present_id = $row["question_id"];
									}

								$counter += 1;
						 
							
							}
							//option a
							elseif($counter == 2){

								$chunk = fgets($myfile);
								$chunk = trim($chunk);
								//insert into the database, the chunk collected
								

								$insertcategory = mysqli_query($conn,"UPDATE cbt_questions SET `option_a`= '$chunk' WHERE `question_id`= $present_id ");
								$counter += 1;

							}
							//option b
							elseif($counter == 3){

								$chunk = fgets($myfile);
								$chunk = trim($chunk);
								//insert into the database, the chunk collected
								

								$insertcategory = mysqli_query($conn,"UPDATE cbt_questions SET `option_b`= '$chunk' WHERE `question_id`= $present_id ");
								$counter += 1;
								
							}
							//option c
							elseif($counter == 4){

								$chunk = fgets($myfile);
								$chunk = trim($chunk);
								//insert into the database, the chunk collected
								

								$insertcategory = mysqli_query($conn,"UPDATE cbt_questions SET `option_c`= '$chunk' WHERE `question_id`= $present_id ");
								$counter += 1;
								
							}
							//option d
							elseif($counter == 5){

								$chunk = fgets($myfile);
								$chunk = trim($chunk);
								//insert into the database, the chunk collected
								

								$insertcategory = mysqli_query($conn,"UPDATE cbt_questions SET `option_d`= '$chunk' WHERE `question_id`= $present_id ");
								$counter += 1;
								
							}
							//ans
							elseif($counter == 6){

								$chunk = fgets($myfile);
								$chunk = trim($chunk);
								//insert into the database, the chunk collected
								

								$insertcategory = mysqli_query($conn,"UPDATE cbt_questions SET `answer`= '$chunk' WHERE `question_id`= $present_id ");
								$counter += 1;
								
							}
							//descrition
							elseif($counter == 7){

								$chunk = fgets($myfile);
								//insert into the database, the chunk collected
								

								$insertcategory = mysqli_query($conn,"UPDATE cbt_questions SET `description`= '$chunk' WHERE `question_id`= $present_id ");
								$counter += 1;
								
							}
							// //Skip a line
							elseif($counter == 8){
									
								$chunk = fgets($myfile);
								$counter = 1;
							}




						}
						
					 fclose($myfile);

				}
				else{
					//open the file in read only mode
					$file = fopen($filename, "r");
					//skip first line
					fgetcsv($file);
					//loop through other lines
					while (($line = fgetcsv($file)) !== FALSE)
					{
						
						//insert into the database, I skiped array 0 since our Id is auto increasing
						$insertcategory = mysqli_query($conn,"INSERT INTO cbt_questions (`question`,`option_a`,`option_b`,`option_c`,`option_d`,`answer`,`description`,`image`,`subject`,`category`) 
						VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".$line[6]."','".$line[7]."','$subject','$examcategory' )");

						
					}

				}
			//check if the query ran
			if($insertcategory){
				$checksubject = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM cbt_subjects WHERE `sub_name`='$subject'AND `sub_cat`='$examcategory'"));
				if ($checksubject < 1) {
					$inserttime= mysqli_query($conn,"INSERT INTO cbt_subjects (`sub_cat`,`sub_name`) VALUES ('$examcategory','$subject')");
				}
				$checktimeavailable = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM cbt_time WHERE `subject`='$subject'AND `category`='$examcategory'"));
				if ($checktimeavailable < 1) {
					$inserttime= mysqli_query($conn,"INSERT INTO cbt_time (`subject`,`category`,`time_duration_minutes`) VALUES ('$subject','$examcategory','$examtime')");
				}
				$checkdescription = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM cbt_instruction where `cat_name`='$examcategory' AND `sub_name`= '$subject' "));
				if ($checkdescription < 1) {
					$insertinstruction= mysqli_query($conn,"INSERT INTO cbt_instruction (`cat_name`,`sub_name`,`cbt_description`,`exam_instruction`) VALUES ('$examcategory','$subject','$examdescription','$examinstruction')");
				}
				echo "Exam successfullly inserted";
			}
			else{
				echo "Babam an error occured";
			}
		}
		
		echo "I arrived succcessfully";
	}






	//adds anew post to the database
	if (isset($_POST['add_post'])) {
		if (!empty($_POST['title'])) {
			$title = sanitize($_POST['title']);
		}else{
			$err_flag = true;
			echo "Post title cannot be empty<br>";
		}
		$date = time();
		if (!empty($_POST['post_category'])) {
			$category = $_POST['post_category'];
		}else{
			$err_flag = true;
			echo "Category cnanot be empty<br>";
		}
		if (!empty($_POST['body'])) {
			$body = ($_POST['body']);
			$body = str_replace("../", "../../", $body);
			$body = str_replace("<div><img height=\"300\"", "<div class=\"center-align\"><img class=\"responsive-img\"", $body);
			$body = htmlspecialchars($body);
			$body = strip_tags($body);
			$body = mysqli_real_escape_string($conn,$body);
			
		}else{
			$err_flag = true;
			echo "Post body cannot be empty<br>";
		}
		@$checkduplicate = mysqli_query($conn,"SELECT * FROM forum_topic WHERE topic_title ='$title'");
		if (mysqli_num_rows($checkduplicate) > 0) {
			$err_flag = true;
			echo "topic already exists";
		}
		if (!isset($err_flag)) {
			 $formattedtitle = str_replace("|", "", $title);
            $formattedtitle = str_replace(" ", "-", $formattedtitle);
            $formattedtitle=str_replace(" ","-", $formattedtitle);$formattedtitle=str_replace("--","-", $formattedtitle);
            $formattedtitle=str_replace("@","-",$formattedtitle);$formattedtitle=str_replace("/","-",$formattedtitle);
            $formattedtitle=str_replace("\\","-",$formattedtitle);$formattedtitle=str_replace(":","",$formattedtitle);
            $formattedtitle=str_replace("\"","",$formattedtitle);$formattedtitle=str_replace("'","",$formattedtitle);
            $formattedtitle=str_replace("<","",$formattedtitle);$formattedtitle=str_replace(">","",$formattedtitle);
            $formattedtitle=str_replace(",","",$formattedtitle);$formattedtitle=str_replace("?","",$formattedtitle);
            $formattedtitle=str_replace(";","",$formattedtitle);$formattedtitle=str_replace(".","",$formattedtitle);
            $formattedtitle=str_replace("[","",$formattedtitle);$formattedtitle=str_replace("]","",$formattedtitle);
            $formattedtitle=str_replace("(","",$formattedtitle);$formattedtitle=str_replace(")","",$formattedtitle);
            $formattedtitle=str_replace("*","",$formattedtitle);$formattedtitle=str_replace("!","",$formattedtitle);
            $formattedtitle=str_replace("$","-",$formattedtitle);$formattedtitle=str_replace("&","-and-",$formattedtitle);
            $formattedtitle=str_replace("%","",$formattedtitle);$formattedtitle=str_replace("#","",$formattedtitle);
            $formattedtitle=str_replace("^","",$formattedtitle);$formattedtitle=str_replace("=","",$formattedtitle);
            $formattedtitle=str_replace("+","",$formattedtitle);$formattedtitle=str_replace("~","",$formattedtitle);
            $formattedtitle=str_replace("`","",$formattedtitle);$formattedtitle=strtolower(str_replace("--","-",$formattedtitle));
			$insertpost = mysqli_query($conn,"INSERT INTO forum_topic (topic_title,topic_body,topic_date,topic_cat_id,topic_by,formatted_url,last_reply) VALUES('$title','$body','$date','$category','$user_id','$formattedtitle','$user_id')");
		}


		if (@$insertpost) {
			echo "Update was successfully done";
		}
	
	}

 ?>