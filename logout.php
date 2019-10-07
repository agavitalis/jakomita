<?php 
session_start();
session_destroy();
$a = $_SERVER['HTTP_REFERER'];
header("Location: $a");
 ?>