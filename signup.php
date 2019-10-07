<?php 
$a = @$_SERVER['HTTP_REFERER'];
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Jakomita|SignUp Page</title>
    <link href="css/shortcode.css" media="all" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   
</head>
<body>

 <div class="row">
			<!-- Current avatar -->
			<div class="col col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive login-img " src="images/logo2.png" alt="Jakomita Logo" title="Logo">
			</div>
  </div>
  <div class="container row">
			<div class="col col-md-8 col-md-offset-3">
					<h5 class="signup-text">Sign Up With Jakomita</h5>
          <form class="signin" id="register-form">
                <div class="form-group" >
                  <input class="form-control" placeholder="Full Name" type="text" required name="fullname" id="fullname" maxlength="50">
                </div>
                <span id="fullnameerror"></span>

                <div class="form-group" >
                  <input class="form-control" placeholder="Username" type="text" required name="username" id="username" maxlength="20">
                </div>
                <span id="usernameerror"></span>

                <div class="form-group" >
                  <input class="form-control" placeholder="Email" type="email" required name="email" id="email" maxlength="50">
                </div>
                <span id="emailerror"></span>
                
                <div class="form-group">
                  <input class="form-control" placeholder="Phone Number" type="number" required name="phone" id="phone" maxlength="20">
                </div>

                <div class="form-group" >
                  <input class="form-control" placeholder="Password" type="password" required name="password" id="password" maxlength="20">
                </div>

                <div class="form-group" >
                  <input class="form-control" placeholder="Confirm Password" type="password" required name="confirm_password" id="confirm_password" maxlength="20">
                </div>
              <span id="passworderror"></span>
              
              <div class="center" id="available"></div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-d-none"></div>
                  <div class="col-md-4 col-sm-12">
                   
                    <button class="btn btn-block btn-l btn-flat" type="submit" id="register" name="register">Register</button>
                  </div>
                  <div class="col-dm-4 col-sm-d-none"></div>
                </div>
                <div style="margin-top: 10px"><a href="./">Home</a> |Not yet a member? Sign In <a href="signin">Here</a></div>
              </div>

	        </form>
			
			</div>
</div>
</body>
<script type="text/javascript">
  function redirectme(){
    window.location = "<?php if (!isset($a)) {
      echo("./");
    }else{
      echo("./");
    } ?>";
  }
</script>
<script src="js/register.js"></script>
</html>