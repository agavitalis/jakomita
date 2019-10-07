<?php session_start();
  $user_username = @$_SESSION['user_username'];
$a = @$_SERVER['HTTP_REFERER'];
if (isset($user_username)) {
  echo "You are already logged In! Redirecting....";
  if (isset($a)) {
    echo "<script>
      window.location = '$a';
    </script>";
  }
}
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Jakomita |Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		.signin {

			border: 2px solid #eee;
			padding: 3em;
			margin-top: 2em;
		}

		.login-img {
			margin: auto;
			margin-top: 4em;

		}

		.btn-l {
			background-color: #1976D2;
			border-color: #1976D2;
			color: #fff;
		}
	</style>
</head>

<body>

	<div class="row">
		<!-- Current avatar -->
		<div class="col col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive login-img " src="images/logo2.png" alt="Jakomita Logo" title="Logo">
		</div>
	</div>
	<div class="container row">
		<div class="col col-md-6 col-md-offset-4">
			<form class="signin">
				<div class="form-group">
					<input class="form-control" placeholder="Username" type="text" name="username" required id="username">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="password" type="password" name="passkey" required id="password">
				</div>
				<div class="center" id="available"></div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4 col-sm-d-none"></div>
						<div class="col-md-4 col-sm-12">
							<input class="btn btn-block btn-l btn-flat" type="submit" id="submit" value="LOG IN">
						</div>
						<div class="col-dm-4 col-sm-d-none"></div>
					</div>
					<div style="margin-top: 10px">
						<a href="./">Home</a> |Not yet a member? Sign Up
						<a href="signup">Here</a>
					</div>
				</div>

			</form>

		</div>
	</div>


	<script src="js/tether.min.js"></script>
	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		function redirectme() {
			window.location = "<?php if (!isset($a)) {
			echo("./");
		} else {
			echo("./");
		} ?> ";
		}
	</script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/login.js"></script>

</body>

</html>