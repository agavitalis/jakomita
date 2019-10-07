<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>
<main>
<form style="width: 80%; margin:0 auto">
  <h5 class="center">Add New Category</h5>
  <input type="text" name="category" placeholder="Add New Category" id="category">
  <div id="caterror" class="center-align"></div>
   <ul class="center-align" style="padding-bottom:3px; border-bottom: 1px solid #eee">
    <button type="submit" class="btn brown" id="addCat">Add Category</button>
 </ul>
</form>
<form style="width: 80%; margin:0 auto" method="post" id="blog_post" enctype="multipart/form-data">
  <h5 class="center">Add New Post</h5>
  <input type="text" name="title" placeholder="Post Title">
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
  <textarea id="editor" name="body"></textarea>
  <input type="hidden" name="add_post" value="1">
  <div class="btn brown center-align modal-trigger" style="margin-top: 12px;" data-target="modal1">Add Image</div>
  <!-- <input type="file" name="attachment[]" multiple> -->
  <div id="error" style="back"></div>
  <ul class="center-align" style="margin-top: 12px;">
    <button type="submit" class="btn brown" id="addpost">Post</button>
 </ul>
</form>
</main>
 <div class="modal" id="modal1">
  <div class="modal-content">
   <form id="inputImg">
    <label for="uploadImg" class="btn mdi mdi-upload brown">Upload</label>
     <input type="file" class="hide" id="uploadImg" multiple name="attachment[]">
   </form>
     <span id="twice"></span>
   </div>
   <div class="modal-footer">
    <a href="#!" class="modal-action modal-close btn brown">close</a>
   </div>

 </div>
<script src="inc/blog_post.js"></script>
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
  $("#addCat").click(function(e){
    e.preventDefault();
    category  = $("#category").val();
    if (category != "") {
      $.post('inc/blog_process.php',{add_cat:1,category:category},function (data) {
            $("#caterror").html(data);
           });
    }else{
       $("#caterror").html("Field cannot be empty");
    }
  })
   $(document).ready(function(){
    $(".modal").modal();
  document.getElementById('inputImg').addEventListener("change",function(){
      $("#twice").html("<div class='center-align green-text'><img src='805.gif'><br>Loading...</div>");
    var inputImg = document.getElementById('inputImg');
      var ajax = new XMLHttpRequest();
      ajax.open("POST", "inc/add_blog_pix.php", true);
      ajax.onload = function(e) {
      $("#twice").html(ajax.responseText);
          };
          ajax.send(new FormData(inputImg));
        
      },false);

$(document).on('click', '.selectpix', function(){
  var srcVal=$(this).attr('src');
  var adminVal = $(this).attr('datapath');
   // $("#editor").text("add this to it please na");
   editor= CKEDITOR.instances['editor'];
   if (editor) {
    editor.destroy(editor.destroy());
  
   }

      $('textarea#editor').val($('textarea#editor').val()+'<div><img width="300" height="300" src="'+srcVal+'"></div>'); 
   CKEDITOR.replace('editor');
});
  })
</script>