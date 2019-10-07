<?php 
session_start();
include 'functions.inc.php';
include 'connect.inc.php';
if (isset($_POST['check_username'])) {
	$username =sanitize($_POST['username']);
	$check_username = mysqli_query($conn,"SELECT username FROM users where username = '$username'");
	if (mysqli_num_rows($check_username) == 1) {
		echo "username already taken";
	}else{
		echo "username available";
	}
}

if (isset($_POST['check_email'])) {
	$email =sanitize($_POST['email']);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $check_email = mysqli_query($conn,"SELECT email FROM users where email = '$email'");
		if (mysqli_num_rows($check_email) > 0) {
			echo "email already taken";
		}else{
			echo "email available";
		}  
	}else{
		echo "invalid email address";
	}
	
}

if (isset($_POST['check_login'])) {
	$username = sanitize($_POST['username']);
	$password = sanitize ($_POST['password']);
	$password = sha1(md5($password));
	$checkusser = mysqli_query($conn,"SELECT username from users where `username` = '$username' and `password` = '$password' AND user_level != '0' ");
	if (mysqli_num_rows($checkusser) > 0) {
		echo "yes";
		$_SESSION['admin_username'] = $username; 

	}else{
		echo "<div class='red-text'>You don't have any admin priviledges to access the dashboard</div>";
	}
}

if (isset($_POST['check_login_user'])) {
	$username = sanitize($_POST['username']);
	$password = sanitize ($_POST['password']);
	$password = sha1(md5($password));
	$checkusser = mysqli_query($conn,"SELECT username from users where `username` = '$username' and `password` = '$password'");
	if (mysqli_num_rows($checkusser) > 0) {
		echo "yes";
		$_SESSION['user_username'] = $username; 

	}else{
		echo "<div class='red-text'>Invalid username or password</div>";
	}
}

//user registeration here
if (isset($_POST['register_user'])) {

		//echo "ok";
		$date = time();
		$password = sha1(md5($_POST['password']));
		$fullname = sanitize($_POST['fullname']);
		$username = sanitize($_POST['username']);
		$phone = sanitize($_POST['phone']);
		$email = sanitize($_POST['email']);

		if (!empty($_POST['user_level'])) {
			$user_level = sanitize($_POST['user_level']);
		}else{
			$user_level = "0";
		}

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$check_email = mysqli_query($conn,"SELECT email FROM users where email = '$email'");
				$check_username = mysqli_query($conn,"SELECT username FROM users where username = '$username'");

				if (mysqli_num_rows($check_email) > 0 || mysqli_num_rows($check_username)> 0) {

					echo "Email or Username already taken";
				} 
				else {
				
					$insert_user = mysqli_query($conn,"INSERT INTO users (`name`,`username`,`email`,`password`,`user_level`,`register_date`,`phone`) VALUES('$fullname','$username','$email','$password','$user_level','$date','$phone')");
					if ($insert_user) {
						$_SESSION['user_username'] = $username;
						echo "ok"; 

					}
					else {
						echo "An error occured, you could not be registered";
					}
				}
			}
		
	}

// if (isset($_POST['check_school'])) {
// 	$school =sanitize($_POST['school']);
// 	$check_school = mysqli_query($conn,"SELECT `university_name` FROM `universities` WHERE `university_name` LIKE '%$school%' limit 5");
// 	while ($row = mysqli_fetch_array($check_school)) {
// 		echo "<li class='brown white-text' style='list-style-type:none;cursor:pointer;border-top:.5px solid white;text-align:left;padding-left:5px'>".$row['university_name']."</li>";
// 	}
// }

// if (isset($_POST['confirm_password'])) {
// 	if (!empty($_POST['fullname'])) {
// 	$fullname = sanitize($_POST['fullname']);
// }else{
// 	$err_flag = true;
// 	echo "<li style='list-style-type:none'>Name cannot be empty</li>";
// }

// if (!empty($_POST['email'])) {
// 	$email = sanitize($_POST['email']);
// 	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 	  $check_email = mysqli_query($conn,"SELECT email FROM users where email = '$email'");
// 		if (mysqli_num_rows($check_email) > 0) {
// 			$err_flag = true;
// 			echo "<li style='list-style-type:none'>email already taken</li>";
// 		} 
// 	}else{
// 		$err_flag = true;
// 		echo "<li style='list-style-type:none'>invalid email address</li>";
// 	}
// }else{
// 	$err_flag = true;
// 	echo "<li style='list-style-type:none'>Email cannot be empty</li>";
// }

// if (!empty($_POST['username'])) {
// 	$username = sanitize($_POST['username']);
// 	$check_username = mysqli_query($conn,"SELECT username FROM users where username = '$username'");
// 	if (mysqli_num_rows($check_username) > 0) {
// 		echo "<li style='list-style-type:none'>username already taken</li>";
// 		$err_flag = true;
// 	}
// }else{
// 	$err_flag = true;
// 	echo "<li style='list-style-type:none'>Username cannot be empty</li>";
// }
// if (!empty($_POST['phone'])) {
// 	$phone = sanitize($_POST['phone']);
// }else{
// 	$err_flag = true;
// 	echo "<li style='list-style-type:none'>Phone cannot be empty</li>";
// }
// // if (!empty($_POST['school'])) {
// // 	$school = sanitize($_POST['school']);
// // }else{
// // 	$err_flag = true;
// // 	echo "<li style='list-style-type:none'>School cannot be empty</li>";
// // }
// if (!empty($_POST['user_level'])) {
// 	$user_level = sanitize($_POST['user_level']);
// }else{
// 	$user_level = "0";
// }

// if (!empty($_POST['password'])) {
// 	$password = sanitize($_POST['password']);
// 	if (!empty($_POST['confirm_password'])) {
// 		$password2 = $_POST['confirm_password'];
// 		if ($password === $password2) {
// 			$password = sha1(md5($password));
// 		}else{
// 			$err_flag = true;
// 			echo "<li style='list-style-type:none'>Passwords don't match</li>";
// 		}
// 	}else{
// 		$err_flag = true;
// 		echo "<li style='list-style-type:none'>Confirm Password cannot be empty</li>";
// 	}
// }else{
// 	$err_flag = true;
// 	echo "<li style='list-style-type:none'>Password cannot be empty</li>";
// }	
//}

?>