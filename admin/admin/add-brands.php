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
						  <h5 class="txt-dark">add brands</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
							<li><a href="index.html">Dashboard</a></li>
							<li><a href="#"><span>e-commerce</span></a></li>
							<li class="active"><span>add-brands</span></li>
						  </ol>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->

					<script>
						function getCategory(e) {
							var cat = e.options[e.selectedIndex].value;
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("subcategory").innerHTML = this.responseText;
									getSubCategory(document.getElementById("subcategory"));
								}
							};
							xhttp.open("GET", "subcategory.php?cat=" + cat, true);
							xhttp.send();
						}

						function getSubCategory(e) {
							var subcat = e.options[e.selectedIndex].value;
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("product-category").innerHTML = this.responseText;
								}
							};
							xhttp.open("GET", "ProductCategory.php?subcat=" + subcat, true);
							xhttp.send();
						}

						function addBrand() {
							var brand_name = document.getElementById("brand-name");
							var product_category = document.getElementById("product-category");
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									$('#add-brand-form').trigger('reset');
									getBrand();
									if (this.responseText == "Please Enter a Brand Name") {
										swal("Oops!", "You forgot to enter a Brand Name!", "error");
									} else {
										swal("Yay!", "New Brand Added!", "success");
									}
								}
							};
							xhttp.open("POST", "AddBrand.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("brand-name=" + brand_name.value + "&product-category=" + product_category.value);
							return false;
						}

						function getBrand() {
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("brands").innerHTML = this.responseText;
								}
							};
							xhttp.open("POST", "GetBrands.php", true);
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
											<form action="#" id="add-brand-form">
												<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Brand Details</h6>
												<hr class="light-grey-hr"/>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10">Brand Name</label>
															<input type="text" id="brand-name" name="brand-name" class="form-control" placeholder="Enter Brand Name">
														</div>
													</div>
													
												</div>
												<!-- Row -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label mb-10">Category</label>
															<select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="category" onchange="getCategory(this)">
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
															<label class="control-label mb-10">Sub-Category</label>
															<select class="form-control" data-placeholder="Choose a SubCategory" tabindex="1" id="subcategory" onchange="getSubCategory(this)">
															</select>
															<label class="control-label mb-10">Product Category</label>
															<select class="form-control" data-placeholder="Choose a Product Category" tabindex="1" id="product-category" name="product-category">
															</select>
														</div>
													</div>												
												</div>
												<div class="seprator-block"></div>
																								
												
												<div class="form-actions">
													<button type="submit" class="btn btn-success btn-anim left-icon mr-10 pull-left" onclick="return addBrand()"><i class="icon-rocket"></i><span class="btn-text">Add Brand</span></button>
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
									<h6 class="panel-title txt-dark">Brands</h6>
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
												<th>Brand Name</th>
												<th>Product Category Name</th>
											  </tr>
											</thead>
											<tbody id="brands">
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
			$("#add-brand").addClass("active-page");
			getCategory(document.getElementById("category"));
			getBrand();
		});
	</script>
		
	</body>
</html>