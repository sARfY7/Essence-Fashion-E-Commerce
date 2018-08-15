<?php
	session_start();
	$status = "";
	if (isset($_SESSION["adminID"])) {
		header("location: home.php");
	}
	if(isset($_GET["status"])) {
		$status = $_GET["status"];
	}
?>
<?php include("head.php") ?>
		
		<!-- vector map CSS -->
		<link href="../vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.php">
						<img class="brand-img mr-10" src="../img/logo.png" alt="brand"/>
						<span class="brand-text">ESSENCE</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Don't have an account?</span>
					<a class="inline-block btn btn-primary  btn-rounded" href="signup.php">Sign Up</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign in to ESSENCE</h3>
											<?php
												if(isset($_GET["status"])) {
													if ($status == 0) {
											?>
												<h6 class="text-center nonecase-font txt-grey">Email not registered. Please Register.</h6>
											<?php
													} else if ($status == 1) {
											?>
												<h6 class="text-center nonecase-font txt-grey">Password doesn't match.</h6>
											<?php
													}
												}
											?>
										</div>	
										<div class="form-wrap">
											<form action="LoginAdmin.php" method="POST">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
													<input type="email" name="email" class="form-control" required="" id="exampleInputEmail_2" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<div class="clearfix"></div>
													<input type="password" name="pass" class="form-control" required="" id="exampleInputpwd_2" placeholder="Enter pwd">
												</div>
												
												<div class="form-group text-center">
													<button type="submit" name="login" class="btn btn-primary  btn-rounded">sign in</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>
	</body>
</html>
