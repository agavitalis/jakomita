<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>

<main>
	<table class="responsive-table striped bordered" >
		<h5 class="center">All Blog Posts</h5>
 <thead>
	 <tr>
	 	<th>Title</th>
	 	<th>Body</th>
	 	<th>Posted By</th>
	 	<th>Category</th>
    <th>Edit Post</th>
	 	<th>Delete Post</th>
	 </tr>
 </thead>
 <tbody>
 <?php 
  $fetchallposts = mysqli_query($conn,"SELECT blog_post.*, users.* from blog_post INNER JOIN users WHERE blog_post.topic_by = users.profile_id ORDER BY topic_date DESC");
  while ($row = mysqli_fetch_array($fetchallposts)) {
    $title =substr( $row['topic_title'], 0,20).'...';
    $body = substr( $row['topic_body'], 0,20).'...';
    $username = $row['username'];
    $blog_post_id = $row['blog_topic_id'];
    $category_id = $row['topic_cat_id'];
    $fetchcatname = mysqli_fetch_array(mysqli_query($conn,"SELECT forum_cat_name from forum_categories where forum_cat_id = '$category_id'"));
    $catname = $fetchcatname['forum_cat_name'];

    ?>
  <tr>
    <td><?php echo $title; ?></td>
    <td><?php echo $body; ?></td>
    <td><?php echo $username; ?></td>
    <td><?php echo $catname; ?></td>
    <td><a href="#"><i id="<?php echo $blog_post_id; ?>" class="mdi mdi-24px brown-text mdi-grease-pencil edit"></i></a></td>
    <td><a href="#"><i id="<?php echo $blog_post_id; ?>" class="mdi mdi-24px brown-text mdi-delete-variant delete"></i></a></td>
  </tr>
   <?php 
    }
 ?>
   
 </tbody>
 </table>
 <ul class="pagination center-align">
          <li class="waves-effect brown" ><a href="#!" class="white-text"><i class="mdi mdi-chevron-left"></i></a></li>
          <li class="waves-effect brown"><a href="#!" class="white-text">1</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">2</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">3</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">4</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">5</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text"><i class="mdi mdi-chevron-right"></i></a></li>
        </ul>
</main>
<script type="text/javascript">
  $(".delete").click(function(){
    id = $(this).attr('id');
    var confirmdelete = confirm("Are you sure you want to delete this post?");
    if (confirmdelete) {
      alert("deleted");
    }
  });
  $(".edit").click(function(){
    id = $(this).attr('id');
    window.location.href = "edit_blog_post?topic="+id;
  });
</script>
<?php include 'inc/footer.php'; ?>
