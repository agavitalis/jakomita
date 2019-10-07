<?php 
session_start();
$username = $_SESSION['admin_username'];
include 'functions.inc.php';
include 'connect.inc.php';

$fullname = sanitize($_POST['fullname']);
$email = sanitize($_POST['email']);
$phone = sanitize($_POST['phone']);
$school = sanitize($_POST['school']);
$bio = sanitize($_POST['bio']);
$gender = sanitize($_POST['gender']);
$website = sanitize($_POST['website']);
$profile_pix = $_FILES['profile_pix'];
if ($profile_pix['size'] > 0) {
	$img_size = $profile_pix['size'];
$img_name = $profile_pix['name'];
$img_type = $profile_pix['type'];
$img_temp = $profile_pix['tmp_name'];
$date = time();
$rand = rand(0,1000);
$allowed_ext = array("jpg", "png","gif","jpeg");
$img_ext = explode('/', $img_type);
$img_ext = strtolower(end($img_ext));
$customedname = "jako".$rand.$date.".".$img_ext;
if (in_array($img_ext, $allowed_ext)) {
	$img_ext = $img_ext;
	}else{
		echo "Image type not allowed. (Please upload an image with the following extensions: .jpg, .png, .jpeg or .gif)";
		$err_flag = true;
	}
if ($img_size > 512000) {
	echo "Your image size is too large. Please select an image below 500kb file size.";
	$err_flag = true;
	}
$file_dir = "../uploads/".$customedname;
if (!isset($err_flag)) {
	move_uploaded_file($img_temp, $file_dir);
	$updatedetails = mysqli_query($conn,"UPDATE users SET name = '$fullname',email = '$email',school = '$school',phone = $phone, bio = '$bio', website = '$website',user_img_path = '$customedname',gender='$gender' WHERE username = '$username'");
	if ($updatedetails) {
		echo "Profile Updated successfully!";
	}else{
		echo "An error occured. Try again";
	}
}
}else{
	$updatedetails = mysqli_query($conn,"UPDATE users SET name = '$fullname',email = '$email',school = '$school',phone = $phone, bio = '$bio', website = '$website',gender='$gender' WHERE username = '$username'");
	if ($updatedetails) {
		echo "Profile Updated successfully!";
	}else{
		echo "An error occured. Try again";
	}
}
 ?>
