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
				<h5 class="txt-dark">add products</h5>
			</div>
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li>
						<a href="index.html">Dashboard</a>
					</li>
					<li>
						<a href="#">
							<span>e-commerce</span>
						</a>
					</li>
					<li class="active">
						<span>add-products</span>
					</li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->

		<script>
			function getCategory(e) {
				var cat = e.options[e.selectedIndex].value;
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
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
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("product-category").innerHTML = this.responseText;
						getProductCategory(document.getElementById("product-category"));
					}
				};
				xhttp.open("GET", "ProductCategory.php?subcat=" + subcat, true);
				xhttp.send();
			}

			function getProductCategory(e) {
				var prod_cat = e.options[e.selectedIndex].value;
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("brand").innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "brand.php?prod-cat=" + prod_cat, true);
				xhttp.send();
			}

			function addProduct() {
				var fd = new FormData(document.getElementById('add-prod-form'));

				$.ajax({
					url: 'AddProduct.php',
					type: 'post',
					data: fd,
					contentType: false,
					processData: false,
					success: function (response) {
						$('#add-prod-form').trigger('reset');
						$('#prod-img-preview').attr('src', '../img/chair.jpg');
						$('#prod-hover-img-preview').attr('src', '../img/chair.jpg');
						$('#prod-img-name').html('');
						$('#prod-hover-img-name').html('');
						if (response == "New Product Added successfully") {
							swal("Yay!", "New Product Added!", "success");
						} else {
							swal("Oops!", response, "error");
						}
					},
				});

				return false;
			}
		</script>

		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								<form action="#" id="add-prod-form" enctype="multipart/form-data">
									<h6 class="txt-dark capitalize-font">
										<i class="zmdi zmdi-info-outline mr-10"></i>Product Details</h6>
									<hr class="light-grey-hr" />
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Product Name</label>
												<input type="text" id="prod-name" name="prod-name" class="form-control" placeholder="Arrow White Casual Shirt for Men">
											</div>
										</div>
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
											</div>
										</div>
									</div>
									<!-- Row -->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Price</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-inr"></i>
													</div>
													<input type="text" class="form-control" id="prod-price" name="prod-price" placeholder="153">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Sub-Category</label>
												<select class="form-control" data-placeholder="Choose a SubCategory" tabindex="1" id="subcategory" onchange="getSubCategory(this)">
												</select>
											</div>
										</div>
									</div>

									<script>
										function addMoreColors(e) {
											e.preventDefault();
											$('#prod-color-wrapper').append('<div><input type="text" name="prod-color[]" class="form-control prod-color mb-10" placeholder="Color"/><a href="#" onclick="removeColor(event, this)"><i class="fa fa-minus mr-10"></i>Remove</a></div>');
										}

										function removeColor(e, element) {
											e.preventDefault();
											$(element).parent('div').remove();
										}
									</script>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Product Color</label>
												<input type="text" name="prod-color[]" class="form-control prod-color mb-10" placeholder="Color">
												<div id="prod-color-wrapper" class="mb-10">
												</div>
												<a href="#" onclick="addMoreColors(event)"><i class="fa fa-plus mr-10"></i>Add More Colors</a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Product Category</label>
												<select class="form-control" data-placeholder="Choose a Product Category" tabindex="1" id="product-category" name="product-category"
												    onchange="getProductCategory(this)">
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10 center-block">Product Size</label>
												<div class="checkbox checkbox-success checkbox-inline">
													<input id="xs" type="checkbox" value="XS" name="prod-size[]">
													<label for="xs"> XS </label>
												</div>
												<div class="checkbox checkbox-success checkbox-inline">
													<input id="s" type="checkbox" value="S" name="prod-size[]">
													<label for="s"> S </label>
												</div>
												<div class="checkbox checkbox-success checkbox-inline">
													<input id="m" type="checkbox" value="M" name="prod-size[]">
													<label for="m"> M </label>
												</div>
												<div class="checkbox checkbox-success checkbox-inline">
													<input id="l" type="checkbox" value="L" name="prod-size[]">
													<label for="l"> L </label>
												</div>
												<div class="checkbox checkbox-success checkbox-inline">
													<input id="xl" type="checkbox" value="XL" name="prod-size[]">
													<label for="xl"> XL </label>
												</div>
												<div class="checkbox checkbox-success checkbox-inline">
													<input id="xxl" type="checkbox" value="XXL" name="prod-size[]">
													<label for="xxl"> XXL </label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label mb-10">Brand</label>
												<select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="brand" name="brand">
												</select>
											</div>
										</div>
									</div>

									<div class="seprator-block"></div>
									<h6 class="txt-dark capitalize-font">
										<i class="zmdi zmdi-collection-image mr-10"></i>upload product showcase image</h6>
									<hr class="light-grey-hr" />
									<div class="row">
										<div class="col-lg-6 col-sm-6 text-center">
											<p class="mb-10">Only JPEG, JPG and PNG</p>
											<div class="img-upload-wrap">
												<img class="img-responsive center-block" id="prod-img-preview" src="../img/chair.jpg" alt="upload_img">
											</div>
											<p class="mb-10" id="prod-img-name"></p>
											<div class="fileupload btn btn-info btn-anim mt-10">
												<i class="fa fa-upload"></i>
												<span class="btn-text">Product Image</span>
												<input type="file" class="upload" id="prod-img" name="prod-img">
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 text-center">
											<p class="mb-10">Only JPEG, JPG and PNG</p>
											<div class="img-upload-wrap">
												<img class="img-responsive center-block" id="prod-hover-img-preview" src="../img/chair.jpg" alt="upload_img">
											</div>
											<p class="mb-10" id="prod-hover-img-name"></p>
											<div class="fileupload btn btn-info btn-anim mt-10">
												<i class="fa fa-upload"></i>
												<span class="btn-text">Product Hover Image</span>
												<input type="file" class="upload" id="prod-hover-img" name="prod-hover-img">
											</div>
										</div>
									</div>
									<div class="seprator-block"></div>


									<h6 class="txt-dark capitalize-font">
										<i class="zmdi zmdi-collection-image mr-10"></i>upload product images (Select only 4)</h6>
									<hr class="light-grey-hr" />
									<div class="row">
										<div class="col-lg-3 col-sm-6 text-center">
											<p class="mb-10">Only JPEG, JPG and PNG</p>
											<div class="img-upload-wrap">
												<img class="img-responsive center-block" id="prod-img-preview-1" src="../img/chair.jpg" alt="upload_img">
											</div>
											<p class="mb-10" id="prod-img-name-1"></p>
										</div>
										<div class="col-lg-3 col-sm-6 text-center">
											<p class="mb-10">Only JPEG, JPG and PNG</p>
											<div class="img-upload-wrap">
												<img class="img-responsive center-block" id="prod-img-preview-2" src="../img/chair.jpg" alt="upload_img">
											</div>
											<p class="mb-10" id="prod-img-name-2"></p>
										</div>
										<div class="col-lg-3 col-sm-6 text-center">
											<p class="mb-10">Only JPEG, JPG and PNG</p>
											<div class="img-upload-wrap">
												<img class="img-responsive center-block" id="prod-img-preview-3" src="../img/chair.jpg" alt="upload_img">
											</div>
											<p class="mb-10" id="prod-img-name-3"></p>
										</div>
										<div class="col-lg-3 col-sm-6 text-center">
											<p class="mb-10">Only JPEG, JPG and PNG</p>
											<div class="img-upload-wrap">
												<img class="img-responsive center-block" id="prod-img-preview-4" src="../img/chair.jpg" alt="upload_img">
											</div>
											<p class="mb-10" id="prod-img-name-4"></p>
										</div>
									</div>
									<div class="row mt-10 mb-10">
										<div class="col-lg-12 text-center">
											<div class="fileupload btn btn-info btn-anim mt-10">
												<i class="fa fa-upload"></i>
												<span class="btn-text">Product Image</span>
												<input type="file" class="upload" id="product-images" name="product-images[]" multiple>
											</div>
										</div>
									</div>


									<div class="form-actions">
										<button type="submit" class="btn btn-success btn-anim left-icon mr-10 pull-left" onclick="return addProduct()">
											<i class="icon-rocket"></i>
											<span class="btn-text">Add Product</span>
										</button>
										<button type="reset" class="btn btn-danger btn-anim pull-left">
											<i class="fa fa-trash-o"></i>
											<span class="btn-text">Cancel</span>
										</button>
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
		$("#add-product").addClass("active-page");
		getCategory(document.getElementById("category"));

		function readProdImgURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#prod-img-preview').attr('src', e.target.result);
					$('#prod-img-name').html(input.files[0].name);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		function readProdHoverImgURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#prod-hover-img-preview').attr('src', e.target.result);
					$('#prod-hover-img-name').html(input.files[0].name);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		function setupReader(files, preview, name) {
			var file_name = files["name"];
			var reader = new FileReader();  
			reader.onload = function(e) {  
				preview.attr('src', e.target.result);
				name.html(file_name);
			}
			reader.readAsDataURL(files);
		}

		function readProductImagesURL(input) {
			for (var i = 0; i < input.files.length; i++) {
				var prod_img_preview = $('#prod-img-preview-' + (i + 1));
				var prod_img_name = $('#prod-img-name-' + (i + 1));
				setupReader(input.files[i], prod_img_preview, prod_img_name);
			}
		}

		$("#prod-img").change(function () {
			readProdImgURL(this);
		});
		$("#prod-hover-img").change(function () {
			readProdHoverImgURL(this);
		});
		$("#product-images").change(function () {
			readProductImagesURL(this);
		});
	});
</script>

</body>

</html>