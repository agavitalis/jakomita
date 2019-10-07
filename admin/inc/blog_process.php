<?php 
session_start();
$admin_username = $_SESSION['admin_username'];
$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 
$checkuser_id = mysqli_fetch_array(mysqli_query($conn,"SELECT * from users where `username` = '$admin_username' "));
$user_id = $checkuser_id['profile_id'];
include 'functions.inc.php';
include 'connect.inc.php';

if (isset($_POST['add_cat'])) {
	$category = $_POST['category'];
	$checkcat = mysqli_query($conn,"SELECT blog_cat_name FROM blog_categories WHERE blog_cat_name = '$category' ");
	if (mysqli_num_rows($checkcat) > 0) {
			echo "Category already exists";
	}
	else{
		$insertcategory = mysqli_query($conn,"INSERT INTO blog_categories (blog_cat_name) VALUES ('$category')");
		if ($insertcategory) {
			echo "New category inserted successfully";
		}else{
			echo "An error has occured while inserting the new category";
		}
	}
}

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
		@$checkduplicate = mysqli_query($conn,"SELECT * FROM blog_post WHERE topic_title ='$title'");
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
			$insertpost = mysqli_query($conn,"INSERT INTO blog_post (topic_title,topic_body,topic_date,topic_cat_id,topic_by,formatted_url) VALUES('$title','$body','$date','$category','$user_id','$formattedtitle')");
		}


		if (@$insertpost) {
			echo "Update was successfully done";
		}
	
	}
 ?>
