<?php session_start();
  $user_username = @$_SESSION['user_username'];
$conn = mysqli_connect("localhost","root","","jakomita");
  
 ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class=""><!--<![endif]-->
<head>
	<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Jakomita|Home Page</title>
	<!-- Standard Favicon -->
	<link rel="icon" type="image/x-icon" href="images//favicon.ico" />
	
	<!-- For iPhone 4 Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images//apple-touch-icon-114x114-precomposed.png">
	<!-- For iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images//apple-touch-icon-72x72-precomposed.png">
	<!-- For iPhone: -->
	<link rel="apple-touch-icon-precomposed" href="images//apple-touch-icon-57x57-precomposed.png">
	
	<!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="../../libraries/lib.css">
	<link rel="stylesheet" type="text/css" href="../../libraries/Stroke-Gap-Icon/stroke-gap-icon.css">
	<script src="../../js/jquery.min.js"></script>
	
	<!-- Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,900,300,300italic,500,700' rel='stylesheet' type='text/css'>	
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>
	
	
	<!-- Custom - Common CSS -->
	<link rel="stylesheet" type="text/css" href="../../css/plugins.css">
	<link rel="stylesheet" type="text/css" href="../../css/navigation-menu.css">
	
	<!-- Custom - Theme CSS -->	
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<link rel="stylesheet" type="text/css" href="../../css/shortcode.css">
	
	<!--[if lt IE 9]>
		<script src="js/html5/respond.min.js"></script>
    <![endif]-->
</head>

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
	<!-- LOADER -->
	<!-- <div id="site-loader" class="load-complete">
		<div class="loader">
			<div class="loader-inner ball-clip-rotate">
				<div></div>
			</div>
		</div>
	</div> --><!-- Loader /- -->	
	<!-- Header -->
	<header class="header-main container-fluid no-padding">
		<!-- Top Header -->
		<div class="top-header container-fluid no-padding">
			<div class="container">
				<div class="topheader-left">
					<a href="tel:+5198759822"><i class="fa fa-mobile" aria-hidden="true"></i>+234 459 900 44 </a>
					<a href="mailto:Support@info.com" ><i class="fa fa-envelope-o" aria-hidden="true"></i>info@jakomita.com</a>
				</div>
				<div class="topheader-right">
					<a href="../../signin"><i class="fa fa-sign-out" aria-hidden="true"></i>Login</a>
					<a href="../../signup">Register</a>
				</div>
			</div>
		</div><!-- Top Header /- -->
		
		<!-- Menu Block -->
		<div class="menu-block container-fluid no-padding">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<!-- Navigation -->
					<nav class="navbar ow-navigation">
						<div class="col-md-3">
							<div class="navbar-header">
								<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a  href="../" ><img src="../../images/logo2.png" class="img-responsive" alt="logo" id="logochange" style="width:50%;height:50%" /></a>
							</div>
						</div>
						<div class="col-md-9">
							<div class="navbar-collapse collapse" id="navbar">
								<ul class="nav navbar-nav menubar">
									<li  class="dropdown active"><a  href="../">Home</a></li>
									<li><a href="../../cbt">CBT</a></li>
									<li><a href="../../forum">Forum</a></li>
									<li><a href="#">Check Course</a></li>
									<li><a href="../../blog">Blog</a></li>
									
									<?php if (isset($user_username)) {
      								?>
									<li class="dropdown">
										<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" href="../../#"><?php echo($user_username); ?> <i class="fa fa-user"></i></a>
										<i class="ddl-switch fa fa-angle-down"></i>
										<ul class="dropdown-menu">
											<li><a href="../../dashboard">Dashboard</a></li>
											<li><a href="../../logout">Logout</a></li>
										</ul>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</nav><!-- Navigation /- -->
					<div class="menu-search">
						<div id="sb-search" class="sb-search">
							<form>
								<input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search" />
								<button class="sb-search-submit"><i class="fa fa-search"></i></button>
								<span class="sb-icon-search"></span>
							</form>
						</div>
					</div>
				</div>
			</div><!-- Container /- -->
		</div><!-- Menu Block /- -->
	</header><!-- Header /- -->

	<script type="text/javascript">
			$( document ).scroll(function()
	{
		var scroll	=	$(window).scrollTop();
		var height	=	$(window).height();

		/*** set sticky menu ***/
		if( scroll >= height )
		{
			$("#logochange").attr('src','../../images/logo3.png');
			$(".menu-block").addClass("navbar-fixed-top animated fadeInDown").delay( 2000 ).fadeIn();
		}
		else if ( scroll <= height )
		{
			$(".menu-block").removeClass("navbar-fixed-top animated fadeInDown");
			$("#logochange").attr('src','../../images/logo2.png');

		}
		else
		{
			$(".menu-block").removeClass("navbar-fixed-top animated fadeInDown");
			$("#logochange").attr('src','../../images/logo2.png');

		} 

		if ($(this).scrollTop() >= 50)
		{	
			/* If page is scrolled more than 50px */
			$("#back-to-top").fadeIn(200); /* Fade in the arrow */
		}
		else
		{
			$("#back-to-top").fadeOut(200); /* Else fade out the arrow */
		}
	});
	</script>