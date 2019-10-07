<?php session_start();
 $user_username = @$_SESSION['user_username'];
if (!isset($user_username)) {
echo "You need to login before posting a comment";
exit();
}
$y = 0;
for ($a=0; $a < count($_FILES['image']['name']) ; $a++) { 
	if ($_FILES['image']['size'][$a] != 0) {
		$y++;
	}
}
include '../admin/inc/functions.inc.php';
$getuserid = mysqli_fetch_array(mysqli_query($conn,"SELECT profile_id from users where `username` = '$user_username'"));
$realuserid = $getuserid['profile_id'];
$topic_id = sanitize($_POST['topic_id']);
$reply_body = ($_POST['reply_body']);
if (!empty($reply_body) && $y>0) {
 	$date = time();
 	$reply_upload = mysqli_query($conn, "INSERT INTO forum_replies (reply_content,reply_date,forum_topic_id,forum_reply_user_id) VALUES ('$reply_body','$date','$topic_id','$realuserid')");
 	if ($reply_upload) {
 		$updatelastreply = mysqli_query($conn,"UPDATE forum_topic SET last_reply = '$realuserid' WHERE forum_topic_id = '$topic_id'");
 		$fetch_upload_id = mysqli_query($conn,"SELECT * from forum_replies where reply_date = '$date'");
 		if (mysqli_num_rows($fetch_upload_id) >0) {
 			$row = mysqli_fetch_array($fetch_upload_id);
 			$reply_id = $row['reply_id'];
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
								$insert_attachment = mysqli_query($conn,"INSERT INTO forum_reply_attachment (file_reply_img_path,forum_topic_id,forum_reply_id) VALUES ('$customedName','$topic_id','$reply_id')");
							}
							if ($insert_attachment) {
							 	$value2 = 1;
							}
						}
			 		}
				}
				if (isset($value2)) {
					echo "yes!";
				}
			}
		}
	}
}
 if(!empty($reply_body) && $y == 0){
 	$date = time();
 	$reply_upload = mysqli_query($conn, "INSERT INTO forum_replies (reply_content,reply_date,forum_topic_id,forum_reply_user_id) VALUES ('$reply_body','$date','$topic_id','$realuserid')");
 	$updatelastreply = mysqli_query($conn,"UPDATE forum_topic SET last_reply = '$realuserid' WHERE forum_topic_id = '$topic_id'");
 	echo "yes!";
 }
if (empty($reply_body) && $y == 0) {
	echo "Both fields cannot be empty<br>";
	exit();
}
if (empty($reply_body) && $y > 0) {
	$date = time();
 	$reply_upload = mysqli_query($conn, "INSERT INTO forum_replies (reply_date,forum_topic_id,forum_reply_user_id) VALUES ('$date','$topic_id','$realuserid')");
 	if ($reply_upload) {
 		$updatelastreply = mysqli_query($conn,"UPDATE forum_topic SET last_reply = '$realuserid' WHERE forum_topic_id = '$topic_id'");
 		$fetch_upload_id = mysqli_query($conn,"SELECT * from forum_replies where reply_date = '$date'");
 		if (mysqli_num_rows($fetch_upload_id) >0) {
 			$row = mysqli_fetch_array($fetch_upload_id);
 			$reply_id = $row['reply_id'];
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
								$insert_attachment = mysqli_query($conn,"INSERT INTO forum_reply_attachment (file_reply_img_path,forum_topic_id,forum_reply_id) VALUES ('$customedName','$topic_id','$reply_id')");
							}
							if ($insert_attachment) {
							 	$value2 = 1;
							}
						}
			 		}
				}
				if (isset($value2)) {
					echo "yes!";
				}
			}
		}
	}
}
 
 ?>