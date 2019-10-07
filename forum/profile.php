<?php include 'inc/header2.php'; ?>
<?php 
  $username = urldecode($_GET['user_id']);
  if (empty($username)) {
  header("location: ../forum");
  exit();
  }

  $getuserdetails =  mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");
  $row = mysqli_fetch_array($getuserdetails);
  $name = $row['name'];
  $bio = $row['bio'];
  $gender = $row['gender'];
  $profile_id = $row['profile_id'];
  $user_img_path = '../../admin/uploads/'. $row['user_img_path'];
  $website = $row['website'];
  $date = date('jS F, Y', $row['register_date']);
  $gender = $row['gender'];

 ?>

  <!-- EventBlock -->
  <div class="container eventblock">
    <div class="section-padding"></div>
    <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class="eventcourse-categories">
          <div class="section-header">
            <h3>Profile <span>Details</span></h3>
          </div>
          <div  style="margin-top: 10px; width: 80%; margin:0 auto;text-align: center;">
            <img src="<?php if (is_null($row['user_img_path'])) {
                echo "../../images/3.jpg";
              }else{echo(ucwords($user_img_path));}?>" class="responsive-img" width="100" height="30">
          
            <div class="">
              <p>Name: <?php echo(ucwords($name))?></p>
            </div>
            <div class="">
              <p>Gender: <?php if (is_null($gender)) {
                echo "Not provided";
              }else{echo(ucwords($gender));}?></p>
            </div>
            <div class="">
              <p>Website: <?php if (is_null($website)) {
                echo "Not provided";
              }else{echo(ucwords($website));}?></p>
            </div>
            <div class="">
              <p>Date Registered: <?php echo($date)?></p>
            </div>
            <div class="">
              <p>
                <p class="center blue darken-2 white-text">Signature</p>
                <?php if (is_null($bio)) {
                echo "Not provided";
              }else{echo(ucwords($bio));}?>
              </p>
            </div>
          </div>
          
    </div>
      </div>
      <div class="col-md-7 col-sm-12">
        <div class="section-header">
          <h3>User's <span>Posts</span></h3>
        </div>
              <?php 
        $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_by = users.profile_id AND forum_topic.topic_by = '$profile_id' ORDER BY topic_date DESC LIMIT 3 ");
          if (mysqli_num_rows($fetchallposts)) {
            while ($row = mysqli_fetch_array($fetchallposts)) {
            $title =$row['topic_title'];
            $formattedtitle = $row['formatted_url'];
            $username = $row['username'];
            $forum_topic_id = $row['forum_topic_id'];
            $category_id = $row['topic_cat_id'];
            $num_views = $row['num_views'];
            $last_reply = $row['last_reply'];
            $fetch_last_reply = mysqli_fetch_array(mysqli_query($conn,"SELECT username from users where profile_id = '$last_reply'"));
            $last_reply_name = $fetch_last_reply['username'];
            $fetchcatname = mysqli_fetch_array(mysqli_query($conn,"SELECT forum_cat_name from forum_categories where forum_cat_id = '$category_id'"));
            $catname = $fetchcatname['forum_cat_name'];
            $formatedcatname = str_replace(" ","-", $catname);
            $date = date('jS F, Y', $row['topic_date']);
       ?>

        <div class="event-section event2-section">
          <div class="event-block">
            <div class="event-box"> 
              <div class="eventcontent-box">
                <h3><a href="../forum-thread/<?php echo $formattedtitle; ?>"><?php echo $title; ?></a></h3>
                <div class="event-meta">
                  <span>Cat: <a href="../category/<?php echo $formatedcatname; ?>"><?php echo $catname; ?></a></span>
                  <span><i aria-hidden="true" class="fa fa-clock-o"></i><?php echo $date; ?></span>
                  <span>Last Reply: <i aria-hidden="true"></i><a href="../users/<?php echo($last_reply_name) ?>"> <?php echo $last_reply_name; ?></a></span>
                  <span>By:<i aria-hidden="true" class="fa fa-user"></i><a href="../users/<?php echo($username) ?>"> <?php echo $last_reply_name; ?></a></span>
                </div>
              </div>
             
            </div>
          </div>
        </div>
         <?php 
          }
          echo '      </div>';
          }else{
            echo 'No posts created yet on the forum yet';
          }
          ?>

    </div>
    <div class="section-padding"></div>
  </div><!-- EventBlock /- -->
</div>

<?php include 'inc/footer.php'; ?>