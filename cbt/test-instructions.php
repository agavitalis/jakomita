<?php include 'inc/header.php'; ?>
<?php 
  $cat_name = urldecode($_GET['cat']);
  $subject = urldecode($_GET['subject']);
  $mode = urldecode($_GET['mode']);
  $getinstruction = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM  cbt_instruction WHERE cat_name = '$cat_name' AND sub_name = '$subject'"));
  $cbt_description = $getinstruction['cbt_description'];
  $exam_instruction = $getinstruction['exam_instruction'];
 ?>
  <div class="container coursesdetail-section">
    <div class="section-header">
      <hr>
      <h3>You are about to write<span> <?php echo ucwords($cat_name). " ".ucwords($subject) ;?></span>  Exam</h3>
    </div>
      <div class="row">
        <div class="col-md-9 col-sm-8 event-contentarea">
          <div class="coursesdetail-block">
            <!-- <img src="../images/event-coursesdetail.jpg" alt="event-coursesdetail" width="860" height="300"/> -->
            <div class="course-description">
              <h3 class="course-title">Courses Description</h3>
              <p><?php echo($cbt_description);?></p>
            </div>
        </div>
<div class="courses-sections-block">
  <h3>Exam <span>Instructions</span></h3>
  <div class="courses-lecture-box">
    <?php echo $exam_instruction; ?>
  </div>
</div>
<div class="post-viewall">
<div id="error" style="color: red"></div>
  <a href="test?cat=<?php echo $cat_name."&subject=".$subject."&mode=".$mode; ?>" class="btn btn-l" id="starttest">Start Test</a>
</div>
    </div>
        <div class="col-md-3 col-sm-4 event-sidebar">
          <div class="courses-features">
            <h3>Advert Space</h3>
          </div>
        </div>
      </div>
    <div class="section-padding"></div>
  </div>
<script src="../js/jquery.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#starttest").click(function(e){
      e.preventDefault();
      var href = $(this).attr('href');
      $.post('../check_login.php',{check_login:1},function (data) {
            if (data =='yes') {
              location.href = href;
            }else{
              $("#error").html(data);
            }
           });
    });
  })
 </script>

