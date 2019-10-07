<?php 
$link = mysqli_connect("localhost","root","","jakomita");
$conn = mysqli_connect("localhost","root","","jakomita");

function sanitize($input)
{
	global $link;
	$input= trim($input);
	$input = strip_tags($input);
	$input = mysqli_real_escape_string($link,$input);
	
	return $input;
}
 ?>
