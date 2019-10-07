<?php 
$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
$link = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 

function sanitize($input)
{
	global $link;
	$input= trim($input);
	$input = strip_tags($input);
	$input = mysqli_real_escape_string($link,$input);
	
	return $input;
}
 ?>
