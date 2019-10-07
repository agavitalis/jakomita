
<?php include 'inc/header2.php'; 
$category_id = urldecode($_GET['cat_id']);
?>
<?php
if (empty($user_username)) {
 header('Location:../');
}
 ?>
  <div class="container blog blogpost">
    <div class="section-padding"></div>
    <div class="row">
      <div class="col-md-9 col-sm-8 content-area">
        <article class="type-post">
<form id="forum_post" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
        <input class="form-control" type="text" name="title" placeholder="Post Title" maxlength="100">
          
        </div>
        <input type="hidden" name="cat_id" value="<?php echo($category_id) ?>">
       <textarea id="editor" name="body" maxlength="2000">
       </textarea>
       <div style="margin-top: 12px;">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
        <input type="file" style="margin-bottom: 5px;float:left;width:50%" name="image[]">
      </div>
    <div class="center" id="error"></div>
    <ul class="center-align" style="margin-top: 12px;">
    <input class="btn btn-block btn-outline-success" type="submit" id="submit" value="Post">
        </ul>
      </form>
        </article>
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
            <li><a href="../category/<?php echo $formatedcatname; ?>"><?php echo(ucwords($forum_cat_name)) ?> Forum</a><span><?php echo($countnumposts); ?></span></li>
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
            <a href="../forum-thread/<?php echo $formattedtitle; ?>"><?php echo $title; ?></a>
            <span><?php echo($date); ?></span>
          </div>
          <?php }} ?>
        </aside>
      </div>
    </div>
    <div class="section-padding"></div>
  </div>
<script src="../../ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');
  
</script>
<script src="../../js/jquery.js"></script>
<script src="../../js/forum_post.js"></script>
<?php include 'inc/footer.php'; ?>
