<?php 
include '../admin/inc/functions.inc.php';
if (isset($_POST['reply'])) {
	$reply_id = $_POST['reply_id'];
	$delete_reply = mysqli_query($conn,"DELETE FROM forum_replies where reply_id = '$reply_id'");
	if ($delete_reply) {
		echo "yes";
	}
}

if (isset($_POST['delete'])) {
	$delete_id = $_POST['delete_id'];
	$delete_reply = mysqli_query($conn,"DELETE FROM forum_topic where forum_topic_id = '$delete_id'");
	if ($delete_reply) {
		echo "yes";
	}
}
 ?>