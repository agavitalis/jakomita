<?php 
$getthis = urldecode($_GET['cat_id']);
 ?>
<?php 
@$page_num = $_GET['next_page'];
if ($page_num == '') {
 include 'inc/header2.php';
}else{
  include 'inc/header3.php';
  $next_page = ($page_num *10) - 10;
}
 ?>
 <?php 
        $getCategory = $_GET['cat_id'];
        $realCatName =  str_replace("-"," ", $getCategory);
        $fetchcatid = mysqli_fetch_array(mysqli_query($conn,"SELECT * from forum_categories where forum_cat_name = '$realCatName'"));
        $forum_id = $fetchcatid['forum_cat_id'];
        $forum_cat_description = $fetchcatid['forum_cat_description'];
          
        ?>
 
	<!-- PageBanner -->
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3><?php echo(ucwords($getCategory)); ?></h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li><?php echo($getCategory); ?></li>
				</ol>
			</div>
		</div>
	</div><!-- PageBanner /- -->
	<!-- Event Section -->
	<nav class="ow-pagination post-viewall">
			<ul class="pagination">
				 <?php if (isset($user_username)) {
      ?>
    	
           <a href="<?php if($page_num == "" ){echo('../post/'.$getCategory);}else{echo('../../post/'.$getCategory);} ?>" class="white-text">Create New Thread</a>
      <?php } else{?>
       <a href="<?php if($page_num == "" ){echo('../../signin');}else{echo('../../../signin');} ?>" class="white-text">Login to create new thread</a>
    <?php }?>
			</ul>
		</nav>
	   
	<div class="container event-section">
		<div class="section-padding"></div>			
		<div class="event-block">
			<?php 
      $fetchallpostsforpagination = mysqli_num_rows(mysqli_query($conn,"SELECT * from forum_topic WHERE forum_topic.topic_cat_id = '$forum_id'"));
       if ($page_num == '' || $page_num ==1) {
           $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_cat_id = '$forum_id' AND forum_topic.topic_by = users.profile_id ORDER BY topic_date DESC LIMIT 10");
          }else{
            $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_cat_id = '$forum_id' AND forum_topic.topic_by = users.profile_id ORDER BY topic_date DESC LIMIT 10 OFFSET $next_page");
          }
          $numberofposts = 10;
          $pagination = ceil($fetchallpostsforpagination/$numberofposts);
          $countnumberofposts = mysqli_num_rows($fetchallposts);
        if ($countnumberofposts <= 0) {
          echo 'No posts in this category yet. Click on Create Thread to be the first person to make a post on this forum';
        }
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
					<!-- <div class="col-md-3 col-sm-4 col-xs-5">
						<img src="../../images/event1.jpg" alt="event1" width="260" height="160"/>
					</div> -->
					<div class="col-md-7 col-sm-12 col-xs-12">
						<h3><a href="<?php if($page_num == "" ){echo('../forum-thread/'.$formattedtitle);}else{echo('../../forum-thread/'.$formattedtitle);} ?>"><?php echo($title); ?></a></h3>
						<div class="event-meta">
							<span>Catergory: <a href="<?php if($page_num == "" ){echo('../category/'.$getCategory);}else{echo('../../category/'.$getCategory);} ?>"><?php echo $catname; ?></a></span>
							<span><i aria-hidden="true" class="fa fa-user"></i>By: <a href="<?php if($page_num == "" ){echo('../users/'.$username);}else{echo('../../users/'.$username);} ?>"><?php echo $username; ?></a></span>
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
		<nav class="ow-pagination post-viewall">
			<ul class="pagination">
				 <?php if (isset($user_username)) {
      ?>
    	
           <a href="<?php if($page_num == "" ){echo('../post/'.$getCategory);}else{echo('../../post/'.$getCategory);} ?>" class="white-text">Create New Thread</a>
      <?php } else{?>
       <a href="<?php if($page_num == "" ){echo('../../signin');}else{echo('../../../signin');} ?>" class="white-text">Login to create new thread</a>
    <?php }?>
			</ul>
		</nav>
		<nav class="ow-pagination">
			<ul class="pagination">
			<?php 
            for ($i=0; $i < $pagination ; $i++) {
             if ($page_num == '' || $page_num ===1) {
               echo(' <li class="waves-effect blue darken-2"><a href="'.$getthis.'/'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }else{
                echo(' <li class="waves-effect blue darken-2"><a href="../'.$getthis.'/'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }
            }
           ?>
			</ul>
		</nav>
		<div class="section-padding"></div>
	</div><!-- Event Section /- -->	
<?php include 'inc/footer.php' ?>