<?php 
  $admin_username = $_SESSION['admin_username'];
$conn = mysqli_connect("localhost","root","","jakomita");
  $checkuser_role = mysqli_query($conn,"SELECT * from users where `username` = '$admin_username' ");
  $row = mysqli_fetch_array($checkuser_role);
  $bio = $row['bio'];
  $website = $row['website'];
  $email = $row['email'];
  $school = $row['school'];
  $phone = $row['phone'];
  $img_path = $row['user_img_path'];
  $gender = $row['gender'];
  $name = $row['name'];
  $user_level = $row['user_level'];
  if ($user_level == 1) {
    $user_role = "Materials admin";
  }
  if ($user_level == 2) {
    $user_role = "Forum admin";
  }
  if ($user_level == 3) {
    $user_role = "Blog admin";
  }
  if ($user_level == 4) {
    $user_role = "Check Course admin";
  }
  if ($user_level == 5) {
    $user_role = "CBT admin";
  }
  if ($user_level == 6) {
    $user_role = "General admin";
  }
  $user_id =  $row['profile_id'];
 ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Jakomita</title>
    <link href="css/materialicons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../js/jquery.js"></script>
    <link href="css/materialize.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
    <script src="js/materialize.min.js"></script>
</head>
<body>
<ul id="slide-out" class="side-nav fixed" style="padding-top: 60px;">
  <li class="bold center brown white-text">Welcome <?php echo ucwords($admin_username)." (".$user_role.")";?></li>
  <li class="bold"><a href="dashboard" class=" mdi mdi-home mdi-24px collapsible-header borderbottom"> &nbsp; Dashboard</a></li>
  <?php if (($user_level == 1) || ($user_level > 5)){
    echo '<li>
    <ul class="collapsible collapsible-accordion">
      <li class="bold">
        <a class=" collapsible-header borderbottom"><i class="mdi mdi-chevron-down right "></i>Materials<i class="mdi mdi-comment-question-outline"></i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class=" borderbottom" href="view-materials">View Materials</a></li>
            <li><a class=" borderbottom" href="add-material">Add New Material</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>';
}
  if (($user_level == 2)|| ($user_level > 5)) {
    echo '<li>
    <ul class="collapsible collapsible-accordion">
      <li class="bold">
        <a class=" collapsible-header borderbottom"><i class="mdi mdi-chevron-down right "></i>Forum <i class="mdi mdi-forum "></i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class=" borderbottom" href="view-posts">View Posts</a></li>
            <li><a class=" borderbottom" href="add-post">Add New Post</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>';
  }
  if (($user_level == 3)|| ($user_level > 5)) {
    echo '<li>
    <ul class="collapsible collapsible-accordion">
      <li class="bold">
        <a class=" collapsible-header borderbottom"><i class="mdi mdi-chevron-down right "></i>Blog<i class="mdi mdi-responsive "></i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class=" borderbottom" href="view-blog-posts">View Posts</a></li>
            <li><a class=" borderbottom" href="add-blog-post">Add New Post</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>';
  }
  if (($user_level == 4)|| ($user_level > 5)) {
    echo '<li>
    <ul class="collapsible collapsible-accordion">
      <li class="bold">
        <a class=" collapsible-header borderbottom"><i class="mdi mdi-chevron-down right "></i>Check Course<i class="mdi mdi-book-open-page-variant"></i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class=" borderbottom" href="view-courses">View Courses</a></li>
            <li><a class=" borderbottom" href="add-course">Add New Course</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>';
  }
  if (($user_level == 5) || ($user_level > 5)) {
    echo '<li>
    <ul class="collapsible collapsible-accordion">
      <li class="bold">
        <a class=" collapsible-header borderbottom"><i class="mdi mdi-chevron-down right "></i>CBT <i class="mdi mdi-certificate"></i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class=" borderbottom" href="view-requests">View CBT Requests</a></li>
            <li><a class=" borderbottom" href="add-exam">Add New Exam</a></li>
            <li><a class=" borderbottom" href="view-exams">View Exams</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>';
  }
  if ($user_level > 5) {
    echo '<li>
    <ul class="collapsible collapsible-accordion">
      <li class="bold">
        <a class=" collapsible-header borderbottom"><i class="mdi mdi-chevron-down right "></i>Users <i class="mdi mdi-account-multiple"></i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class=" borderbottom" href="view-users">View Users</a></li>
            <li><a class=" borderbottom" href="register-user">Register New User</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>';
  }
?>
  <li class="bold"><a href="profile" class=" mdi mdi-account mdi-24px collapsible-header borderbottom"> &nbsp; Edit Profile</a></li>
  <li class="bold"><a href="logout" class=" mdi mdi-power mdi-24px collapsible-header borderbottom"> &nbsp; Logout</a></li>
</ul>
<header>
  <div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper header brown">
      <a href="." class="brand-logo marginner">Jakomita</a>
      <a href="#" data-activates="slide-out" class="button-collapse top-nav full hide-on-large-only"><i class="mdi mdi-menu"></i></a>
    </div>
  </nav>
</div>
</header>