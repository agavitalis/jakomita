<?php 
	$get_trigger = $_POST['check_update'];
	if (isset($get_trigger)) {
      $getreplies = mysqli_query($conn,"SELECT * from forum_replies where forum_topic_id = '$topic_id' order by reply_date");
      if (mysqli_num_rows($getreplies) < 1) {
        echo "<li class='collection-item changefont'><p>No replies to this post yet. Be the first to reply</p></li>";
      }else{
        while ($row = mysqli_fetch_array($getreplies)) {
          $reply_content = $row['reply_content'];
          $reply_id = $row['reply_id'];
          $reply_date= date('jS F, Y', $row['reply_date']);
          $reply_by = $row['forum_reply_user_id'];
          $getreplyusername = mysqli_fetch_array(mysqli_query($conn,"SELECT username from users where profile_id = '$reply_by'"));

          $replyusername = $getreplyusername['username'];
      
     ?>
    <li class="collection-item changefont" id="reply_box">
      <div class="blue darken-2 white-text center-align" style="padding-left: 5px;padding-top: 5px;">
        <h6>Re: <?php echo (ucwords($title)); ?></h6>
        <small>By: <a href="../profile/<?php echo($replyusername) ?>" class="white-text"><?php echo $replyusername; ?></a></span> &nbsp; Date:&nbsp;<?php echo $reply_date; ?></span></small>
      </div>
      <p><?php 
        if (is_null($reply_content)) {
          $getimages = mysqli_query($conn,"SELECT * from forum_reply_attachment where forum_reply_id = '$reply_id' and forum_topic_id = '$topic_id'");
          while ($getrow = mysqli_fetch_array($getimages) ) {
            $image = "../../uploads/".$getrow['file_reply_img_path'];
            echo "<div class='center-align' style='margin-bottom:10px'><img src=".$image."></div>";
          }
        }else{
          echo $reply_content;
          $getimages = mysqli_query($conn,"SELECT * from forum_reply_attachment where forum_reply_id = '$reply_id' and forum_topic_id = '$topic_id'");
          if (mysqli_num_rows($getimages) > 0) {
            while ($getrow = mysqli_fetch_array($getimages) ) {
            $image = "../../uploads/".$getrow['file_reply_img_path'];
            echo "<div class='center-align' style='margin-bottom:10px'><img src=".$image."></div>";
          }
          }

        }
       ?></p>
    </li>
    <?php 
  }
}
    
	}
?>