<?php session_start();
 $user_username = @$_SESSION['user_username'];
$post_id = ($_POST['post_id']);
$y = 0;
for ($a=0; $a < count($_FILES['image']['name']) ; $a++) { 
	if ($_FILES['image']['size'][$a] > 0) {
		$y++;
	}
}
include '../admin/inc/functions.inc.php';
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

if (!empty($_POST['body'])) {
	$body = ($_POST['body']);
	$body = htmlspecialchars($body);
	$body = strip_tags($body);
	$body = mysqli_real_escape_string($conn,$body);
}else{
	$err_flag = true;
	echo "Post body cannot be empty<br>";
}
// @$checkduplicate = mysqli_query($conn,"SELECT * FROM forum_topic WHERE topic_title ='$title'");
// if (mysqli_num_rows($checkduplicate) > 0) {
// 	$err_flag = true;
// 	echo "topic already exists";
// }
if (!isset($err_flag)) {
	if (!empty($body) && $y>0) {
 	$topic_upload = mysqli_query($conn, "UPDATE forum_topic SET topic_title = '$title', topic_body = '$body' WHERE forum_topic_id = '$post_id'");
	 	if ($topic_upload) {
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
								$insert_attachment = mysqli_query($conn,"INSERT INTO forum_topic_attachment (topic_file_attachment_name,forum_topic_id) VALUES ('$customedName','$post_id')");
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
	if(!empty($body) && $y == 0){
 		$topic_upload = mysqli_query($conn, "UPDATE forum_topic SET topic_title = '$title', topic_body = '$body' WHERE forum_topic_id = '$post_id'");
	 	echo "yes!";
 	}
	if (empty($body) && $y == 0) {
		echo "Both fields cannot be empty<br>";
		exit();
	}
	if (empty($body) && $y > 0){
	 	$topic_upload = mysqli_query($conn, "UPDATE forum_topic SET topic_title = '$title', topic_body = '$body' WHERE forum_topic_id = '$post_id'");
	 	if ($topic_upload) {
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
 ?>