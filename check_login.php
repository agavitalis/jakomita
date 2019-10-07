<?php session_start();
 $user_username = @$_SESSION['user_username'];
 $check_login =@$_POST['check_login'];
 if (isset($check_login)) {
 	if (isset($user_username)) {
 		echo 'yes';
 	}else{
 		echo "<p class='red-text'>Kindly <a href='../signin'>Login</a> to continue</p>";
 	}
 }
 ?>