<?php session_start();
include 'inc/functions.inc.php';
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
  if (!empty($_GET['topic'])) {
    $post_id = sanitize($_GET['topic']);
    $getpostdetails =  mysqli_query($link,"SELECT * FROM blog_post WHERE blog_topic_id = '$post_id'");
    if ($getpostdetails) {
      $row = mysqli_fetch_array($getpostdetails);
      $post_title = $row['topic_title'];
      $topic_body = $row['topic_body'];
    }
  }else{
    header('Location:view-posts');
  }
 ?>
<?php include 'inc/header.php'; 
?>

<main>
<form style="width: 80%; margin:0 auto" method="post" id="blog_post" enctype="multipart/form-data">
  <h5 class="center">Edit Post</h5>
  <input type="text" name="title" value="<?php echo($post_title) ?>" id="post_title">
  <select name="post_category" id="post_category">
    <option value="" disabled selected>Select Category</option>
    <?php 
      $selectcategory = mysqli_query($conn,"SELECT * FROM blog_categories ORDER BY blog_cat_name");
      while ($row = mysqli_fetch_array($selectcategory)) {
        $cat_id = $row['blog_category_id'];
        $cat_name =$row['blog_cat_name'];
        echo "<option value='".$cat_id."'>".ucwords ($cat_name)."</option>";
      }
     ?>
  </select>
  <textarea id="editor" name="body" ><?php echo($topic_body) ?></textarea>
  <input type="hidden" name="add_post" value="1">
  <input type="file" name="attachment[]" multiple>
  <div id="error" style="back"></div>
  <ul class="center-align" style="margin-top: 12px;">
    <button type="submit" class="btn brown" id="addpost">Post</button>
 </ul>
</form>
</main>
<script type="text/javascript">
  $("#addCat").click(function(e){
    e.preventDefault();
    category  = $("#category").val();
    category_description = $("#category_description").val();
    if ((category != "") && (category_description !="")) {
      $.post('inc/add_process.php',{add_cat:1,category:category,category_description:category_description},function (data) {
            $("#caterror").html(data);
           });
    }else{
       $("#caterror").html("Either fields cannot be empty");
    }
  })
</script>
<script src="inc/edit_blog.js"></script>
<?php include 'inc/footer.php'; ?>
