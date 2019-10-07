<?php 
@$page_num = $_GET['next_page'];
if ($page_num == '') {
 include 'inc/header2.php';
}else{
  include 'inc/header3.php';
  $next_page = ($page_num *5) - 5;
}
$a = 0;
 ?>

<?php 
$getpostname = urldecode($_GET['post_name']);
if (empty($getpostname)) {
  header("location: ../forum");
  exit();
}else{
	$getpostdetails = mysqli_query($conn,"SELECT * FROM forum_topic WHERE forum_topic.formatted_url = '$getpostname'");
	if (mysqli_num_rows($getpostdetails) < 1) {
		echo '<script>
			window.location.href= "../";
		</script>';
  		exit();
	}
}

$getpostdetails = mysqli_query($conn,"SELECT forum_topic.*, forum_categories.*, users.* FROM forum_topic INNER JOIN forum_categories, users WHERE forum_topic.formatted_url = '$getpostname' AND forum_topic.topic_cat_id = forum_categories.forum_cat_id AND forum_topic.topic_by = users.profile_id ");
if (mysqli_num_rows($getpostdetails) == 1) {
  $row = mysqli_fetch_array($getpostdetails);
  $title = $row['topic_title'];
  $num_views = $row['num_views'];
  $increasenum_views = mysqli_query($conn,"UPDATE forum_topic SET num_views = num_views+1 WHERE forum_topic.formatted_url = '$getpostname'");
  $topic_id = $row['forum_topic_id'];
  $date = date('jS F, Y', $row['topic_date']);
  $categoryname = $row['forum_cat_name'];
  $formatedcatname = str_replace(" ","-", $categoryname);
  $writtenby = $row['username'];
  $body = $row['topic_body'];
  $body = htmlspecialchars_decode($body);
  $getallreplies = mysqli_num_rows(mysqli_query($conn,"SELECT * from forum_replies where forum_topic_id = '$topic_id' order by reply_date"));
$numberofreplies = 5;
$pagination = ceil($getallreplies/$numberofreplies);
}
 ?>
	<!-- PageBanner -->
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3><?php echo($title); ?></h3>
				<ol class="breadcrumb">
					<li><a >Home</a></li>
					<li>Blog Details</li>
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
					</div>
					<div class="entry-block">
						<div class="entry-contentblock">
							<div class="entry-meta">
								<span class="postby">By : <a href="<?php if($page_num == "" ){echo('../users/'.$writtenby);}else{echo('../../users/'.$writtenby);} ?>"> <?php echo($writtenby); ?></a></span>
								<span class="postcatgory">Category : <?php if ($page_num == '') {
								            echo "<a href='../category/".$formatedcatname."'>".$categoryname."</a>";
								           }else{

								            echo "<a href='../../category/".$formatedcatname."'>".$categoryname."</a>";
								           } ?></span>
								<span class="postdate">Date : <?php echo($date); ?></span>
							</div>
							<div class="entry-block">
								<div class="entry-title">
									<h3><?php echo($title); ?></h3>
								</div>
								<div class="entry-content">
									<p>
										<?php 
								          $get_pictures = mysqli_query($conn,"SELECT * FROM forum_topic_attachment where forum_topic_id = '$topic_id'");
								          if (mysqli_num_rows($get_pictures) > 0) {
								            echo $body;
								            while ($row = mysqli_fetch_array($get_pictures) ) {
								            $image = "../../uploads/".$row['topic_file_attachment_name'];
								            if ($page_num == '') {
								              $image = "../../uploads/".$row['topic_file_attachment_name'];
								            }else{
								              $image = "../../../uploads/".$row['topic_file_attachment_name'];
								            }

								            echo "<div class='center-align' style='margin-bottom:10px'><img src=".$image."></div>";
								          }
								          }else{
								            echo($body)."<br>";
								          }
								          if ($writtenby == $user_username) {
								            if ($page_num == '') {
								            echo "<a href='../edit-post/".$topic_id."'>(Edit Post)</a> || <a style='cursor:pointer' id='".$topic_id."' class='deletepost'>(Delete Post)</a>";
								           }else{

								            echo "<a href='../../edit-post/".$topic_id."'>(Edit Post)</a> || <a style='cursor:pointer' id='".$topic_id."' class='deletepost'>(Delete Post)</a>";
								           }
								          }
								         ?>
								      </p>
								      <ul class="pagination center-align">
								            <!-- <li class="waves-effect variant" ><a href="#comment" class="white-text mdi mdi-reply">Post Reply</a></li> -->
								            <?php if (!empty($user_username)) {
								          echo '<li class="waves-effect variant" ><a href="#comment" class="white-text mdi mdi-reply">Post Reply</a></li>';
								        }
								        else{
								          if ($page_num == '' || $page_num===1) {
								            echo '<li class="waves-effect variant btn "><a class="white-text mdi mdi-account-alert checkfont" href="../../signin">Login to reply</a></li>';
								          }else{
								             echo '<li class="waves-effect variant btn "><a class="white-text mdi mdi-account-alert checkfont" href="../../../signin">Login to reply</a></li>';
								          }
								         
								      }
								         ?>
								        </ul>
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
					</div>
				</article>
				<div class="post-comments">
					    <?php 
						      if ($page_num == '' || $page_num ==1) {
						       $getreplies = mysqli_query($conn,"SELECT * from forum_replies where forum_topic_id = '$topic_id'  LIMIT 5");
						      }else{
						        $getreplies = mysqli_query($conn,"SELECT * from forum_replies where forum_topic_id = '$topic_id'  LIMIT 5 OFFSET $next_page");
						      }
						      if (mysqli_num_rows($getreplies) < 1) {
						        echo "<p>No replies to this post yet. Be the first to reply</p>";
						      }else{
						        while ($row = mysqli_fetch_array($getreplies)) {
						          $reply_content = $row['reply_content'];
						          $reply_id = $row['reply_id'];
						          $reply_date= date('jS F, Y', $row['reply_date']);
						          $reply_by = $row['forum_reply_user_id'];
						          $getreplyusername = mysqli_fetch_array(mysqli_query($conn,"SELECT username from users where profile_id = '$reply_by'"));

						          $replyusername = $getreplyusername['username'];
						      
						     ?>
					<div class="media">
						<div class="media-left">
							<a  href="<?php if($page_num == "" ){echo('../users/'.$replyusername);}else{echo('../../users/'.$replyusername);} ?>">
								<img width="112" height="112" class="media-object" alt="<?php echo ucwords($replyusername); ?>">
							</a>
						</div>
						<div class="media-body">
							<div class="media-content last">
								<h4 class="media-heading">
                  <span><?php echo $reply_date; ?></span>
								</h4>
								<p><?php 
        if (is_null($reply_content)) {
          $getimages = mysqli_query($conn,"SELECT * from forum_reply_attachment where forum_reply_id = '$reply_id' and forum_topic_id = '$topic_id'");
          while ($getrow = mysqli_fetch_array($getimages) ) {
            if ($page_num == '') {
              $image = "../../uploads/".$getrow['file_reply_img_path'];
            }else{
              $image = "../../../uploads/".$getrow['file_reply_img_path'];
            }
            echo "<div class='center-align' style='margin-bottom:10px'><img src=".$image."></div>";
          }
        }else{
          echo "<div>".$reply_content."</div>";
          $getimages = mysqli_query($conn,"SELECT * from forum_reply_attachment where forum_reply_id = '$reply_id' and forum_topic_id = '$topic_id'");
          if (mysqli_num_rows($getimages) > 0) {
            while ($getrow = mysqli_fetch_array($getimages) ) {
            if ($page_num == '') {
              $image = "../../uploads/".$getrow['file_reply_img_path'];
            }else{
              $image = "../../../uploads/".$getrow['file_reply_img_path'];
            }
            echo "<div class='center-align' style='margin-bottom:10px'><img src=".$image."></div>";
          }
          }

        }
       ?></p>
			<?php 
				        if ($replyusername == $user_username) {
           if ($page_num == '') {
            echo "<a class='deletereply' style='cursor:pointer' id='".$reply_id."'>(Delete Reply)</a>";
           }else{

            echo "<a class='deletereply' style='cursor:pointer' id='".$reply_id."'>(Delete Reply)</a>";
           }
          }
			 ?>
							</div>
						</div>
					</div>
					    <?php 
  }
}
     ?>
	</div>		
	<nav class="ow-pagination">
			<ul class="pagination">
          <!-- <li class="waves-effect blue darken-2" ><a href="#!" class="white-text"><i class="mdi mdi-chevron-left"></i></a></li> -->
          <?php 
            for ($i=0; $i < $pagination ; $i++) {
             if ($page_num == '' || $page_num ===1) {
               echo(' <li class="waves-effect blue darken-2"><a href="'.$getpostname.'/'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }else{
                echo(' <li class="waves-effect blue darken-2"><a href="../'.$getpostname.'/'.($i+1).'" class="white-text">'.($i+1).'</a></li>');
              }
              $a++;
            }
           ?><!-- 
          <li class="waves-effect blue darken-2"><a href="#!" class="white-text">1</a></li> -->
    <!--       <li class="waves-effect blue darken-2" ><a href="#!" class="white-text">2</a></li>
          <li class="waves-effect blue darken-2" ><a href="#!" class="white-text">3</a></li>
          <li class="waves-effect blue darken-2" ><a href="#!" class="white-text">4</a></li>
          <li class="waves-effect blue darken-2" ><a href="#!" class="white-text">5</a></li> -->
          <!-- <li class="waves-effect blue darken-2" ><a href="#!" class="white-text"><i class="mdi mdi-chevron-right"></i></a></li> -->
        </ul>
		</nav>
  <div class="col col-md-12">
  	<form id="comment" method="POST"  enctype="multipart/form-data" style="width: 70%;margin:0 auto">
    <h5 class="center-align">Post Reply Below</h5>
    <input type="hidden" name="topic_id" value="<?php echo($topic_id); ?>">
    <textarea id="editor" name="reply_body" maxlength="2000">
    </textarea>
      <div style="margin-top: 12px;">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
      </div>
    <div class="center" id="error"></div>
		<input class="btn btn-block btn-outline-success" type="submit" id="submit" value="Post Reply">
    </form>
  </div>		

			</div>
      <div class="col-md-3 col-sm-4 widget-area">
        <aside class="widget widget_categories">
          <h3 class="widget-title">Categories</h3>
          <ul>
            <?php 
        $fetchcats = mysqli_query($conn,"SELECT * from forum_categories");
        while ($row = mysqli_fetch_array($fetchcats)) {
            $forum_cat_name =$row['forum_cat_name'];
            $forum_cat_id =$row['forum_cat_id'];
            $formatedcatname = str_replace(" ", "-", $forum_cat_name);
            $countnumposts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM forum_topic WHERE topic_cat_id = '$forum_cat_id' "));
  
       ?>
            <li><a href="<?php if($page_num == ""){echo "../category/$formatedcatname";}else{echo "../../category/$formatedcatname";} ?>"><?php echo(ucwords($forum_cat_name)) ?> Forum</a><span><?php echo($countnumposts); ?></span></li>
            <?php } ?>
          </ul>
        </aside>
        <aside class="widget widget_latestnews">
          <h3 class="widget-title">Trending Topics</h3>
                        <?php 
        $fetchallposts = mysqli_query($conn,"SELECT forum_topic.*, users.* from forum_topic INNER JOIN users WHERE forum_topic.topic_by = users.profile_id ORDER BY num_views DESC LIMIT 3 ");
          if (mysqli_num_rows($fetchallposts)) {
            while ($row = mysqli_fetch_array($fetchallposts)) {
            $num_views = $row['num_views'];
            $title =$row['topic_title'];
            $formattedtitle = $row['formatted_url'];
            $date = date('jS F, Y', $row['topic_date']);
       ?>
          <div class="latestnews-box">
            <a href="<?php if($page_num == ""){echo "../forum-thread/$formattedtitle";}else{echo "../../forum-thread/$formattedtitle";} ?>"><?php echo $title; ?></a>
            <span><?php echo($date); ?></span>
          </div>
          <?php }} ?>
        </aside>
      </div>
		</div>
		<div class="section-padding"></div>
	</div>
<?php 
  if ($page_num == "") {
 echo '<script src="../../js/jquery.js"></script>';
 echo '<script src="../../ckeditor/ckeditor.js"></script>';
 // echo '<script src="../../js/forum_reply.js"></script>';
 echo"<script>$(document).ready(function () {

      
    var form = document.getElementById('comment');
    form.addEventListener('submit', function(e) {
    e.preventDefault();
    for (instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }
    var ajax = new XMLHttpRequest();
    ajax.open('POST', '../post_reply.php', true);
    ajax.onload = function(e) {
        if (ajax.responseText =='yes!') {
            
            window.location.reload();
        }else{

        $('#error').html(ajax.responseText);
          };
        }
        ajax.send(new FormData(form));
        
      },false);
      $('.deletereply').click(function(){
        reply_id = $(this).attr('id');
        $.post('../deleter.php',{reply_id:reply_id,reply:1},function (data) {
         if (data =='yes') {
            window.location.reload();
        }
      });
  })
   $('.deletepost').click(function(){
        delete_id = $(this).attr('id');
        $.post('../deleter.php',{delete_id:delete_id,delete:1},function (data) {
         if (data =='yes') {
            window.location.href = '../';
        }
      });
  })
})</script>";
}else{
 echo '<script src="../../../ckeditor/ckeditor.js"></script>';
 echo '<script src="../../../js/jquery.js"></script>';
 // echo '<script src="../../../js/forum_reply.js"></script>';
  echo"<script>$(document).ready(function () {

      
    var form = document.getElementById('comment');
    form.addEventListener('submit', function(e) {
    e.preventDefault();
    for (instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }
    var ajax = new XMLHttpRequest();
    ajax.open('POST', '../../post_reply.php', true);
    ajax.onload = function(e) {
        if (ajax.responseText =='yes!') {
            window.location.reload();            
        }else{

        $('#error').html(ajax.responseText);
          };
        }
        ajax.send(new FormData(form));
        
      },false);
      $('.deletereply').click(function(){
        reply_id = $(this).attr('id');
        $.post('../../deleter.php',{reply_id:reply_id,reply:1},function (data) {
         if (data =='yes') {
            window.location.reload();
        }
      });
  })
  $('.deletepost').click(function(){
        delete_id = $(this).attr('id');
        $.post('../../deleter.php',{delete_id:delete_id,delete:1},function (data) {
         if (data =='yes') {
            window.location.href = '../../';
        }
      });
  })
})</script>";

}
 ?><script>
  CKEDITOR.replace('editor');
  $('.editreply').click(function(){
    alert("coming soon");
  })
</script>
<!-- <script src="../../js/forum_reply.js"></script> -->
<?php include 'inc/footer.php'; ?>