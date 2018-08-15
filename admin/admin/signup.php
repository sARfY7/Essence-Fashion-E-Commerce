<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Grandin I Fast build Admin dashboard for any platform</title>
		<meta name="description" content="Grandin is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Grandin Admin, Grandinadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
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
					<a href="index.html">
						<img class="brand-img mr-10" src="../img/logo.png" alt="brand"/>
						<span class="brand-text">Grandin</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-primary btn-rounded" href="index.php">Sign In</a>
				</div>
				<div class="clearfix"></div>
			</header>

			<script>
				function registerAdmin() {
					var uname = document.getElementById('uname');
					var email = document.getElementById('email');
					var pass = document.getElementById('pass');
					var cpass = document.getElementById('cpass');
					var msg = document.getElementById('msg');
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							uname.value = "";
							email.value = "";
							pass.value = "";
							cpass.value = "";
							msg.innerHTML = this.responseText;
						}
					};
					xhttp.open("POST", "RegisterNewAdmin.php", true);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send("uname=" + uname.value + "&email=" + email.value + "&password=" + pass.value + "&cpassword=" + cpass.value);
					return false;
				}
			</script>
			
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
											<h3 class="text-center txt-dark mb-10">Sign up to Grandin</h3>
											<h6 class="text-center nonecase-font txt-grey" id="msg">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form action="#">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputName_1">Username</label>
													<input type="text" name="uname" class="form-control" required="" id="uname" placeholder="Username">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
													<input type="email" name="email" class="form-control" required="" id="email" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<input type="password" name="password" class="form-control" required="" id="pass" placeholder="Enter pwd">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_3">Confirm Password</label>
													<input type="password" name="cpassword" class="form-control" required="" id="cpass" placeholder="Enter pwd">
												</div>
												<div class="form-group text-center">
													<button type="button" onclick="return registerAdmin()" class="btn btn-primary btn-rounded">sign Up</button>
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
