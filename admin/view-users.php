<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>

<main>
	<table class="responsive-table striped bordered" >
		<h5 class="center">All Registered Users</h5>
 <thead>
	 <tr>
	 	<th>Fullname</th>
	 	<th>Username</th>
    <th>Phone</th>
	 	<th>School</th>
    <th>Delete</th>
	 	<th>Ban</th>
	 </tr>
 </thead>
 <tbody>
  <?php 
  $fetchallusers = mysqli_query($conn,"SELECT * from users ORDER BY register_date DESC");
  while ($row = mysqli_fetch_array($fetchallusers)) {
    if ($row['username'] != 'andyke') {
    $fullname = $row['name'];
    $user_profile_id = $row['profile_id'];
    $username = $row['username'];
    $phone = $row['phone'];
    $school =substr( $row['school'], 0,20).'...';?>
  <tr>
    <td contenteditable><?php echo $fullname; ?></td>
    <td contenteditable><?php echo $username; ?></td>
    <td contenteditable><?php echo $phone; ?></td>
    <td contenteditable><?php echo $school; ?></td>
    <td><i style="cursor: pointer" class="brown-text mdi mdi-24px mdi-delete-variant delete" id="<?php echo($user_profile_id) ?>"></i></td>
    <td><i style="cursor: pointer" class="brown-text mdi mdi-24px mdi-account-off ban" id="<?php echo($user_profile_id) ?>"></i></td>
  </tr>
   <?php 
  }
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
    var deleteuser = confirm("Are you sure you want to delete this user?");
    if (deleteuser) {
      alert("DELETED");
    }
  });
  $(".ban").click(function(){
    id = $(this).attr('id');
    var banuser = confirm("Are you sure you want to delete this user?");
    if (banuser) {
      alert("DELETED");
    }
  });
</script>
<?php include 'inc/footer.php'; ?>
