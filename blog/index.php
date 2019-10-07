<?php
@$page_num = $_GET['page_number'];
if ($page_num == '') {
}else{
  $next_page = ($page_num *10) - 10;
}
 $conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 

?>
<?php include 'inc/header.php' ?>
	<!-- PageBanner -->
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3>Blog</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>Blog</li>
				</ol>
			</div>
		</div>
	</div><!-- PageBanner /- -->
	<div class="container blog">
		<div class="section-padding"></div>
		<div class="row">

			<div class="col-md-9 col-sm-8 content-area">
							<?php 
        $fetchallposts = mysqli_query($conn,"SELECT blog_post.*, users.* from blog_post INNER JOIN users WHERE blog_post.topic_by = users.profile_id ORDER BY topic_date DESC LIMIT 6 ");
        if (mysqli_num_rows($fetchallposts)) {
            while ($row = mysqli_fetch_array($fetchallposts)) {
            $title =$row['topic_title'];
            $formattedtitle = $row['formatted_url'];
            $username = $row['username'];
            $topic_body = htmlspecialchars_decode($row['topic_body']);
            $pos = stripos($topic_body, "../../uploads/");
             $str = substr($topic_body, $pos);
             $str_two = substr($str, strlen("../../uploads/"));
             $second_pos = stripos($str_two, ".png");
             $str_three = substr($str_two,0,$second_pos);
             $unit = trim($str_three);
             if ($unit) {
               $img_path = '../uploads/'.$unit.'.png';
             }
             $snippet_body = substr($topic_body, 0,10);
            $blog_topic_id = $row['blog_topic_id'];
            
            $category_id = $row['topic_cat_id'];
            $num_views = $row['num_views'];
            $fetchcatname = mysqli_fetch_array(mysqli_query($conn,"SELECT blog_cat_name from blog_categories where blog_category_id = '$category_id'"));
            $catname = $fetchcatname['blog_cat_name'];
            $formatedcatname = str_replace(" ","-", $catname);
            $date = date('jS F, Y', $row['topic_date']);
       ?>
				<article class="type-post">
					<div class="entry-cover">
						<a title="Cover" href="post/<?php echo($formattedtitle); ?>"><img width="860" height="470" src="<?php echo($img_path); ?>"></a>
					</div>
					<div class="entry-block">
						<div class="entry-contentblock">
							<div class="entry-meta">
								<span class="postby">By : <?php echo($username); ?></span>
								<span class="postcatgory">Category : <a href="category/<?php echo($catname); ?>" ><?php echo($catname); ?></a></span>
								<span class="postdate">Date : <?php echo($date); ?></span>
								<span class="postdate">No. Of views : <a href="#"><?php echo($num_views); ?></a></span>
							</div>
							<div class="entry-block">
								<div class="entry-title">
									<a title="<?php echo $title; ?>" href="post/<?php echo($formattedtitle); ?>"><h3><?php echo $title; ?></h3></a>
								</div>
								<div class="entry-content">
									<p><?php echo $snippet_body; ?></p>
								</div>
							</div>
							<a href="post/<?php echo($formattedtitle); ?>">Read More</a>
						</div>
					</div>
				</article>
    <?php 
          }
          }else{
            echo '<li class="collection-item changefont center-align">No posts created on the blog yet</li>';
          }
          ?>
				<nav class="ow-pagination">
					<ul class="pagination">
						<li><a href="more/1">Load More</a></li>
					</ul>
				</nav>
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
						<li><a  href="category/<?php echo($blog_cat_name); ?>"><?php echo(ucwords($formatedcatname)); ?></a><span><?php echo(ucwords($fetch_num_posts)); ?></span></li>
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
						<a href="post/<?php echo($formattedtitle); ?>" title="<?php echo($title); ?>"><?php echo($title); ?></a>
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
<?php include 'inc/footer.php' ?>