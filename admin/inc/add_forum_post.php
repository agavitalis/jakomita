<?php 
include 'connect.inc.php';

	if (isset($_POST['add_post'])) {
		if (!empty($_POST['title'])) {
			$title = sanitize($_POST['title']);
		}else{
			$err_flag = true;
			echo "Post title cannot be empty<br>";
		}
		// if ($_FILES['attachment']['size'] > 0) {
		// 	$file = $_FILES['attachment'];
		// 	echo $file['name'];
		// }
		$date = time();
		if (!empty($_POST['post_category'])) {
			$category = $_POST['post_category'];
		}else{
			echo "Category cnanot be empty<br>";
		}
		if (!empty($_POST['body'])) {
			$body = ($_POST['body']);
			$body = htmlspecialchars($body);
			$body = strip_tags($body);
			$body = mysqli_real_escape_string($conn,$body);
			echo $body;
		}else{
			$err_flag = true;
			echo "Post body cannot be empty<br>";
		}
	
	}
 ?>