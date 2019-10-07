<?php session_start();
 $user_username = @$_SESSION['user_username'];
// $category_id = ($_POST['cat_id']);
// echo $category_id;
$y = 0;
for ($a=0; $a < count($_FILES['image']['name']) ; $a++) { 
	if ($_FILES['image']['size'][$a] > 0) {
		$y++;
	}
}
include '../admin/inc/functions.inc.php';
$getuserid = mysqli_fetch_array(mysqli_query($conn,"SELECT profile_id from users where `username` = '$user_username'"));
$realuserid = $getuserid['profile_id'];
if (!empty($_POST['title'])) {
	$title = sanitize($_POST['title']);
	if (strlen($title) > 100) {
		$err_flag = true;
	echo "Post title should not be more than 100 characters<br>";
	}else{
	$lowertitle = strtolower($title);
	$formattedtitle = str_replace("|", "", $lowertitle);
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
            $formattedtitle=str_replace("`","",$formattedtitle);$formattedtitle=str_replace("--","-",$formattedtitle);
        }
}else{
	$err_flag = true;
	echo "Post title cannot be empty<br>";
}
if (!empty($_POST['cat_id'])) {
	$category = $_POST['cat_id'];
	$realCatName =  str_replace("-"," ", $category);
	$fetchcatid = mysqli_fetch_array(mysqli_query($conn, "SELECT forum_cat_id from forum_categories where `forum_cat_name` = '$realCatName'"));
	$category = $fetchcatid['forum_cat_id'];
}else{
	$err_flag = true;
	echo "Category cannot be empty<br>";
}
if (!empty($_POST['body'])) {
	$body = ($_POST['body']);
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
	if (!empty($body) && $y>0) {
 	$date = time();
 	$topic_upload = mysqli_query($conn, "INSERT INTO forum_topic (topic_title,topic_body,topic_date,topic_cat_id,topic_by,formatted_url,last_reply) VALUES('$title','$body','$date','$category','$realuserid','$formattedtitle','$realuserid')");
 	if ($topic_upload) {
 		
 		$fetcchpostid = mysqli_query($conn,"SELECT * from forum_topic where topic_date = '$date'");
 		if (mysqli_num_rows($fetcchpostid) >0) {
 			$row = mysqli_fetch_array($fetcchpostid);
 			$topic_id = $row['forum_topic_id'];
 			if (count($_FILES['image'])>0) {
				for ($i=0; $i < count($_FILES['image']['name']) ; $i++) { 
				 	if ($_FILES['image']['size'][$i] > 0) {
						$tmp_name = $_FILES['image']['tmp_name'][$i];
						$name = $_FILES['image']['name'][$i];
						$size = $_FILES['image']['size'][$i];
						$type = $_FILES['image']['type'][$i];
						$allowed_ext = array("jpg", "png","gif","jpeg");
						$img_ext = explode('/', $type);
						$img_ext = strtolower(end($img_ext));
						if (in_array($img_ext, $allowed_ext)) {
							$img_ext = $img_ext;
						}else{
							echo ($i+1).". Image type not allowed. (Please upload an image with the following extensions: .jpg, .png, .jpeg or .gif)<br>";
							$err_flag = true;
						}

						if ($size > 2048000) {
							echo ($i+1).". Your image size is too large. Please select an image below 2mb file size.";
							$err_flag = true;
							}
						if (!isset($err_flag)) {
							$upload_date= time();
							$random = rand(0,10000);
							$customedName = $upload_date.$random.'.'.$img_ext;
							$file_dir = "../uploads/".$customedName;
							$filenewpath = "../uploads/".$customedName;
							$send = move_uploaded_file($tmp_name, $file_dir);
							if ($send) {
								$insert_attachment = mysqli_query($conn,"INSERT INTO forum_topic_attachment (topic_file_attachment_name,forum_topic_id) VALUES ('$customedName','$topic_id')");
							}
							if ($insert_attachment) {
							 	$value = 1;
							}
						}
			 		}
				}
				if (isset($value)) {
					echo "yes!";
				}
			}
		}
	}
}
 if(!empty($body) && $y == 0){
 	$date = time();
 	$topic_upload = mysqli_query($conn, "INSERT INTO forum_topic (topic_title,topic_body,topic_date,topic_cat_id,topic_by,formatted_url,last_reply) VALUES('$title','$body','$date','$category','$realuserid','$formattedtitle','$realuserid')");
 	
 	echo "yes!";
 }
if (empty($body) && $y == 0) {
	echo "Both fields cannot be empty<br>";
	exit();
}
if (empty($body) && $y > 0) {
	$date = time();
 	$topic_upload = mysqli_query($conn, "INSERT INTO forum_topic (topic_date,forum_topic_id,forum_reply_user_id) VALUES ('$date','$topic_id','$realuserid')");
 	if ($topic_upload) {
 		
 		$fetcchpostid = mysqli_query($conn,"SELECT * from forum_topic where topic_date = '$date'");
 		if (mysqli_num_rows($fetcchpostid) >0) {
 			$row = mysqli_fetch_array($fetcchpostid);
 			$topic_id = $row['forum_topic_id'];
 			if (count($_FILES['image'])>0) {
				for ($i=0; $i < count($_FILES['image']['name']) ; $i++) { 
				 	if ($_FILES['image']['size'][$i] > 0) {
						$tmp_name = $_FILES['image']['tmp_name'][$i];
						$name = $_FILES['image']['name'][$i];
						$size = $_FILES['image']['size'][$i];
						$type = $_FILES['image']['type'][$i];
						$allowed_ext = array("jpg", "png","gif","jpeg");
						$img_ext = explode('/', $type);
						$img_ext = strtolower(end($img_ext));
						if (in_array($img_ext, $allowed_ext)) {
							$img_ext = $img_ext;
						}else{
							echo ($i+1).". Image type not allowed. (Please upload an image with the following extensions: .jpg, .png, .jpeg or .gif)<br>";
							$err_flag = true;
						}

						if ($size > 2048000) {
							echo ($i+1).". Your image size is too large. Please select an image below 2mb file size.";
							$err_flag = true;
							}
						if (!isset($err_flag)) {
							$upload_date= time();
							$random = rand(0,10000);
							$customedName = $upload_date.$random.'.'.$img_ext;
							$file_dir = "../uploads/".$customedName;
							$filenewpath = "../uploads/".$customedName;
							$send = move_uploaded_file($tmp_name, $file_dir);
							if ($send) {
								$insert_attachment = mysqli_query($conn,"INSERT INTO forum_topic_attachment (topic_file_attachment_name,forum_topic_id) VALUES ('$customedName','$topic_id')");
							}
							if ($insert_attachment) {
							 	$value =1;
							}
						}
			 		}
				}
				if (isset($value)) {
					echo "yes!";
				}
			}
		}
	}
}
}
 
 ?>