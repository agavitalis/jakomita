<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>

<main>
<h5 class="center">Profile Update</h5>
     <form class="signin" id="profile">
      <div class="row">
        <div class="col s12">
          <div class="col hide-on-small-only m2 l2"></div>
      <div class="col s12 m8 l8 checkinput center-align">
        <img src="<?php if(!is_null($img_path)){echo "uploads/".$img_path;}else{echo "../images/3.PNG";} ?>" class="responsive-img" id="photo">
      </div>
        <div class="col hide-on-small-only m2 l2"></div>
        </div>
       <div class="input-field col s12">
      <input placeholder="Full Name" type="text" required name="fullname" value="<?php if(!(is_null($name))){echo $name;}else{echo"Enter your full name";}?>">
    </div>
    <div class="input-field col s12 checkinput m12 l6">
      <select name="school">
        <option value="<?php echo($school) ?>" selected><?php echo($school) ?></option>
        <?php 
          $findallschools= mysqli_query($conn,"SELECT * FROM universities where 1");
          while ($row = mysqli_fetch_array($findallschools)) {
            $uniname = $row['university_name'];
            echo "<option value='".$uniname."'>".$uniname."</option>";
          }
         ?>
      </select>
    </div>
    <div class="input-field col s12 checkinput m12 l6">
     <input placeholder="Email" type="text" required name="email" value="<?php if(!(is_null($email))){echo $email;}else{echo"Enter your Email";}?>" id="email">
     <span id="emailerror"></span>
    </div>
    <div class="input-field col s12 checkinput m12 l6">
     <input placeholder="Website" type="text" required name="website" value="<?php if(!(is_null($website))){echo $website;}else{echo"";}?>">
    </div>
    <div class="input-field col s12 checkinput m12 l6">
      <input placeholder="Phone" type="text" required name="phone" value="<?php if(!(is_null($phone))){echo $phone;}else{echo"";}?>">
    </div>
    <div class="input-field col s12 checkinput">
      <select name="gender">
        <option value="<?php if(!(is_null($gender))){echo $gender;}else{echo"NULL";}?>"><?php if(!(is_null($gender))){echo $gender;}else{echo"Select Gender";}?></option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="input-field file-field col s12 checkinput m12 l12">
      <div class="btn brown checkinput">
        <span class="mdi mdi-upload" for="profile_pix">Change Profile Picture</span>
        <input type="file" name="profile_pix" id="profile_pix" onchange="upload()">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field col s12 checkinput m12 l12" style="margin-bottom: 50px">
      <textarea id="textarea" class="materialize-textarea" placeholder="User Bio" name="bio"><?php if(!(is_null($bio))){echo $bio;}else{echo"Describe yourself";}?></textarea>
    </div>
      <div class="center-align s12 m12 l12">
        <div id="error"></div>
        <button type="submit" class="brown btn">Update</button>
      </div>
    </div>
    </form>
</main>
<script src="js/update_profile.js"></script>
<?php include 'inc/footer.php'; ?>