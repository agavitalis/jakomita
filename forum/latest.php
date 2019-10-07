<?php include 'inc/header2.php'; 
@$page_num = $_GET['page_number'];
if ($page_num == '') {
}else{
  $next_page = ($page_num *10) - 10;
}
 $conn = mysqli_connect("localhost","root","","jakomita");

?>

	<!-- PageBanner -->
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3>More Posts</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>More Posts</li>
				</ol>
			</div>
		</div>
	</div><!-- PageBanner /- -->
	<!-- Event Section -->
	<div class="container event-section">
		<div class="section-padding"></div>			
		<div class="event-block">
			<?php 
      $fetchallpostsforpagination = mysqli_num_rows(mysqli_query($conn,"SELECT * from forum_topic"));
        if ($page_num == '' || $page_num ==1) {
           $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_by = users.profile_id ORDER BY topic_date DESC  LIMIT 10 OFFSET 6 ");
          }else{
            $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_by = users.profile_id ORDER BY topic_date DESC  LIMIT 10 OFFSET $next_page ");
          }
          $numberofposts = 10;
          $pagination = ceil($fetchallpostsforpagination/$numberofposts);
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
			<div class="event-box">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-5">
						<img src="../../images/event1.jpg" alt="event1" width="260" height="160"/>
					</div>
					<div class="col-md-7 col-sm-6 col-xs-7">
						<h3><a href="../forum-thread/<?php echo $formattedtitle; ?>"><?php echo($title); ?></a></h3>
						<div class="event-meta">
							<span>Catergory: <a href="../category/<?php echo $formatedcatname; ?>"><?php echo $catname; ?></a></span>
							<span><i aria-hidden="true" class="fa fa-user"></i>By: <a href="../users/<?php echo($username) ?>"><?php echo $username; ?></a></span>
						</div>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<a class="readmore" href="../forum-thread/<?php echo $formattedtitle; ?>">Read More</a>
					</div>
				</div>
			</div>
			 <?php 
          }
        ?>
		</div>
		<nav class="ow-pagination">
			<ul class="pagination">
				<?php 
            for ($i=0; $i < $pagination ; $i++) {
             if ($page_num == '' || $page_num ===1) {
               echo(' <li><a href="'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }else{
                echo(' <li><a href="'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }
            }
           ?>
			</ul>
		</nav>
		<div class="section-padding"></div>
	</div><!-- Event Section /- -->	
<?php include 'inc/footer.php' ?>