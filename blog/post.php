<?php include 'inc/header2.php' ?>
<?php 
$getpostname = urldecode($_GET['post_name']);
$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 
if (empty($getpostname)) {
  header("location: ../blog");
  exit();
}

$getpostdetails = mysqli_query($conn,"SELECT blog_post.*, blog_categories.*, users.* FROM blog_post INNER JOIN blog_categories, users WHERE blog_post.formatted_url = '$getpostname' AND blog_post.topic_cat_id = blog_categories.blog_category_id AND blog_post.topic_by = users.profile_id ");
if (mysqli_num_rows($getpostdetails) == 1) {
  $row = mysqli_fetch_array($getpostdetails);
  $title = $row['topic_title'];
  $num_views = $row['num_views'];
  $increasenum_views = mysqli_query($conn,"UPDATE blog_post SET num_views = num_views+1 WHERE blog_post.formatted_url = '$getpostname'");
  $topic_id = $row['blog_topic_id'];
  $date = date('jS F, Y', $row['topic_date']);
  $categoryname = $row['blog_cat_name'];
  $formatedcatname = str_replace(" ","-", $categoryname);
  $writtenby = $row['name'];
  $bio = $row['bio'];
  $profile_id = $row['profile_id'];
  $user_img_path = '../../admin/uploads/'. $row['user_img_path'];
  $body = $row['topic_body'];
  $body = htmlspecialchars_decode($body);
  $pos = stripos($body, "../../uploads/");
             $str = substr($body, $pos);
             $str_two = substr($str, strlen("../../uploads/"));
             $second_pos = stripos($str_two, ".png");
             $str_three = substr($str_two,0,$second_pos);
             $unit = trim($str_three);
             if ($unit) {
               $img_path = '../../uploads/'.$unit.'.png';
             }
   $category_id = $row['topic_cat_id'];
            $num_views = $row['num_views'];
            $fetchcatname = mysqli_fetch_array(mysqli_query($conn,"SELECT blog_cat_name from blog_categories where blog_category_id = '$category_id'"));
            $catname = $fetchcatname['blog_cat_name'];
            $formatedcatname = str_replace(" ","-", $catname);
            $date = date('jS F, Y', $row['topic_date']);
}
?>
	<!-- PageBanner -->
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3><?php echo($title); ?></h3>
				<ol class="breadcrumb">
					<li><a href="../">Home</a></li>
					<li>Post</li>
				</ol>
			</div>
		</div>
	</div><!-- PageBanner /- -->
	<div class="container blog blogpost">
		<div class="section-padding"></div>
		<div class="row">
			<div class="col-md-9 col-sm-8 content-area">
				<article class="type-post">
					<div class="entry-cover">
						<img width="860" height="470" alt="blogpost" src="<?php echo($img_path); ?>">
					</div>
					<div class="entry-block">
						<div class="entry-contentblock">
							<div class="entry-meta">
								<span class="postby">By : <?php echo($writtenby); ?></span>
								<span class="postcatgory">Category : <a href="<?php echo($formatedcatname); ?>"> <?php echo($catname); ?></a></span>
								<span class="postdate">Date : <?php echo($date); ?></span>
							</div>
							<div class="entry-block">
								<div class="entry-title">
									<h3><?php echo($title); ?></h3>
								</div>
								<div class="entry-content">
									<p>
										<?php echo($body); ?>
									</p>
								</div>
							</div>
							<ul>
								<li><a title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a></li> 
								<li><a title="Behance" href="#"><i class="fa fa-behance"></i></a></li>
								<li><a title="Dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
							</ul>
						</div>
						<div class="post-ic"><span class="icon icon-Pencil"></span></div>
					</div>
				</article>
			</div>
			<div class="col-md-3 col-sm-4 widget-area">
				<aside class="widget widget_categories">
					<h3 class="widget-title">Categories</h3>
					<ul>
						<?php 
        $fetchcats = mysqli_query($conn,"SELECT * from blog_categories");
        while ($row = mysqli_fetch_array($fetchcats)) {
            $blog_cat_name =$row['blog_cat_name'];
            $formatedcatname = str_replace(" ", "-", $blog_cat_name);
            $blog_id = $row['blog_category_id'];
            $fetch_num_posts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM blog_post where topic_cat_id = '$blog_id'"));
  
       ?>
						<li><a href="../category/<?php echo($blog_cat_name); ?>"><?php echo(ucwords($formatedcatname)); ?></a><span><?php echo(ucwords($fetch_num_posts)); ?></span></li>
						<?php 
        }
       ?>
					</ul>
				</aside>
				<aside class="widget widget_latestnews">
					<h3 class="widget-title">Popular Posts</h3>
					<?php 
        $fetchallposts = mysqli_query($conn,"SELECT blog_post.*, users.* from blog_post INNER JOIN users WHERE blog_post.topic_by = users.profile_id ORDER BY num_views DESC LIMIT 3 ");
          if (mysqli_num_rows($fetchallposts)) {
            while ($row = mysqli_fetch_array($fetchallposts)) {
            $title =$row['topic_title'];
            $formattedtitle = $row['formatted_url'];
            $username = $row['username'];
            $category_id = $row['topic_cat_id'];
            $num_views = $row['num_views'];
            $date = date('jS F, Y', $row['topic_date']);
       ?>
					<div class="latestnews-box">
						<a href="../post/<?php echo($formattedtitle); ?>" title="<?php echo($title); ?>"><?php echo($title); ?></a>
						<span>post:<?php echo($date); ?></span>
					</div>
					<?php 
          }
          }else{
            echo '<li class="collection-item changefont">No posts created yet on the forum yet</li>';
          }
          ?>
				</aside>
			</div>
		</div>
		<div class="section-padding"></div>
	</div>
	<?php include 'inc/footer2.php'; ?>