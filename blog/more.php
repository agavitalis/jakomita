<?php include 'inc/header2.php'; 
@$page_num = $_GET['page_number'];
if ($page_num == '') {
}else{
  $next_page = ($page_num *6) - 6;
}
$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 

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
	<div class="container blog">
		<div class="section-padding"></div>
		<div class="row">

			<div class="col-md-9 col-sm-8 content-area">
							 <?php 
    $fetchallpostsforpagination = mysqli_num_rows(mysqli_query($conn,"SELECT * from blog_post"));
    if ($fetchallpostsforpagination < 13) {
      $fetchallpostsforpagination = 0;
    }
    $numberofposts = 6;
    $pagination = ceil($fetchallpostsforpagination/$numberofposts);
        if ($page_num == '' || $page_num ==1) {
           $fetchallposts = mysqli_query($conn,"SELECT blog_post.*, users.* from blog_post INNER JOIN users WHERE blog_post.topic_by = users.profile_id ORDER BY topic_date DESC  LIMIT 10 OFFSET 6 ");
          }else{
            $fetchallposts = mysqli_query($conn,"SELECT blog_post.*, users.* from blog_post INNER JOIN users WHERE blog_post.topic_by = users.profile_id ORDER BY topic_date DESC  LIMIT 10 OFFSET $next_page ");
          }
        
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
              if ($page_num == '') {
               $img_path = '../../uploads/'.$unit.'.png';
               }else{
                $img_path = '../../../uploads/'.$unit.'.png';
               }
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
						<a title="Cover" href="<?php if($page_num == ''){echo "../post";}else{echo "../../post";} ?>/<?php echo($formattedtitle); ?>"><img width="860" height="470" alt="latestnews" src="<?php echo($img_path); ?>"></a>
					</div>
					<div class="entry-block">
						<div class="entry-contentblock">
							<div class="entry-meta">
								<span class="postby">By : <?php echo($username); ?></span>
								<span class="postcatgory">Category : <a href="<?php if($page_num == ''){echo '../category';}else{echo '../../category';} ?>/<?php echo($catname); ?>"><?php echo($catname); ?></a></span>
								<span class="postdate">Date : <?php echo($date); ?></span>
								<span class="postdate">No. Of views : <a href="#" title="25th May 2016"><?php echo($num_views); ?></a></span>
							</div>
							<div class="entry-block">
								<div class="entry-title">
									<a title="<?php echo $title; ?>" href="<?php if($page_num == ''){echo "../post";}else{echo "../../post";} ?>/<?php echo($formattedtitle); ?>"><h3><?php echo $title; ?></h3></a>
								</div>
								<div class="entry-content">
									<p><?php echo $snippet_body; ?></p>
								</div>
							</div>
							<a href="<?php if($page_num == ''){echo "../post";}else{echo "../../post";} ?>/<?php echo($formattedtitle); ?>" title="Read More">Read More</a>
						</div>
						<div class="post-ic"><span class="icon icon-Pencil"></span></div>
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
						<?php 
            for ($i=0; $i < $pagination ; $i++) {
             if ($page_num == '' || $page_num ===1) {
               echo(' <li><a href="./'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }else{
                echo(' <li><a href="../../'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }
            }
           ?>
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
						<li><a title="Language Science" href="<?php if($page_num == ''){echo '../category';}else{echo '../../category';} ?>/<?php echo($formatedcatname); ?>"><?php echo(ucwords($formatedcatname)); ?></a><span><?php echo(ucwords($fetch_num_posts)); ?></span></li>
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
						<a href="<?php if($page_num == ''){echo '../post';}else{echo '../../post';} ?>/<?php echo($formattedtitle); ?>" title="<?php echo($title); ?>"><?php echo($title); ?></a>
						<span>On:  <?php echo($date); ?></span>
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