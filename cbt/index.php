<?php include 'inc/header.php' ?>
	<!-- PageBanner -->
	<div class="container-fluid no-padding pagebanner">
		<div class="container">
			<div class="pagebanner-content">
				<h3>CBT</h3>
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li>CBT</li>
				</ol>
			</div>
		</div>
	</div><!-- PageBanner /- -->
	
	<!-- Welcome Section -->
	<div class="container welcome-section">
		<div class="section-padding"></div>
		<div class="section-header">
			<h3>CBT Categories <span>Available</span></h3>
			<p>Get yourself ready by taking our free online tests</p>
		</div>
		<div class="row">
			<?php 
			$getcategories = mysqli_query($conn,"SELECT * FROM cbt_categories");
			while ($row = mysqli_fetch_array($getcategories)) {
				$categoryid = $row['cbt_cat_id'];
				$categoryname = $row['cbt_cat_name'];
				$picturename = $row['category_picture'];
				$categorydescription= $row['cat_description'];
				$level= $row['level'];
			 ?>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="welcome-box">
					<img src="<?php echo($picturename); ?>" alt="Category Picture" width="250" height="250"/>
					<div class="welcome-title">
						<h3><?php echo(ucwords($categoryname)); ?></h3>
					</div>	
					<div class="welcome-content">
						<ul class="course-detail">
							<li><i class="fa fa-calendar" aria-hidden="true"></i>Description : <span><?php echo(ucwords($categorydescription)); ?></span></li>
							<li><i class="fa fa-graduation-cap" aria-hidden="true"></i>Level : <span><?php echo(ucwords($level)); ?></span></li>
						</ul>
						<ul class="course-rating">
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
						<a href="cbt-available?cat=<?php echo(strtolower($categoryname)); ?>">Start Test</a>
					</div>
				</div>
			</div>
			<?php }  ?>
		</div>
		<div class="section-padding"></div>
	</div><!-- Welcome Section /- -->


<?php include 'inc/footer.php' ?>