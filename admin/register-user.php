<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>
<main>
<form class="signin" id="register">
  <h5 class="center">Register User</h5>
  <div class="row center-align">
    <div class="input-field s12" >
      <input placeholder="Full Name" type="text" required name="fullname" id="fullname" maxlength="50">
    </div>
    <span id="fullnameerror"></span>
    <div class="input-field s12" >
      <input placeholder="Username" type="text" required name="username" id="username" maxlength="20">
    </div>
    <span id="usernameerror"></span>
    <div class="input-field s12" >
      <input placeholder="Email" type="email" required name="email" id="email" maxlength="50">
    </div>
    <span id="emailerror"></span>
    <div class="input-field s12">
      <input placeholder="Phone Number" type="number" required name="phone" id="phone" maxlength="20">
    </div>
    <select name="user_level">
    <option value="" disabled selected>Select User Level</option>
    <option value="1">Material Admin</option>
    <option value="2">Forum Admin</option>
    <option value="3">Blog Admin</option>
    <option value="4">Check Course admin</option>
    <option value="5">CBT admin</option>
    <option value="6">General admin</option>
  </select>
    <div class="input-field s12" >
      <input placeholder="Institution" type="text" required name="school" id="school" maxlength="50">
    <span id="institutionerror" style="top: 44px;left:0;position: absolute;"></span>
    </div>
    <div class="input-field s12" >
      <input placeholder="Password" type="password" required name="password" id="password" maxlength="20">
    </div>
    <div class="input-field s12" >
      <input placeholder="Confirm Password" type="password" required name="confirm_password" id="confirm_password" maxlength="20">
    </div>
    <span id="passworderror"></span>
    <div class="input-field s12" >
    <div class="center" id="error"></div>
     <input type="submit" name="submit" value="register" class="btn brown">
    </div>
  </div>
</form>
</main>
<script src="js/register.js"></script>
<?php include 'inc/footer.php'; ?>
