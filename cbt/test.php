<?php include 'inc/header.php'; ?>
  <script src="../js/jquery.js"></script>

<?php
if (!isset($_SESSION['user_username'])) {
  echo "<script>
      window.location = './';
    </script>";
}
$cat_name = (urldecode($_GET['cat']));
$username = $_SESSION['user_username'];
$subject = urldecode($_GET['subject']);
$mode = urldecode($_GET['mode']);
$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
 
 ?>

<body onload="fetchquestions()">
    <!-- PageBanner -->
  <div class="container-fluid no-padding pagebanner">
    <div class="container">
      <div class="pagebanner-content">
        <h3>You Are Writing <?php echo ucwords($cat_name). ", ".ucwords($subject) ;?> Exam</h3>
        <ol class="breadcrumb">
          <li id="timer" style="color: black; font-weight: 700;background:rgba(255,255,255,0.9);font-size: 20px"></li><br><br>

          <?php if ($mode !='game') {
            
           ?>
            <li style="display: block;"><input style="margin-bottom:20px" onclick="submit()" class="next nextbutton" value="SUBMIT TEST" readonly><br></li>
           <?php } ?>
        </ol>
      </div>
    </div>
  </div><!-- PageBanner /- -->
    <!-- Event Section -->
  <div class="container event-section">
    <div class="event-block"  id="question">
      
    </div>
  </div><!-- Event Section /- --> 
          <div id="letsgame"></div>

<nav class="ow-pagination">
  <ul class="pagination">
    <?php if ($mode !='game') {?>
      <li style="display: block;"><input style="margin-bottom:20px" onclick="submit()" class="next nextbutton" value="SUBMIT TEST" readonly><br></li>
    <?php } ?>
  </ul>
</nav>

 <div id="error"></div>
 <div id="result"></div>

<script type="text/javascript">
 	$(document).ready(function(){
 		$(".button-collapse").sideNav();
 	})
</script>
<script type="text/javascript">
function next(x){
 var next =  parseInt(x);
 var next = (next + 5);
 $.post('fetch_question.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>",question_no:next},function (data) {
    $("#question").html(data);
  });
 }

function gamemarker(x){
  $.post('gamespage.php',{selected_question_id:x,gamemode:1},function (data) {
      if (data == 'ok') {
        $("#showanswer" + x).attr('class','btn btn-success');
        $("#more" + x).attr('style','display:inline');
        $("#showanswer" + x).attr('disabled','true');
        $("#showanswer" + x).text("CORRECT!");
        
      }else{
         $("#showanswer" + x).attr('class','btn btn-danger');
        $("#why" + x).attr('style','display:inline');
        $("#showanswer" + x).attr('disabled','true');
         $("#showanswer" + x).text("WRONG!");
      }
  });
}

function previous(x){  
  var previous = (x - 5);
  $.post('fetch_question.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>",question_no:previous},function (data) {
    $("#question").html(data);
   });
}

function submit(){
  var yes = confirm("Are you sure you want to submit?");
  if (yes) {
    $.post('mark_test.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>"},function (data) {
      if (data == "yes") {
        location.href = "result";
      }
      });
  }
}

function updateanswer(answer,question_number) {
  $.post('fetch_question.php',{answer,question_number,updateanswer:1},function (data) {          
  });
}

  var c = <?php 
      $gettime = mysqli_query($conn,"SELECT * from cbt_current_time where sub_name = '$subject' AND category = '$cat_name' AND username = '$username'");
      if (mysqli_num_rows($gettime) != 1) {
        $getoriginal = mysqli_query($conn,"SELECT * from cbt_time where subject = '$subject' AND category = '$cat_name'");
        $getthis = mysqli_fetch_array($getoriginal);
        $firsttimer = $getthis['time_duration_minutes'];
        echo $firsttimer;
      }else{
        $row = mysqli_fetch_array($gettime);
        $timer = $row['time_written'];
        echo $timer;
      }
   ?>;
   var t;
   timecount();
   function timecount(){
    var hours =parseInt(c/3600) %24;
    var minutes = parseInt(c/60) % 60;
    var seconds = c%60;
    var result = (hours <10 ? "0" +hours + " Hour":hours+ " Hours")+': '+ (minutes <10 ? "0"+minutes+ " Minute" : minutes+ " Minutes") + ": " + (seconds <10 ?"0" +seconds+ " Second" :seconds+ " Seconds");
    $("#timer").html(result);

    //checks for the time
    if (c == 0) {
      $.post('mark_test.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>"},function (data) {
      if (data == "yes") {
        location.href = "result";
      }
      });
    }

    c = c -1;
     $.post('fetch_question.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>",updatetime:1,ctime:c},function (data) {
  });
    t = setTimeout(function(){
      timecount();
    },
    1000);
   }

function fetchquestions(){
  $.post('fetch_question.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>",question_no:0},function (data) {
  $("#question").html(data);
  });
}
$(".modal").modal();
$('.no').click(function(){
$('#modal1').modal('close');
})

$('.yes').click(function(){
  $('#modal1').modal('close');
  $.post('mark_test.php',{cat_name:"<?php echo($cat_name); ?>",subject:"<?php echo($subject); ?>",mode:"<?php echo($mode); ?>"},function (data) {
    if (data == "yes") {
      location.href = "result";
    }
    });
})

</script>

<?php include 'inc/footer.php'; ?>
