<?php include 'inc/header.php' ?>
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3>Forum</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>Forum</li>
				</ol>
			</div>
		</div>
	</div><!-- PageBanner /- -->
	<!-- EventBlock -->
	<div class="container eventblock">
		<div class="section-padding"></div>
		<div class="row">
			<div class="col-md-5 col-sm-12">
				<div class="eventcourse-categories">
					<div class="section-header">
						<h3>Forum <span>Categories</span></h3>
						<p>Enter our forum for the best of discussions</p>
					
					</div>
					<?php 
        $fetchcats = mysqli_query($conn,"SELECT * from forum_categories");
        while ($row = mysqli_fetch_array($fetchcats)) {
            $forum_cat_name =$row['forum_cat_name'];
            $formatedcatname = str_replace(" ", "-", $forum_cat_name);
            $forum_cat_description = $row['forum_cat_description'];
  
       ?>
			<h3><a href="category/<?php echo $formatedcatname; ?>"><?php echo(ucwords($forum_cat_name)) ?> Forum</a></h3>
			<p><?php echo "$forum_cat_description"; ?></p><hr>
			<?php 
	        }
	       ?>
		</div>
			</div>
			<div class="col-md-7 col-sm-12">
				<div class="section-header">
					<h3>Recent <span>Posts</span></h3>
				</div>
				      <?php 
        $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_by = users.profile_id ORDER BY topic_date DESC LIMIT 6 ");
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
								<h3><a href="forum-thread/<?php echo $formattedtitle; ?>"><?php echo $title; ?></a></h3>
								<div class="event-meta">
									<span>Cat: <a href="category/<?php echo $formatedcatname; ?>"><?php echo $catname; ?></a></span>
									<span><i aria-hidden="true" class="fa fa-clock-o"></i><?php echo $date; ?></span>
									<span>Last Reply: <i aria-hidden="true"></i><a href="users/<?php echo($last_reply_name) ?>"> <?php echo $last_reply_name; ?></a></span>
									<span>By:<i aria-hidden="true" class="fa fa-user"></i><a href="users/<?php echo($username) ?>"> <?php echo $username; ?></a></span>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				 <?php 
          }
          echo '
          <div class="post-viewall">
				<a href="latest/1"  title="View All post">View All post</a>
			</div>
			</div>';
          }else{
            echo 'No posts created yet on the forum yet';
          }
          ?>

		</div>
		<div class="section-padding"></div>
	</div><!-- EventBlock /- -->

<?php include 'inc/footer.php' ?>