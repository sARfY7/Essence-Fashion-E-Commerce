<?php require("db_connection.php") ?>
<?php include("head.php") ?>

<!--alerts CSS -->
<link href="../vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

<?php include("body.php") ?>
			
			
			
			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						  <h5 class="txt-dark">add SubCategories</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
							<li><a href="index.html">Dashboard</a></li>
							<li><a href="#"><span>e-commerce</span></a></li>
							<li class="active"><span>add-subcategories</span></li>
						  </ol>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->

					<script>

						function addSubCategory() {
							var subcat_name = document.getElementById("subcat-name");
							var category = document.getElementById("category");
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									$('#add-subcat-form').trigger('reset');
									getSubCategory();
									if (this.responseText == "Please Enter a SubCategory Name") {
										swal("Oops!", "You forgot to enter a SubCategory Name!", "error");
									} else {
										swal("Yay!", "New SubCategory Added!", "success");
									}
								}
							};
							xhttp.open("POST", "AddSubCategory.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("subcat-name=" + subcat_name.value + "&category=" + category.value);
							return false;
						}

						function getSubCategory() {
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("subcats").innerHTML = this.responseText;
								}
							};
							xhttp.open("POST", "GetSubCategories.php", true);
							xhttp.send();	
						}

					</script>
					
					<!-- Row -->
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default card-view">
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
											<form action="#" id="add-subcat-form">
												<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>SubCategory Details</h6>
												<hr class="light-grey-hr"/>
												<!-- Row -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10">Category</label>
															<select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="category" name="category">
																<?php
																	$get_cat = "SELECT id, cat_name FROM category";
																	$cat_res = mysqli_query($conn, $get_cat);
																	if (mysqli_num_rows($cat_res) > 0) {
																		// output data of each row
																		while($cat = mysqli_fetch_assoc($cat_res)) {
																			echo '<option value="'. $cat["id"] .'">'. $cat["cat_name"] .'</option>';
																		}
																	} else {
																		echo "0 results";
																	}
																?>
															</select>
														</div>
													</div>												
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10">SubCategory Name</label>
															<input type="text" id="subcat-name" name="subcat-name" class="form-control" placeholder="Enter SubCategory Name">
														</div>
													</div>
													
												</div>
												
												<div class="seprator-block"></div>
																								
												
												<div class="form-actions">
													<button type="submit" class="btn btn-success btn-anim left-icon mr-10 pull-left" onclick="return addSubCategory()"><i class="icon-rocket"></i><span class="btn-text">Add SubCategory</span></button>
													<button type="reset" class="btn btn-danger btn-anim pull-left"><i class="fa fa-trash-o"></i><span class="btn-text">Cancel</span></button>
													<div class="clearfix"></div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->

					<div class="row">
					<!-- Table Hover -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">SubCategories</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap mt-40">
										<div class="table-responsive">
										  <table class="table table-hover mb-0">
											<thead>
											  <tr>
												<th>ID</th>
												<th>SubCategory Name</th>
												<th>Category Name</th>
											  </tr>
											</thead>
											<tbody id="subcats">
											</tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Table Hover -->
				</div>

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
		
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- Owl JavaScript -->
		<script src="../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
		<!-- Switchery JavaScript -->
		<script src="../vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>

		<!-- Sweet-Alert  -->
		<script src="../vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
		
		<!-- Document onLoad Script -->												
		<script>
		$(function () {
			$("#add-subcat").addClass("active-page");
			getSubCategory();
		});
	</script>
		
	</body>
</html>